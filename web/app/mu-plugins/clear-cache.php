<?php
/*
Plugin Name:  Clear All Cache
Description:
Version:      1.0.0
Author:       Simplefly
Author URI:   https://simplefly.nl/
License:      MIT License
*/

use Hummingbird\Core\Utils;

/**
 * Clear Hummingbird cache
 */
function clear_hummingbird_cache()
{
    if (is_plugin_active('wp-hummingbird/wp-hummingbird.php')) {
        foreach (Utils::get_active_cache_modules() as $module => $name) {
            $mod = Utils::get_module($module);
            if ($mod->is_active()) {
                if ('minify' === $module) {
                    $mod->clear_files();
                } else {
                    $mod->clear_cache();
                }
            }
        }
    }
}

/**
 * Clear Savvii cache
 */
function clear_savvii_cache()
{
    if (is_plugin_active('warpdrive/warpdrive.php')) {
        do_action('warpdrive_cache_flush'); // This will flush the entire cache
        do_action('warpdrive_domain_flush'); // This will only flush the cache of the current domain
    }
}

/**
 * Clear PHP Opcache
 */
function clear_php_opcache()
{
    if (!extension_loaded('Zend OPcache')) {
        return;
    }
    $opcache_status = opcache_get_status();
    if (false === $opcache_status["opcache_enabled"]) {
        // extension loaded but OPcache not enabled
        return;
    }
    if (!opcache_reset()) {
        return false;
    } else {
        /**
         * opcache_reset() is performed, now try to clear the
         * file cache.
         * Please note: http://stackoverflow.com/a/23587079/1297898
         *   "Opcache does not evict invalid items from memory - they
         *   stay there until the pool is full at which point the
         *   memory is completely cleared"
         */
        foreach ($opcache_status['scripts'] as $key => $data) {
            $dirs[dirname($key)][basename($key)] = $data;
            opcache_invalidate($data['full_path'], $force = true);
        }
        return true;
    }
}

/**
 * Clear all cache
 */
function clear_all_cache()
{
    clear_hummingbird_cache();
    clear_savvii_cache();
    clear_php_opcache();
}

/**
 * Clear all cache if the request have param clear-cache
 */
if (isset($_REQUEST['clear-cache'])) {
    clear_all_cache();
    $url = remove_query_arg(['clear-cache']);
    wp_safe_redirect(add_query_arg('cache-cleared', 'true', $url));
    exit;
}

/**
 * Add custom command to wp cli
 * $ php wp-cli.phar clear-cache
 */
if (defined('WP_CLI') && WP_CLI) {
    WP_CLI::add_command('clear-cache', function ($args) {
        clear_all_cache();
        WP_CLI::success('Cache cleared');
    });
}


<?php
/*
Plugin Name:  EU Cookie Manager
Plugin URI:
Description:  This plugin adds a cookie notification to your website. It blocks cookies until the user accepts them.
Works with Multi sites and Multi language (WPML) and it has some styling options for the notification.
Version:      1.0.2
Author:     Sunbytes
Author URI:   https://sunbytes.io
Contributors: Sunbytes
Text Domain:  sb-cookies
*/

class SBcookiemanager {
    public $settings;
    public $sb_lang;
    public $sb_wpmu;

    function __construct() { }

    function initialize() {
        $this->settings = array(
            // basic
            'name'          => __( 'Eu cookie manager', 'sb-cookies' ),
            'slug'          => 'sb-eu-cookie-manager',
            'version'       => '1.0.2',
            // urls
            'basename'      => plugin_basename( __FILE__ ),
            'dir'           => plugin_dir_path( __FILE__ ),
            'url'           => plugin_dir_url( __FILE__ ),
        );

        // call to process ajax
        add_action('wp_ajax_get_cookie_bar', array($this, 'sb_ajax_cookie_content_bar'));
        add_action('wp_ajax_nopriv_get_cookie_bar', array($this, 'sb_ajax_cookie_content_bar'));
        add_action('activated_plugin', array( $this, 'sb_set_plugin_last' ));

        // process plugin
        add_action('init', array($this, 'sb_cookie_start'));

        // check WPMU
        if(MULTISITE) {
            $this->sb_wpmu = true;
        } else {
            $this->sb_wpmu = false;
        }

    }

    // call template to show via Ajax
    function sb_ajax_cookie_content_bar() {
        if ( ( !isset( $_COOKIE['SbCookie'] ) && $_COOKIE['SbCookie'] != 'Allow' ) ) {
            require( $this->settings['dir'].'template/template.php');
        }
        exit;
    }

    function sb_set_plugin_last() {
        $wp_path_to_this_file = preg_replace('/(.)plugins\/(.)$/', WP_PLUGIN_DIR."/$2", __FILE__);
        $this_plugin = plugin_basename(trim($wp_path_to_this_file));
        $active_plugins = get_option('active_plugins');
        $this_plugin_key = array_search($this_plugin, $active_plugins);
        array_splice($active_plugins, $this_plugin_key, 1);
        array_push($active_plugins, $this_plugin);
        update_option('active_plugins', $active_plugins);
    }

    function sb_cookie_start() {

        // set current language
        global $sitepress;
        if(!isset($sitepress)) {
            $this->sb_lang = 'en';
        } else {
            $this->sb_lang = $sitepress->get_current_language();
        }

        load_plugin_textdomain( 'sb-cookies' );
        // add class to body from plugin to layout
        add_filter('body_class', array($this, 'sb_body_classes') );

        if ( !is_admin() ) {
//        add_action('wp_head', array($this,'sb_start'));
            add_action('wp_footer', array($this, 'sb_end'));
            add_action('wp_footer', array($this, 'sb_apply_content_footer'), 1000);
            add_filter('the_content', array($this,'sb_block_script'), 11);
            add_action('wp_enqueue_scripts', array($this, 'sb_styles'), 1);
            add_action('wp_enqueue_scripts', array($this, 'sb_enqueue_scripts'), 20, 1);
        }
    }

    function sb_body_classes($classes) {

        if(!$this->sb_cookie_accepted()) {
            $position = $this->sb_cookie_option('position', $this->sb_lang);
            $classes[] = 'cookies-pp '.$position;
        }
        return $classes;
    }

    function sb_cookie_option($name, $lang = 'en') {
        $defaults = array (
            'barmessage' => __('By continuing to use the site, you agree to the use of cookies.', 'sb-cookies'),
            'barbutton'=> __('Accept', 'sb-cookies')
        );

        $options = get_option('sb_cookie_data_'.$lang);
        if ( isset( $options[$name] ) && !empty($options[$name]) ) {
            return $options[$name];
        } else {
            if(isset($defaults[$name])) {

                return $defaults[$name];
            }
        }
        return false;
    }

    function sb_cookie_accepted() {
        if ( ( isset( $_COOKIE['SbCookie'] ) && $_COOKIE['SbCookie'] == 'Allow' ) ) {
            return true;
        } else {
            return false;
        }
    }

    function sb_block_script($content) {
        if ( !$this->sb_cookie_accepted() && $this->sb_cookie_option('autoblock', $this->sb_lang) )
        {
            $content = preg_replace('#<iframe.*?\/iframe>|<object.*?\/object>|<embed.*?>#is', ' ', $content);
            $content = preg_replace('#<script.*?\/script>#is', ' ', $content);
            $content = preg_replace('~<a.*?https?://(?:www\.)?youtube\.com[^>]*>(.*?)</a>~','\1',$content);
        }
        return $content;
    }

    function sb_enqueue_scripts(){
        $eu_data = array(
            'current_lang' => $this->sb_lang,
            'autoBlock' =>  $this->sb_cookie_option('autoblock'),

        );

        // add data about the path for WPMU
        if($this->sb_wpmu) {
            if(function_exists('switch_to_blog')) {
                $current_blog = get_current_blog_id();
                switch_to_blog($current_blog);
                $path = get_blog_details($current_blog);
                restore_current_blog();
                $eu_data['wpmu_path'] = $path->path;
            }
        }
        
        wp_enqueue_script(
            'sbcookies-scripts',
            plugins_url('template/js/scripts.js', __FILE__),
            array(),
            '',
            true
        );
        wp_localize_script('sbcookies-scripts','sbcookie_data',$eu_data);
        // add ajax in plugin
        wp_localize_script( 'sbcookies-scripts', 'ajax_postajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    }

    function sb_styles(){
        // $outCss = $this->sb_cookie_option('outcss');
        // if(empty($outCss)) {
        wp_register_style ('sb-cookie-css', plugins_url('template/css/sb-style.css', __FILE__), array(), $this->settings['version']);
        wp_enqueue_style  ('sb-cookie-css');
        // }
    }

    function sb_apply_content_footer(){
        echo '<div class="cookie_loading" data-language="'.$this->sb_lang.'"></div>';
    }
    function sb_start() {
        ob_start();
    }
    function sb_end() {
        $contents = $this->sb_block_script(ob_get_contents());
        ob_end_clean();
        echo $contents;
    }

} // end class

function sb_eucookie() {
    global $sb_eucookie;
    if ( ! isset( $sb_eucookie ) ) {
        $sb_eucookie = new SBcookiemanager();
        $sb_eucookie->initialize();
    }
    return $sb_eucookie;
}

sb_eucookie();

register_uninstall_hook( __FILE__, 'sb_plugin_uninstall');
function sb_plugin_uninstall() {
    $sb_eucookie = new SBcookiemanager();
    $sb_eucookie->initialize();
    // delete option in all sites
    if($sb_eucookie->sb_wpmu) {
        // get all sites
        $data_sites = sb_get_blog_sites();
        if(!empty($data_sites)) {
            foreach($data_sites as $blog) {
                switch_to_blog($blog->blog_id);
                sb_delete_option_site();
            }
            restore_current_blog();
        }
    } else {
        sb_delete_option_site();
    }

}

function sb_delete_option_site(){
    global $sitepress;
    if(isset($sitepress)){
        $current_lang = $sitepress->get_current_language();
        $languages = icl_get_languages('skip_missing=0');
        foreach ($languages as $lang => $value) {
            $option_name =  'sb_cookie_data_'.$current_lang;
            delete_option($option_name);
        }
    } else {
        $option_name =  'sb_cookie_data_en';
        delete_option($option_name);
    }

    delete_option('sb_cookie_version');
}

function sb_get_blog_sites(){
    global $wpdb;
    return $wpdb->get_results('SELECT blog_id FROM '.$wpdb->prefix.'blogs');
}

if(is_admin()) {
    require ('admin/eu_admin.php');
    sb_admin_eucookie();
}
?>
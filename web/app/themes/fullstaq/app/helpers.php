<?php

namespace App;

use Illuminate\Support\Str;
use Roots\Sage\Container;

/**
 * Get the sage container.
 *
 * @param string $abstract
 * @param array  $parameters
 * @param Container $container
 * @return Container|mixed
 */
function sage($abstract = null, $parameters = [], Container $container = null)
{
    $container = $container ?: Container::getInstance();
    if (!$abstract) {
        return $container;
    }
    return $container->bound($abstract)
        ? $container->makeWith($abstract, $parameters)
        : $container->makeWith("sage.{$abstract}", $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed|\Roots\Sage\Config
 * @copyright Taylor Otwell
 * @link https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function config($key = null, $default = null)
{
    if (is_null($key)) {
        return sage('config');
    }
    if (is_array($key)) {
        return sage('config')->set($key);
    }
    return sage('config')->get($key, $default);
}

/**
 * @param string $file
 * @param array $data
 * @return string
 */
function template($file, $data = [])
{
    return sage('blade')->render($file, $data);
}

/**
 * Retrieve path to a compiled blade view
 * @param $file
 * @param array $data
 * @return string
 */
function template_path($file, $data = [])
{
    return sage('blade')->compiledPath($file, $data);
}

/**
 * @param $asset
 * @return string
 */
function asset_path($asset)
{
    return sage('assets')->getUri($asset);
}

/**
 * @param string|string[] $templates Possible template files
 * @return array
 */
function filter_templates($templates)
{
    $paths = apply_filters('sage/filter_templates/paths', [
        'views',
        'resources/views'
    ]);
    $paths_pattern = "#^(" . implode('|', $paths) . ")/#";

    return collect($templates)
        ->map(function ($template) use ($paths_pattern) {
            /** Remove .blade.php/.blade/.php from template names */
            $template = preg_replace('#\.(blade\.?)?(php)?$#', '', ltrim($template));

            /** Remove partial $paths from the beginning of template names */
            if (strpos($template, '/')) {
                $template = preg_replace($paths_pattern, '', $template);
            }

            return $template;
        })
        ->flatMap(function ($template) use ($paths) {
            return collect($paths)
                ->flatMap(function ($path) use ($template) {
                    return [
                        "{$path}/{$template}.blade.php",
                        "{$path}/{$template}.php",
                    ];
                })
                ->concat([
                    "{$template}.blade.php",
                    "{$template}.php",
                ]);
        })
        ->filter()
        ->unique()
        ->all();
}

/**
 * @param string|string[] $templates Relative path to possible template files
 * @return string Location of the template
 */
function locate_template($templates)
{
    return \locate_template(filter_templates($templates));
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
    static $display;
    isset($display) || $display = apply_filters('sage/display_sidebar', false);
    return $display;
}

/**
 * Cut string by char
 * @param string $string
 * @param int $max_length
 * @param string $more_string
 * @return string
 */
function cut_string_by_char($string, $max_length = null, $more_string = ' ...')
{
    if (empty($string)) {
        return '';
    }

    return Str::limit(trim(strip_tags($string)), $max_length ?? get_max_char_allowed(), $more_string);
}

/**
 * @param int $post_id
 * @return Object|false
 */
function get_primary_category(int $post_id)
{
    $main_category_id = get_post_meta($post_id, '_yoast_wpseo_primary_category', true);
    $primary_category = array_filter(wp_get_post_terms($post_id, ['category', 'cases_category'], ['fields' => 'all']), function ($term) use ($main_category_id) {
        return intval($main_category_id) === $term->term_id;
    });

    return current(!empty($primary_category) ? $primary_category : wp_get_post_terms($post_id, ['category', 'cases_category'], ['fields' => 'all']));
}


/**
 * Get wordpress paging
 * @param $max_num_page
 * @param string $args
 * @return void structure paging
 */
function pagination($max_num_page, $args = '')
{
    if (empty($max_num_page)) {
        return;
    }

    $big = 999999999;

    $args = wp_parse_args($args, [
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $max_num_page,
        'end_size' => 1,
        'mid_size' => 2,
        'prev_next' => true,
        'prev_text' => __('« Previous'),
        'next_text' => __('Next »'),
    ]);
    echo paginate_links($args);
}

/**
 * @param string $post_type
 * @param array $custom_args
 * @return \WP_Query
 */
function get_wp_object_query($post_type = 'post', $custom_args = [])
{
    $default_args = [
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => !get_option('posts_per_page') ? get_option('posts_per_page') : -1,
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
        'orderby' => 'date',
        'order' => 'DESC'
    ];

    return new \WP_Query(!empty($custom_args) ? wp_parse_args($custom_args, $default_args) : $default_args);
}

/**
 * @param array $button
 *
 * @return string
 */
function get_button_link($button = [])
{
    if (!empty($button['btn_link_type'])) {
        switch ($button['btn_link_type']) {
            case 'page':
                return $button['btn_link'];
            case 'url':
                return $button['btn_url'];
            default:
                break;
        }
    }

    return '';
}

/**
 * @param array $button
 * @param string $class
 *
 * @return string
 */
function get_button_html($button = [], $class = '')
{
    if (!empty($button['btn_txt']) && (!empty($button['btn_link']) || !empty($button['btn_url']))) {
        $button_link = get_button_link($button);
        if (!empty($button_link)) {
            return sprintf('<a class="%s" href="%s" %s>%s</a>', $class, $button_link, !empty($button['btn_target']) ? ' target="_blank"' : '', $button['btn_txt']);
        }
    }

    return '';
}

function get_max_char_allowed()
{
    return 150;
}

/**
 * @return array
 */
function get_image_size_resolutions() : array
{
    return [
        'image_text_block' => ['w' => 554, 'h' => 420],
        'image_text_block_2x' => ['w' => 1108, 'h' => 840],
        'image_featured' => ['w' => 555, 'h' => 380],
        'image_featured_2x' => ['w' => 1110, 'h' => 760],
        'image_contact_block' => ['w' => 678, 'h' => 438],
        'image_contact_block_2x' => ['w' => 1356, 'h' => 876],
        'image_banner_block' => ['w' => 1920, 'h' => 550],
    ];
}

/**
 * @param $post
 * @param string $image_size
 * @return array
 */
function get_featured_article($post, $image_size = 'image_featured')
{
    return !empty($post) ? [
        'ID' => $post->ID,
        'title' => $post->post_title,
        'excerpt' => cut_string_by_char($post->post_excerpt),
        'url' => get_the_permalink($post->ID),
        'thumbnail' => has_post_thumbnail($post->ID) ? [
            'thumb' => get_the_post_thumbnail_url($post->ID, $image_size),
            'thumb_2x' => get_the_post_thumbnail_url($post->ID, $image_size . '_2x')
        ] : [
            'thumb' => wp_get_attachment_image_url(get_field('opt_general_img_default', 'option'), $image_size),
            'thumb_2x' => wp_get_attachment_image_url(get_field('opt_general_img_default', 'option'), $image_size . '_2x')
        ]
    ] : [];
}

/**
 * @param $post
 * @return array
 */
function get_job_article($post)
{
    $tags = get_the_terms($post->ID, 'jobs_tag');

    return !empty($post) ? [
        'title' => $post->post_title,
        'url' => get_the_permalink($post->ID),
        'excerpt' => $post->post_excerpt,
        'tags' => is_array($tags) ? implode(' | ', wp_list_pluck($tags, 'name')) : []
    ] : [];
}

/**
 * @param $post_type
 * @return string
 */
function get_template_slug($post_type)
{
    switch ($post_type) {
        case 'jobs':
            return 'partials.careers.careers-job-list';
            break;
        default:
            return 'partials.overview.overview-list';
    }
}

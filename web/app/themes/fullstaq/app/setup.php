<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_localize_script('sage/main.js', 'ajax', [
        'url' => admin_url('admin-ajax.php'),
        'wpNonce' => wp_create_nonce('ajax_nonce'),
    ]);

}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);
    register_nav_menus([
        'footer_navigation' => __('Footer Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));

    /**
     * Add custom image sizes
     */
    foreach (get_image_size_resolutions() as $image_key => $size) {
        if (isset($size['w'], $size['h'])) {
            add_image_size($image_key, $size['w'], $size['h'], true);
        }
    }

    add_post_type_support( 'page', 'excerpt' );

}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});

/**
 * Acf json
 */

add_filter( 'acf/settings/save_json', function ( $path ) {
    $targetDir = get_template_directory() . '/resources/acf-json';
    return ( file_exists( $targetDir ) && is_dir( $targetDir ) ) ? $targetDir : $path;
});

/**
 * @param $is_mobile
 *
 * @return bool
 */
add_filter( 'wp_is_mobile', function ( $is_mobile ) {
    if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'iPad' ) !== false ) {
        $is_mobile = false;
    }
    return $is_mobile;
} );


/**
 * Add support SVG for uploading
 */

add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svg'] = 'image/svg';
    return $mimes;
});

/**
 * Register gutenberg block categories
 */
add_filter( 'block_categories', function( $categories ) {
    return array_merge(
        [
            [
                'slug' => 'acf-blocks',
                'title' => __( 'Theme Blocks', 'sage' ),
            ]
        ],
        $categories
    );
}, 10);

/**
 * Disable the emoji's
 */
add_action( 'init', function () {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

    /**
     * Filter function used to remove the tinymce emoji plugin.
     *
     * @param array $plugins
     * @return array Difference betwen the two arrays
     */
    add_filter( 'tiny_mce_plugins', function ($plugins) {
        if ( is_array( $plugins ) ) {
            return array_diff( $plugins, ['wpemoji'] );
        } else {
            return [];
        }
    } );

    /**
     * Remove emoji CDN hostname from DNS prefetching hints.
     *
     * @param array $urls URLs to print for resource hints.
     * @param string $relation_type The relation type the URLs are printed for.
     * @return array Difference betwen the two arrays.
     */
    add_filter( 'wp_resource_hints', function ($urls, $relation_type) {
        if ( 'dns-prefetch' == $relation_type ) {
            /** This filter is documented in wp-includes/formatting.php */
            $urls = array_diff( $urls, [apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' )] );
        }

        return $urls;
    }, 10, 2 );
} );

/**
* Cleanup head
*/

add_action('init', function () {
    // EditURI link.
    remove_action('wp_head', 'rsd_link');

    // Category feed links.
    remove_action('wp_head', 'feed_links_extra', 3);

    // Post and comment feed links.
    remove_action('wp_head', 'feed_links', 2);

    // Windows Live Writer.
    remove_action('wp_head', 'wlwmanifest_link');

    // Index link.
    remove_action('wp_head', 'index_rel_link');

    // Previous link.
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);

    // Start link.
    remove_action('wp_head', 'start_post_rel_link', 10, 0);

    // Canonical.
    remove_action('wp_head', 'rel_canonical', 10, 0);

    // Emoji detection script.
    remove_action('wp_head', 'print_emoji_detection_script', 7);

    // Emoji styles.
    remove_action('wp_print_styles', 'print_emoji_styles');
});


/**
 * Add Favicon
 */
add_action('wp_head', function () {
    $favicon = get_field('opt_general_img_fav', 'option');
    if (!$favicon) {
        $favicon = get_template_directory() . '/favicon.png';
    }
    echo '<link rel="shortcut icon" href="' . $favicon . '" />';
});

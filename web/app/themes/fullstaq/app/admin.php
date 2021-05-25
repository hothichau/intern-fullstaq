<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

/**
 * Removes dashboard activity widget.
 */
add_action('wp_dashboard_setup', function () {
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    //remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
});

/**
 *  Remove wp-logo on admin bar
 */
add_action( 'wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
});

/*
 * Change Footer Text in Admin
 */
add_filter( 'admin_footer_text', function () {
    $theme = wp_get_theme();
    return "Powered by <a href='" . $theme['Author URI'] . "' target='_blank'>" . $theme['Author Name'] . '</a>';
});

/**
 * Register admin assets
 */
add_action( 'admin_enqueue_scripts', function () {
    wp_enqueue_script('sage/admin.js', asset_path('scripts/admin.js'), ['jquery'], null, true);
    wp_enqueue_style( 'sage/admin', asset_path( 'styles/admin.css' ), false, null );
});

/**
 * Include theme author settings
 */
if (file_exists(__DIR__.DIRECTORY_SEPARATOR.'theme_author.php')) {
    include __DIR__.DIRECTORY_SEPARATOR.'theme_author.php';
}

/**
 * Add ACF options page
 */
if (function_exists('acf_add_options_page')) {
    $parent = acf_add_options_page(__('Options', 'fullstaq'));
    // add sub page
    acf_add_options_page(
        array(
            'page_title'  => __('General', 'fullstaq'),
            'menu_title'  => __('General', 'fullstaq'),
            'parent_slug' => $parent['menu_slug'],
        )
    );

    acf_add_options_sub_page(
        array(
            'page_title'  => __('Footer', 'fullstaq'),
            'menu_title'  => __('Footer', 'fullstaq'),
            'parent_slug' => $parent['menu_slug'],
        )
    );
}

/**
 * Register admin assets
 */
add_action( 'admin_enqueue_scripts', function () {
    wp_enqueue_script('sage/admin.js', asset_path('scripts/admin.js'), ['jquery'], null, true);
    wp_enqueue_style( 'sage/admin', asset_path( 'styles/admin.css' ), false, null );
});

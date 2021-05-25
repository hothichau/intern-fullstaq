<?php

namespace App;

class CustomPostType
{
    public function __construct()
    {
        add_action('init', [$this, 'createCustomPostType']);
        add_action('init', [$this, 'createCustomTaxonomies']);
    }

    public function createCustomPostType()
    {
        $this->addPostType('jobs', 'jobs', [
            'menu_icon' => 'dashicons-id-alt', 'publicly_queryable' => true
        ]);

        $this->addPostType('cases', 'cases', [
            'menu_icon' => 'dashicons-open-folder', 'publicly_queryable' => true
        ]);
    }

    public function createCustomTaxonomies()
    {
        $this->addTax('jobs_tag', 'Tags', 'jobs', ['hierarchical' => false, 'show_in_rest' => true]);
        $this->addTax('cases_category', 'Categories', 'cases', ['show_in_rest' => true]);
    }

    /**
     * @param string $singular
     * @param string $plural
     * @param array $settings
     */
    protected function addPostType($singular, $plural, $settings = [])
    {
        $singular = strtolower($singular);
        $plural = strtolower($plural);
        $upperSingular = ucwords($singular);
        $upperPlural = ucwords($plural);

        register_post_type($singular, wp_parse_args($settings, [
            'labels' => [
                'all_items' => __('All ' . $upperPlural, 'sage'),
                'update_item' => __('Update ' . $singular, 'sage'),
                'add_new' => __('Add new ', 'sage'),
                'add_new_item' => __('Add new ', 'sage'),
                'edit_item' => __('Edit ' . $singular, 'sage'),
                'menu_name' => __($upperPlural, 'sage'),
                'name' => __($upperPlural, 'sage'),
                'new_item' => __('New ' . $singular, 'sage'),
                'not_found' => __('No ' . $plural . ' found', 'sage'),
                'not_found_in_trash' => __('No ' . $plural . ' found in Trash', 'sage'),
                'parent_item_colon' => '',
                'search_items' => __('Search ' . $plural, 'sage'),
                'singular_name' => __($upperSingular, 'sage'),
                'view_item' => __('View ' . $singular, 'sage'),
            ],
            'description' => $plural,
            'rewrite' => ['slug' => $singular],
            'public' => true,
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-admin-post',
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability_type' => 'post',
        ]));
    }

    /**
     * @param string $singular
     * @param string $plural
     * @param string $post_apply
     * @param array $settings
     */
    protected function addTax($singular, $plural, $post_apply = '', $settings = [])
    {
        $singular = strtolower($singular);
        $plural = strtolower($plural);
        $upperSingular = ucwords($singular);
        $upperPlural = ucwords($plural);

        register_taxonomy($singular, $post_apply, wp_parse_args($settings, [
            'hierarchical' => true,
            'labels' => [
                'add_new_item' => __('Add New ' . $upperPlural, 'sage'),
                'add_or_remove_items' => __('Add or remove ' . $plural, 'sage'),
                'all_items' => __('All ' . $upperPlural, 'sage'),
                'choose_from_most_used' => __('Choose from the most used ' . $plural, 'sage'),
                'edit_item' => __('Edit ' . $upperPlural, 'sage'),
                'name' => __($upperPlural, 'sage'),
                'menu_name' => __($upperPlural, 'sage'),
                'new_item_name' => __('New ' . $upperSingular . ' Name', 'sage'),
                'not_found' => __('No ' . $plural . ' found.', 'sage'),
                'parent_item' => __('Parent ' . $upperPlural, 'sage'),
                'parent_item_colon' => __('Parent ' . $upperPlural . ':', 'sage'),
                'popular_items' => __('Popular ' . $upperPlural, 'sage'),
                'search_items' => __('Search ' . $upperPlural, 'sage'),
                'separate_items_with_commas' => __('Separate ' . $plural . ' with commas', 'sage'),
                'singular_name' => __($upperSingular, 'sage'),
                'update_item' => __('Update ' . $upperPlural, 'sage'),
                'view_item' => __('View ' . $upperPlural, 'sage')
            ],
            'rewrite' => [
                'slug' => $singular, // This controls the base slug that will display before each term
                'with_front' => false, // Don't display the category base before "/slug/"
            ],
            'public' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => false,
            'publicly_queryable' => false,
        ]));
    }
}

new CustomPostType();

<?php

namespace App;

class Ajax
{
    /**
     * Ajax constructor.
     */
    public function __construct()
    {
        // call ajax to TemplateCustom controller
        add_action('wp_ajax_load_pagination', [$this, 'loadPagination']);
        add_action('wp_ajax_nopriv_load_pagination', [$this, 'loadPagination']);
    }

    /**
     * Filter Stories
     */
    public static function loadPagination()
    {
        $page = isset($_POST['paged']) ? $_POST['paged'] : 1;
        $type = isset($_POST['type']) ? $_POST['type'] : 'post';

        $post_query = get_wp_object_query($type, [
            'posts_per_page' => !empty(get_option('posts_per_page')) ? get_option('posts_per_page') : 11,
            'paged' => $page
        ]);

        echo template(
            get_template_slug($type),
            [
                'post_list' => $post_query->have_posts() ? array_map(function ($post) use ($type) {
                    return $type === 'jobs' ? get_job_article($post) : get_featured_article($post);
                }, $post_query->posts) : [],
                'post_query' => $post_query,
                'current' => $page
            ]
        );

        exit();
    }

}
new Ajax();

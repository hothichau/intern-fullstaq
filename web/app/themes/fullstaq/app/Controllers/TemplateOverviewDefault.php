<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use function App\get_featured_article;
use function App\get_wp_object_query;

class TemplateOverviewDefault extends Controller
{
    protected $query;

    public function __construct()
    {
        $this->query = get_wp_object_query($this->queriedPostType(), [
            'posts_per_page' => !empty(get_option('posts_per_page')) ? get_option('posts_per_page') : 11
        ]);
    }

    /**
     * @return array
     */
    public function postList()
    {
        return $this->query->have_posts() ? array_map(function ($post) {
            return get_featured_article($post);
        }, $this->query->posts) : [];
    }

    /**
     * @return \WP_Query
     */
    public function postQuery()
    {
        return $this->query;
    }

    public function queriedPostType()
    {
        return !empty(get_field('post_type')) ? get_field('post_type') : 'post';
    }
}

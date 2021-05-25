<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use function App\get_job_article;
use function App\get_wp_object_query;

class TemplateCareers extends Controller
{
    protected $query;

    use Partials\CareersSettings;

    public function __construct()
    {
        $this->query = get_wp_object_query('jobs', [
            'posts_per_page' => !empty(get_option('posts_per_page')) ? get_option('posts_per_page') : 11
        ]);
    }

    /**
     * @return array
     */
    public function postList()
    {
        return $this->query->have_posts() ? array_map(function ($post) {
            return get_job_article($post);
        }, $this->query->posts) : [];
    }

    /**
     * @return \WP_Query
     */
    public function postQuery()
    {
        return $this->query;
    }
}

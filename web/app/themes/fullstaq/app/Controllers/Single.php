<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use function App\get_featured_article;
use function App\get_primary_category;
use function App\get_wp_object_query;

class Single extends Controller
{
    /**
     * @return array
     */
    public function relatedPosts()
    {
        $related_category = get_primary_category(get_the_ID());

        if (!$related_category) {
            return [];
        }

        $post_query = get_wp_object_query('post', [
            'posts_per_page' => 3,
            'category__in' => $related_category->term_id,
            'post__not_in' => [get_the_ID()],
        ]);

        return $post_query->have_posts() ? array_map(function ($post) {
            return get_featured_article($post);
        }, $post_query->posts) : [];
    }

    /**
     * @return mixed
     */
    public function relatedCategoryLink()
    {
        return !empty(get_field('related_category_link')) ?  get_field('related_category_link') : get_field('opt_general_default_category_link', 'options');
    }
}

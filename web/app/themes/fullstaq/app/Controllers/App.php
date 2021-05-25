<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use function App\get_featured_article;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_404()) {
            return __('Page not found', 'fullstaq');
        }
        return get_the_title();
    }

    /**
     * @return string
     */
    public function siteLogo()
    {
        return get_field('opt_general_img_logo', 'option');
    }

    /**
     * @return string
     */
    public function pageIntro()
    {
        return get_field('page_intro');
    }

    /**
     * @return string
     */
    public function siteLogoMobile()
    {
        return get_field('opt_general_img_logo_mobile', 'option');
    }

    public function blogTitle()
    {
        return get_bloginfo('name', 'display');
    }

    /**
     * @return string
     */
    public function copyright()
    {
        return get_field('opt_general_copyright', 'option');
    }

    /**
     * @return array
     */
    public function primaryNavigation()
    {
        return [
            'theme_location' => 'primary_navigation',
            'menu_class' => 'navbar-nav',
            'container' => false,
            'walker' => new \App\wp_bootstrap4_navwalker(),
        ];
    }

    public function headerContactLink()
    {
        return get_field('header_contact_link', 'options');
    }

    /**
     * @return string
     */
    public function footerLogo()
    {
        return get_field('opt_general_img_logo_footer', 'option');
    }

    /**
     * @return array
     */
    public function footerColumns()
    {
        return [
            'column1' => [
                'title' => get_field('opt_foot_1_title', 'option'),
                'footer_link' => get_field('opt_foot1_link', 'option'),
            ],
            'column2' => [
                'title' => get_field('opt_foot_2_title', 'option'),
                'footer_link' => get_field('opt_foot2_link', 'option'),
            ],
            'column3' => [
                'title' => get_field('opt_foot_3_title', 'option'),
                'footer_link' => get_field('opt_foot3_link', 'option'),
            ],
            'column4' => [
                'title' => get_field('opt_foot_4_title', 'option'),
                'link' => get_field('opt_foot_4_link', 'option') ?: '#'
            ]
        ];
    }

    /**
     * @return array
     */
    public function footerSocialLinks()
    {
        return get_field('social_item', 'option') ? [ 'links' => get_field('social_item', 'option') ] : [];
    }

    /**
     * @return array
     */
    public static function getIconsBlockData()
    {
        return wp_parse_args(
            [
                'icons' => have_rows('icons') ? get_field('icons') : []
            ],
            self::getBlockProperties()
        );
    }

    /**
     * @return array
     */

    public static function getServiceBlockData()
    {
        return wp_parse_args(
            [
                'feature_image' => get_field('feature_image'),
                'item_list' => have_rows('item_list') ? get_field('item_list') : []
            ],
            self::getBlockProperties()
        );
    }

    /**
     * @return array
     */
    public static function getImageTextBlockData()
    {
        $image_id = get_field('image');

        return wp_parse_args(
            [
                'image_position' => get_field('image_position'),
                'image' => wp_get_attachment_image_url($image_id, 'image_text_block'),
                'image_2x' => wp_get_attachment_image_url($image_id, 'image_text_block_2x') ? 'srcset="' . wp_get_attachment_image_url($image_id, 'image_text_block_2x') .  ' 2x"' : '',
                'content' => get_field('content')
            ],
            self::getBlockProperties()
        );
    }

    /**
     * @return array
     */
    public static function getFeaturedBlockData()
    {
        $featured_article_1_id = get_field('featured_article_1');
        $featured_article_2_id = get_field('featured_article_2');
        $featured_article_3_id = get_field('featured_article_3');

        if (empty($featured_article_1_id) || empty($featured_article_2_id) || empty($featured_article_3_id)) {
            return [];
        }

        $featured_article_1 = get_post($featured_article_1_id);
        $featured_article_2 = get_post($featured_article_2_id);
        $featured_article_3 = get_post($featured_article_3_id);

        if (empty($featured_article_1) || empty($featured_article_2) || empty($featured_article_3)) {
            return [];
        }

        return wp_parse_args(
            [
                'featured_article_1' => get_featured_article($featured_article_1),
                'featured_article_2' => get_featured_article($featured_article_2),
                'featured_article_3' => get_featured_article($featured_article_3),
                'layout_style' => get_field('layout_style'),
                'link' => get_field('link')
            ],
            self::getBlockProperties()
        );
    }

    /**
     * @return array
     */
    public static function getBannerBlockData()
    {
        return wp_parse_args(
            [
                'banner_image' => get_field('banner_image'),
                'banner_content' => get_field('content')
            ],
            self::getBlockProperties()
        );
    }

    /**
     * @return array
     */
    public static function getContactBlockData()
    {
        $form_id = get_field('form');

        if (empty($form_id)) {
            return [];
        }

        return wp_parse_args(
            [
                'banner_image' => get_field('banner'),
                'banner_content' => get_field('content'),
                'phone' => get_field('phone'),
                'address' => get_field('address'),
                'form' => $form_id
            ],
            self::getBlockProperties()
        );
    }

    /**
     * @return array
     */
    private static function getBlockProperties()
    {
        $id = get_field('block_id');
        return [
            'block_id' => !empty($id) ? 'id="' . sanitize_title($id) . '"' : '',
            'block_title' => get_field('block_title')
        ];
    }


}

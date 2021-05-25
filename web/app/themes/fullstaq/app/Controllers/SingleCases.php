<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class SingleCases extends Controller
{
    /**
     * @return mixed
     */
    public function serviceBlock()
    {
        $service_block = !empty(array_filter(get_field('cases_service_block'))) ? get_field('cases_service_block') : get_field('opt_adv_cases_service_block', 'options');

        return [
            'column_1' => self::generateBlockData($service_block['title_1'], $service_block['icon_1_image'], $service_block['icon_1_image_2x'], $service_block['txt_1']),
            'column_2' => self::generateBlockData($service_block['title_2'], $service_block['icon_2_image'], $service_block['icon_2_image_2x'], $service_block['txt_2']),
            'column_3' => self::generateBlockData($service_block['title_3'], $service_block['icon_3_image'], $service_block['icon_3_image_2x'], '', $service_block['column_links']),
        ];
    }

    private static function generateBlockData($title, $icon, $icon_2x, $txt = '', $links = [])
    {
        return [
            'title' => $title,
            'txt' => $txt,
            'icon' => [
                'ico' =>$icon,
                'ico_2x' => !empty($icon_2x) ? ' srcset="' . $icon_2x . ' 2x"' : ''
            ],
            'links' => $links
        ];
    }
}


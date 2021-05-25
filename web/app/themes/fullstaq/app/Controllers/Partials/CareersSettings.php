<?php

namespace App\Controllers\Partials;

trait CareersSettings
{
    /**
     * @return string
     */
    public function headerBackground()
    {
        $background_url = get_field('header_background');
        return !empty($background_url) ? 'style="background-image:url(' . $background_url . ')"' : '';
    }

    /**
     * @return mixed
     */
    public function headerButton()
    {
        return get_field('header_button');
    }

}

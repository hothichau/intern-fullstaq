<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class FrontPage extends Controller
{
    /**
     * @return mixed
     */
    public function headerBanner()
    {
        return get_field('header_banner');
    }
}

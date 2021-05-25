<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class FourZeroFour extends Controller
{
    protected $template = '404';

    public function contentInfo()
    {
        return get_field('opt_general_404', 'options');
    }
}

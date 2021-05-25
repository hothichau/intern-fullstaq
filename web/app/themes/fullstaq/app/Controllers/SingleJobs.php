<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class SingleJobs extends Controller
{
    use Partials\CareersSettings;

    public function jobTags()
    {
        $tags = get_the_terms(get_the_ID(), 'jobs_tag');
        return is_array($tags) ? implode(' | ', wp_list_pluck($tags, 'name')) : [];
    }
}

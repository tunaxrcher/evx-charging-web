<?php

namespace App\Controllers;

class General extends BaseController
{
    public function __construct()
    {
        /*
        | -------------------------------------------------------------------------
        | SET ENVIRONMENT
        | -------------------------------------------------------------------------
        */

        /*
        | -------------------------------------------------------------------------
        | SET UTILITIES
        | -------------------------------------------------------------------------
        */

        // Model

    }

    public function news()
    {
        $data['content'] = 'general/news';
        $data['title'] = 'ข่าวสาร';
        echo view('/app', $data);
    }

    public function problemReport()
    {
        $data['content'] = 'general/problem-report';
        $data['title'] = 'รายงานปัญหา';
        echo view('/app', $data);
    }
}
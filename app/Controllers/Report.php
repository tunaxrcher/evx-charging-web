<?php

namespace App\Controllers;

class Report extends BaseController
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

    public function index()
    {
        $data['content'] = 'report/index';
        $data['title'] = 'Report';
        echo view('/app', $data);
    }
}
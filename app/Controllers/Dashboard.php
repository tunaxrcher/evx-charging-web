<?php

namespace App\Controllers;

class Dashboard extends BaseController
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
        $data['content'] = 'dashboard/index';
        $data['title'] = 'แดชบอร์ด';
        echo view('/app', $data);
    }
}
<?php

namespace App\Controllers;

class Booking extends BaseController
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
        $data['content'] = 'booking/index';
        $data['title'] = 'Booking';
        echo view('/app', $data);
    }
}
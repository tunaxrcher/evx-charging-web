<?php

namespace App\Controllers;

class Wallet extends BaseController
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
        $data['content'] = 'wallet/index';
        $data['title'] = 'Wallet';
        echo view('/app', $data);
    }

    public function topup()
    {
        $data['content'] = 'wallet/topup';
        $data['title'] = 'Topup';
        echo view('/wallet/topup', $data);
    }
}

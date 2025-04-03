<?php

namespace App\Controllers;

use App\Libraries\BackupOcpp;
use App\Libraries\Ocpp;

class Test extends BaseController
{
    public function index()
    {
        // $ocpp = new BackupOcpp();
        // $ocpp->login();
        // exit();

        $ocpp = new Ocpp();
        $ocpp->login()->remoteStart();
        // $ocpp->login()->remoteStatus();
        $ocpp->login()->remoteStop();

        exit();
    }

    public function remoteStart()
    {
        $ocpp = new Ocpp();
        $ocpp->login()->remoteStart();
        exit();
    }

    // public function remoteStatus()
    // {
    //     $ocpp = new Ocpp();
    //     $ocpp->login()->remoteStatus();
    //     exit();
    // }

    public function remoteStop()
    {
        $ocpp = new Ocpp();
        $ocpp->login()->remoteStop();
        exit();
    }
}

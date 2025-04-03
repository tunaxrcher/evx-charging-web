<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AltherTableSummaryChargerUser2 extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $db->query("ALTER TABLE `summary_user_chager` ADD `sum_min` TEXT NULL AFTER `country`");
    }

    public function down()
    {
        //
    }
}

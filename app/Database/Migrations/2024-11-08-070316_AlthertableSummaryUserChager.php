<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlthertableSummaryUserChager extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $db->query("ALTER TABLE `summary_user_chager` ADD `country` varchar(100) NULL NULL AFTER `connecter_pk`");
    }

    public function down()
    {
        //
    }
}

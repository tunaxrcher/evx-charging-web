<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTransactions extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $sql = "ALTER TABLE transactions ADD transectionstate varchar(45) NULL DEFAULT NULL AFTER credit";
        $db->query($sql);

        $sql_1 = "ALTER TABLE transactions ADD cp_id varchar(45) NULL DEFAULT NULL AFTER transectionstate";
        $db->query($sql_1);

        $sql_2 = "ALTER TABLE transactions ADD connecter_id  int(10) NULL DEFAULT NULL AFTER cp_id";
        $db->query($sql_2);

        $sql_3 = "ALTER TABLE transactions ADD id_tag varchar(45) NULL DEFAULT NULL AFTER connecter_id";
        $db->query($sql_3);

        $sql_4 = "ALTER TABLE transactions ADD transection_pk  int(10) NULL DEFAULT NULL AFTER id_tag";
        $db->query($sql_4);

        $sql_5 = "ALTER TABLE transactions ADD connecter_pk  int(10) NULL DEFAULT NULL AFTER transection_pk";
        $db->query($sql_5);
    }

    public function down()
    {
        //
    }
}

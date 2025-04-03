<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSummaryUserCharger extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $sql = "CREATE TABLE `summary_user_chager` (`id` INT NOT NULL AUTO_INCREMENT ,`user_id` VARCHAR(100) NULL,`sum_price` decimal(10,2) NOT NULL,`sum_Kw` decimal(10,2) NOT NULL,`credit` decimal(10,2) NOT NULL,`cp_id` VARCHAR(45) NULL,`connecter_id` int NULL,`id_tag` VARCHAR(45) NULL,`transection_pk` int NULL,`connecter_pk` int NULL ,`created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME NULL DEFAULT NULL  , PRIMARY KEY (`id`))";
        $db->query($sql);
    }

    public function down()
    {
        //
    }
}

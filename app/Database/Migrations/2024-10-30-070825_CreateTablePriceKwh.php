<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePriceKwh extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $sql = "CREATE TABLE `price_Kwh` (`id` INT NOT NULL AUTO_INCREMENT , `price_Kw` decimal(10,2) NOT NULL , `monetary_unit` VARCHAR(100)  NULL, `status` VARCHAR(100) NULL, `country` VARCHAR(100) NULL  ,`created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME NULL DEFAULT NULL , `deleted_at` DATETIME NULL DEFAULT NULL , PRIMARY KEY (`id`))";
        $db->query($sql);
    }

    public function down()
    {
        //
    }
}

<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class UserLoginDetailModel
{

    protected $db;

    public function __construct()
    {
        $db = \Config\Database::connect();
        $this->db = &$db;
    }

    public function insertUserLoginDetail($data)
    {
        $builder = $this->db->table('user_login_details');

        return $builder->insert($data) ? $this->db->insertID() : false;
    }

    public function updateUserLoginDetailByID($id, $data)
    {
        $builder = $this->db->table('user_login_details');

        return $builder->where('id', $id)->update($data);
    }

    public function getUserOnline($UserID)
    {
        $sql = "
            SELECT *
            FROM user_login_details  
            WHERE last_activity > DATE_SUB(NOW(), INTERVAL 3600 SECOND) AND User_id = '$UserID' AND active = '1' ORDER BY id DESC LIMIT 1
        ";

        $builder = $this->db->query($sql);

        return $builder->getRow();
    }

    public function getUserOffline($UserID)
    {
        $sql = "
            SELECT *
            FROM user_login_details  
            WHERE User_id = '$UserID' ORDER BY id DESC LIMIT 1
        ";

        $builder = $this->db->query($sql);

        return $builder->getRow();
    }

}
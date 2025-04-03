<?php

namespace App\Controllers;

use App\Libraries\Evx;

class Profile extends BaseController
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
    }

    public function index()
    {
        $data['content'] = 'profile/index';
        $data['title'] = 'บัญชีผู้ใช้งาน';
        $data['css_critical'] = '';
        $data['js_critical'] = '
            <script src="' . base_url('/app/profile/index.js') . '"></script>
        ';
        echo view('/app', $data);
    }

    public function history()
    {
        $data['content'] = 'profile/history';
        $data['title'] = 'ประวัติ';
        $data['css_critical'] = '<link rel="stylesheet" href="../assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />';
        $data['js_critical'] = '
            <script src="' . base_url('/assets/libs/datatables.net/js/jquery.dataTables.min.js') . '"></script>
            <script src="' . base_url('/assets/js/datatable/datatable-basic.init.js') . '"></script>
            <script src="' . base_url('/app/profile/history.js') . '"></script>
        ';
        echo view('/app', $data);
    }

    public function update()
    {
        try {
            // SET CONFIG
            $status = 500;
            $response['success'] = 0;
            $response['message'] = '';

            $fullname = $this->request->getVar('fullname');

            $update = $this->evxApi->updateUser(session()->get('userID'), [
                'fullname' => $fullname
            ]);

            if ($update) {
                // logger_store([
                //     'user_id' => session()->get('userID'),
                //     'username' => session()->get('username'),
                //     'event' => 'อัพเดท',
                //     'detail' => '[อัพเดท] ข้อมูลส่วนตัว',
                //     'ip' => $this->request->getIPAddress()
                // ]);
                $status = 200;
                $response['success'] = 1;
                $response['message'] = 'แก้ไข ข้อมูลส่วนตัว สำเร็จ';

                $user = $this->evxApi->user(session()->get('userID'));

                $response['data'] = $user;
            } else {
                $status = 200;
                $response['success'] = 0;
                $response['message'] = 'แก้ไข ข้อมูลส่วนตัว ไม่สำเร็จ';
            }

            return $this->response
                ->setStatusCode($status)
                ->setContentType('application/json')
                ->setJSON($response);
        } catch (\Exception $e) {
            echo $e->getMessage() . ' ' . $e->getLine();
        }
    }

    public function data()
    {
        try {
            // SET CONFIG
            $status = 500;
            $response['success'] = 0;
            $response['message'] = '';

            if (true) {

                $status = 200;
                $response['success'] = 1;
                $response['message'] = '';

                $user = $this->evxApi->user(session()->get('userID'));

                $response['data'] = $user;
            } else {
                $status = 200;
                $response['success'] = 0;
                $response['message'] = 'แก้ไข ข้อมูลส่วนตัว ไม่สำเร็จ';
            }

            return $this->response
                ->setStatusCode($status)
                ->setContentType('application/json')
                ->setJSON($response);
        } catch (\Exception $e) {
            echo $e->getMessage() . ' ' . $e->getLine();
        }
    }

    // public function updatePassword()
    // {
    //     $this->EmployeeModel = new \App\Models\EmployeeModel();
    //     try {
    //         // SET CONFIG
    //         $status = 500;
    //         $response['success'] = 0;
    //         $response['message'] = '';

    //         $id = $this->request->getVar('EmployeeId');
    //         $password = $this->request->getVar('new_password');
    //         $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //         // HANDLE REQUEST
    //         $update = $this->EmployeeModel->updateEmployeeByID($id, [
    //             'password' => $hashed_password,
    //             'updated_by' => session()->get('username'),
    //             'updated_at' => date('Y-m-d H:i:s')
    //         ]);

    //         if ($update) {

    //             logger_store([
    //                 'employee_id' => session()->get('employeeID'),
    //                 'username' => session()->get('username'),
    //                 'event' => 'อัพเดท',
    //                 'detail' => '[อัพเดท] ข้อมูลส่วนตัว',
    //                 'ip' => $this->request->getIPAddress()
    //             ]);
    //             $status = 200;
    //             $response['success'] = 1;
    //             $response['message'] = 'แก้ไข ข้อมูลส่วนตัว สำเร็จ';
    //         } else {
    //             $status = 200;
    //             $response['success'] = 0;
    //             $response['message'] = 'แก้ไข ข้อมูลส่วนตัว ไม่สำเร็จ';
    //         }

    //         return $this->response
    //             ->setStatusCode($status)
    //             ->setContentType('application/json')
    //             ->setJSON($response);
    //     } catch (\Exception $e) {
    //         echo $e->getMessage() . ' ' . $e->getLine();
    //     }
    // }
}

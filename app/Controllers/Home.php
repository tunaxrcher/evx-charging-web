<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('/auth/login');
    }

    public function register()
    {
        $this->request->getMethod();

        switch ($this->request->getMethod()) {
            case 'get':
                return view('/auth/register');
                break;

            case 'post':
                try {
                    // SET CONFIG
                    $status = 500;
                    $response['success'] = 0;
                    $response['message'] = '';

                    $email = $this->request->getVar('email');
                    $password = $this->request->getVar('password');

                    $evxCreateUser = $this->evxapi->createUser([
                        'email' => $email,
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                    ]);

                    if ($evxCreateUser->statusCode == 999) {
                        $status = 200;
                        $response['success'] = 0;
                        $response['message'] = 'มีอีเมลนี้แล้วในระบบ';
                    }

                    if ($evxCreateUser->statusCode == 201) {
                        if ($evxCreateUser) {
                            $status = 200;
                            $response['success'] = 1;
                            $response['message'] = 'สำเร็จ';
                        } else {
                            $status = 200;
                            $response['success'] = 0;
                            $response['message'] = 'ไม่สำเร็จ';
                        }
                    }

                    return $this->response
                        ->setStatusCode($status)
                        ->setContentType('application/json')
                        ->setJSON($response);
                } catch (\Exception $e) {
                    echo $e->getMessage() . ' ' . $e->getLine();
                }
                break;
        }
    }
}

<?php

namespace App\Controllers;

class Authentication extends BaseController
{

    public function login()
    {
        $status = 500;
        $response['success'] = 0;
        $response['message'] = '';

        try {

            if ($this->request->getMethod() != 'post') throw new \Exception('Invalid Credentials.');

            $requestPayload = $this->request->getJSON();
            $email = $requestPayload->username ?? null;
            $password = $requestPayload->password ?? null;

            if (!$email || !$password) throw new \Exception('กรุณาตรวจสอบ username หรือ password ของท่าน');

            $login = $this->evxApi->login([
                'email' => $email,
                'password' => $password,
            ]);

            if ($login) {

                $user = $login->data;

                session()->set([
                    'userID' => $user->id,
                    'username' => $user->email,
                    'isUserLoggedIn' => true,
                    'accessToken' => $user->accessToken,
                    'refreshToken' => $user->refreshToken,
                ]);

                // logger_store([
                //     'user_id' => $user->id,
                //     'username' => $user->email,
                //     'email' => $user->email,
                //     'event' => 'เข้าสู่ระบบ',
                //     'detail' => 'เข้าสู่ระบบ EVX',
                //     'ip' => $this->request->getIPAddress()
                // ]);

                $status = 200;
                $response['success'] = 1;
                $response['message'] = 'เข้าสู่ระบบสำเร็จ';

                $response['redirect_to'] = base_url('/charging/index');
            }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return $this->response
            ->setStatusCode($status)
            ->setContentType('application/json')
            ->setJSON($response);
    }

    public function logout()
    {
        try {

            // logger_store([
            //     'user_id' => session()->get('userID'),
            //     'username' => session()->get('username'),
            //     'event' => 'ออกจากระบบ',
            //     'detail' => 'ออกจากระบบ EVX',
            //     'ip' => $this->request->getIPAddress()
            // ]);

            session()->destroy();

            return redirect()->to('/');
        } catch (\Exception $e) {
            // echo $e->getMessage();
        }
    }
}

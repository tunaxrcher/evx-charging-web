<?php

namespace App\Filters;

use App\Libraries\Evx;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UserActivity implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Fix Bug แก้ไขปัญหากรณีพนักงานถูกลบไอดีแล้ว ให้ออกจากระบบทันที
        $evxApi = new Evx([
            'baseUrl' => getenv('EVX_API'),
            'system' => getenv('EVX_SYSTEM'),
            'key' => getenv('EVX_KEY'),
            'accessToken' => session()->get('accessToken'),
            'refreshToken' => session()->get('refreshToken'),
        ]);
        $user = $evxApi->user(session()->get('userID'));

        if (!$user) {
            session()->destroy();
            session()->setFlashdata(['session_expired' => 'เซ็นซันหมดอายุ กรุณาล็อคอินอีกครั้ง']);
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}

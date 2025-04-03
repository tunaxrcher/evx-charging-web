<?php

namespace App\Libraries;

class BackupOcpp
{
    private $http;
    private $headers;
    private $credential = [];
    private $debug = false;

    public function __construct($credential = [])
    {
        $this->headers = [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36',
        ];

        $this->credential = [];

        $this->http = new \GuzzleHttp\Client([
            'headers' => $this->headers,
            // 'cookies' => true
        ]);
    }

    public function setDebug($value)
    {
        $this->debug = $value;
    }

    // 1. login
    public function login()
    {
        try {

            $endPoint = 'http://209.97.162.177:8180/steve/manager/signin';

            $response = $this->http->request('POST', $endPoint, [
                'query' => [
                    'username' => 'admin',
                    'password' => '1234'
                ],
            ]);

            px($response->getBody()->getContents());

            $data = json_decode($response->getBody());

            $statusCode = isset($data->code) ? (int) $data->code : false;

            if ($statusCode === 0) return true;

            return false;
        } catch (\Exception $e) {

            log_message('error', 'Ocpp::login error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function start()
    {
        try {

            $endPoint = 'http://209.97.162.177:8180/steve/manager/start';

            $response = $this->http->request('POST', $endPoint, [
                'query' => [
                    'username' => 'admin',
                    'password' => '1234'
                ],
            ]);

            px($response->getBody()->getContents());

            $data = json_decode($response->getBody());

            $statusCode = isset($data->code) ? (int) $data->code : false;

            if ($statusCode === 0) return true;

            return false;
        } catch (\Exception $e) {

            log_message('error', 'Ocpp::login error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }
}

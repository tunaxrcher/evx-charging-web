<?php

namespace App\Libraries;

use \GuzzleHttp\Client;
use \GuzzleHttp\Handler\CurlHandler;
use \GuzzleHttp\HandlerStack;
use \GuzzleHttp\Middleware;
use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;

class Evx
{
    private $http;
    private $baseURL;
    private $headers;
    private $credentials = [];
    private $accessToken;
    private $refreshToken;
    private $debug = false;

    public function __construct($config)
    {
        $this->setCredentials($config['system'], $config['key']);

        $this->baseURL = $config['baseUrl'];

        $this->accessToken = $config['accessToken'] ?? '';

        $this->refreshToken = $config['refreshToken'] ?? '';

        $stack = new HandlerStack();

        $stack->setHandler(new CurlHandler());

        $stack->push(Middleware::mapRequest(function (RequestInterface $Request) {
            $request = $Request;

            $this->lastRequest = $request;

            return $request;
        }));

        $stack->push(Middleware::mapResponse(function (ResponseInterface $Response) {

            $statusCode = $Response->getStatusCode();

            if ($statusCode === 401) {

                $refreshToken = $this->refreshToken();

                if ($refreshToken) {

                    $lastRequest = $this->lastRequest;

                    $url = (string) $lastRequest->getUri();
                    $method = (string) $lastRequest->getMethod();
                    // $header = $lastRequest->getHeaders();
                    $body = $lastRequest->getBody();

                    $response = $this->http->request($method, $url, [
                        'headers' => [
                            'Authorization' => "Bearer " . $this->refreshToken
                        ],
                        'body' => $body,
                    ]);

                    return $response;
                } else {
                    // TODO:: Handle มีปัญหาเมื่อขอ Refresh Token ไม่ได้ ซึ่งอาจจะเกิดจาก Server ดับ หรืออะไรก็แล้วแต่
                }
            }

            return $Response;
        }));

        $option = ['handler' => $stack];

        $this->http = new Client($option);
    }

    private function setCredentials($system, $key)
    {
        $this->credentials['system'] = $system;
        $this->credentials['key'] = $key;
    }

    public function setDebug($value)
    {
        $this->debug = $value;
    }

    /*********************************************************************
     * 1. Authentication
     */

    // Login
    public function login($data)
    {
        try {

            $endPoint = $this->baseURL . '/auth/login/';

            $response = $this->http->request('POST', $endPoint, [
                'json' => [
                    'email' => $data['email'],
                    'password' => $data['password']
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::login error {username} {message}', ['username' => $data['email'], 'message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    // Token
    public function refreshToken()
    {
        try {

            $http = new \GuzzleHttp\Client();

            $endPoint = $this->baseURL . '/auth/refresh/';

            $response = $http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->refreshToken
                ],
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) {

                $this->accessToken = $data->data->accessToken;
                $this->refreshToken = $data->data->refreshToken;

                session()->set([
                    'accessToken' => $this->accessToken,
                    'refreshToken' => $this->refreshToken,
                ]);

                return true;
            }

            return redirect()->to('/logout');
        } catch (\Exception $e) {
            log_message('error', 'EVX::login error {username} {message}', ['refresh' => $this->refreshToken, 'message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    /*********************************************************************
     * 2. User | ระบบสมาชิก
     */

    // Get data User
    public function user($id)
    {
        try {
            $endPoint = $this->baseURL . '/user/' . $id;

            $response = $this->http->request('GET', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::user error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    // Create User
    public function createUser($data)
    {
        try {

            $endPoint = $this->baseURL . '/user/create/';

            $response = $this->http->request('POST', $endPoint, [
                'json' => [
                    'email' => $data['email'],
                    'password' => $data['password']
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 999) return $data;

            if ($statusCode === 0 || $statusCode === 201) return $data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::createUser error {username} {message}', ['username' => $this->credentials['agent'] . $data['username'], 'message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    // Change Password    
    public function changePasswordUser($username, $password)
    {
        try {

            $endPoint = $this->baseURL . '/user/changePassword/';

            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    'username' => $username,
                    'password' => $password
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0) return true;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::changePassword error {message}', ['message' => 'message:' . $e->getMessage()]);
            return false;
        }
    }

    // Update Detail
    public function updateUser($id, $data)
    {
        try {

            $endPoint = $this->baseURL . '/user/update/';

            // TODO:: HANDLE
            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    'id' => $id,
                    'fullname' => $data['fullname']
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return true;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::updateUser error {message}', ['message' => 'message:' . $e->getMessage()]);
            return false;
        }
    }

    public function getActivePriceKw()
    {
        try {
            $endPoint = $this->baseURL . '/ev_station/getActivePriceKw';

            $response = $this->http->request('GET', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getAllOwnerStations error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    /*********************************************************************
     * 3. Owner Station | เจ้าของสถานี
     */

    public function getAllOwnerStations()
    {
        try {
            $endPoint = $this->baseURL . '/owner-station/';

            $response = $this->http->request('GET', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getAllOwnerStations error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function getOwnerStation($id)
    {
        try {
            $endPoint = $this->baseURL . '/owner-station/' . $id;

            $response = $this->http->request('GET', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getOwnerStation error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function updateOwnerStation($id, $data)
    {
        try {

            $endPoint = $this->baseURL . '/owner-station/update/';

            // TODO:: HANDLE
            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    'id' => $id,
                    'description' => $data['description']
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return true;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::updateOwnerStation error {message}', ['message' => 'message:' . $e->getMessage()]);
            return false;
        }
    }

    /*********************************************************************
     * 4. Stations | สถานี
     */

    public function getAllStations()
    {
        try {
            $endPoint = $this->baseURL . '/station/';

            $response = $this->http->request('GET', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getAllStations error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function getStation($id)
    {
        try {
            $endPoint = $this->baseURL . '/station/' . $id;

            $response = $this->http->request('GET', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getStation error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function updateStation($id, $data)
    {
        try {

            $endPoint = $this->baseURL . '/station/update/';

            // TODO:: HANDLE
            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    'id' => $id,
                    'description' => $data['description']
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return true;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::updateStation error {message}', ['message' => 'message:' . $e->getMessage()]);
            return false;
        }
    }

    /*********************************************************************
     * 5. Charge Point | ตู้ชาจ
     */

    public function getAllChargePoints()
    {
        try {
            $endPoint = $this->baseURL . '/charge-point/';

            $response = $this->http->request('GET', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getAllChargePoints error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function getChargePoint($id)
    {
        try {
            $endPoint = $this->baseURL . '/charge-point/' . $id;

            $response = $this->http->request('GET', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getChargePoint error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function getChargePointSteve($evx)
    {

        try {
            $endPoint = $this->baseURL . '/ev_station/getEVStation';

            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    'charge_box_id' => $evx['charge_box_id']
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getChargePointByStatus error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function getConnectorSteve($evx)
    {

        try {
            $endPoint = $this->baseURL . '/ev_station/getConnecter';

            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    'charge_box_id' => $evx['charge_box_id'],

                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getConnectorSteve error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function getStartTransectionLast($evx)
    {
        try {
            $endPoint = $this->baseURL . '/ev_station/getStartTransectionLast';

            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    'connector_pk' => $evx['connector_pk'],
                    'id_tag' => $evx['id_tag'],
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getConnectorSteve error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function getConnectorStatusSteve($evx)
    {

        try {
            $endPoint = $this->baseURL . '/ev_station/getConnecterStatus';

            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    'ev_chargepoint_name' => $evx['charge_box_id'],
                    'connector_pk' =>  $evx['connector_pk'],
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getConnectorSteve error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function getChargePointByStatus($status)
    {
        try {
            $endPoint = $this->baseURL . '/charge-point/';

            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    'status' => $status,
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getChargePointByStatus error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function updateChargePoint($id, $data)
    {
        try {

            $endPoint = $this->baseURL . '/charge-point/update/';

            // TODO:: HANDLE
            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    'id' => $id,
                    'status' => $data['status']
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return true;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::updateChargePoint error {message}', ['message' => 'message:' . $e->getMessage()]);
            return false;
        }
    }

    public function transection_state($evx)
    {
        try {

            $endPoint = $this->baseURL . '/ev_station/addTransection';

            // TODO:: HANDLE
            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    "type" => $evx['type'],
                    "user_id" => $evx['user_id'],
                    "credit" => $evx['credit'],
                    "transectionstate" => $evx['transectionstate'],
                    "cp_id" => $evx['cp_id'],
                    "connecter_id" => $evx['connecter_id'],
                    "id_tag" => $evx['id_tag'],
                    "transection_pk" => $evx['transection_pk'],
                    "connecter_pk" => $evx['connecter_pk']
                ]
            ]);


            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return true;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::updateChargePoint error {message}', ['message' => 'message:' . $e->getMessage()]);
            return false;
        }
    }

    public function getActiveChecgerData($evx)
    {
        try {
            $endPoint = $this->baseURL . '/ev_station/getActiveChecgerData';

            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    'transaction_pk' => $evx['transaction_pk'],
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getConnectorSteve error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function getActiveTransections($evx)
    {
        try {
            $endPoint = $this->baseURL . '/ev_station/getActiveTransections';

            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    'user_id' => $evx['user_id'],
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getConnectorSteve error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function getTransectionsFinish($evx)
    {
        try {
            $endPoint = $this->baseURL . '/ev_station/getTransectionsFinish';

            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    "transactionId" =>  $evx['transactionId'],
                    "state" =>  $evx['state']
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getConnectorSteve error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function getStatusConnecterFinish($evx)
    {
        try {
            $endPoint = $this->baseURL . '/ev_station/getConnectorFinish';

            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    "connector_pk" =>  $evx['connector_pk']
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getConnectorSteve error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function updatePriceKw($evx)
    {
        try {
            $endPoint = $this->baseURL . '/ev_station/updatePriceKw';

            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    "id_price" =>  $evx['id_price'],
                    "price_Kw" =>  $evx['price_Kw'],
                    "monetary_unit" =>  $evx['monetary_unit']
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getConnectorSteve error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function insertPriceKw($evx)
    {
        try {
            $endPoint = $this->baseURL . '/ev_station/addnewPriceKw';

            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    "price_Kw" =>  $evx['price_Kw'],
                    "monetary_unit" =>  $evx['monetary_unit']
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getConnectorSteve error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    } 
    public function summaryChargerUser($evx)
    {
        try {

            $endPoint = $this->baseURL . '/ev_station/summaryChargerUser';

            // TODO:: HANDLE
            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [               
                    "user_id" => $evx['user_id'],
                    "sum_price" => $evx['sum_price'],
                    "sum_Kw" => $evx['sum_Kw'],
                    "credit" => $evx['credit'],                
                    "cp_id" => $evx['cp_id'],
                    "connecter_id" => $evx['connecter_id'],
                    "id_tag" => $evx['id_tag'],
                    "transection_pk" => $evx['transection_pk'],
                    "connecter_pk" => $evx['connecter_pk'],
                    "country" => $evx['country'],
                    "sum_min" => $evx['sum_min']
                ]
            ]);


            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return true;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::updateChargePoint error {message}', ['message' => 'message:' . $e->getMessage()]);
            return false;
        }
    }

    

    /*********************************************************************
     * 6. Booking ...
     */

    /*********************************************************************
     * 7. Topup | ระบบเติมเงิน
     */

    public function getAllDeposit()
    {
        try {
            $endPoint = $this->baseURL . '/deposit/';

            $response = $this->http->request('GET', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getAllDeposit error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function getDeposit($id)
    {
        try {
            $endPoint = $this->baseURL . '/deposit/' . $id;

            $response = $this->http->request('GET', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getDeposit error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function updateDeposit($id, $data)
    {
        try {

            $endPoint = $this->baseURL . '/deposit/update/';

            // TODO:: HANDLE
            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    'id' => $id,
                    'status' => $data['status']
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return true;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::updateDeposit error {message}', ['message' => 'message:' . $e->getMessage()]);
            return false;
        }
    }

    public function getAllWithdraw()
    {
        try {
            $endPoint = $this->baseURL . '/withdraw/';

            $response = $this->http->request('GET', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getAllWithdraw error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function getWithdraw($id)
    {
        try {
            $endPoint = $this->baseURL . '/withdraw/' . $id;

            $response = $this->http->request('GET', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return $data->data;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::getWithdraw error {message}', ['message' => 'message:' . $e->getMessage()]);

            return false;
        }
    }

    public function updateWithdraw($id, $data)
    {
        try {

            $endPoint = $this->baseURL . '/withdraw/update/';

            // TODO:: HANDLE
            $response = $this->http->request('POST', $endPoint, [
                'headers' => [
                    'Authorization' => "Bearer " . $this->accessToken
                ],
                'json' => [
                    'id' => $id,
                    'status' => $data['status']
                ]
            ]);

            $data = json_decode($response->getBody());

            $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;

            if ($statusCode === 0 || $statusCode === 200) return true;

            return false;
        } catch (\Exception $e) {
            log_message('error', 'EVX::updateWithdraw error {message}', ['message' => 'message:' . $e->getMessage()]);
            return false;
        }
    }

    /*********************************************************************
     * 8. Report | รายงาน & ประวัติ
     */

    // TODO:: HANDLE

    
    /*********************************************************************
     * 11. Map | แผนที่ รายละเอียดแผนที่
     */

     public function getEvStationDetailMap()
     {
         try {
             $endPoint = $this->baseURL . '/map/getEvStationDetailMap';
 
             $response = $this->http->request('GET', $endPoint, [
                 'headers' => [
                     'Authorization' => "Bearer " . $this->accessToken
                 ],
             ]);
 
             $data = json_decode($response->getBody());
 
             $statusCode = isset($data->statusCode) ? (int) $data->statusCode : false;
 
             if ($statusCode === 0 || $statusCode === 200) return $data->data;
 
             return false;
         } catch (\Exception $e) {
             log_message('error', 'EVX::getAllChargePoints error {message}', ['message' => 'message:' . $e->getMessage()]);
 
             return false;
         }
     }
}

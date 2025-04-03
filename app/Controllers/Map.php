<?php

namespace App\Controllers;

class Map extends BaseController
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

        // Model

    }

    public function index()
    {
        $data['content'] = 'map/index';
        $data['title'] = 'Map';
        $data['css_critical'] = '
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        ';
        // $data['js_critical'] = '
        //     <script src="https://geonine.io/galvanic/bundles/jquery?v=2u0aRenDpYxArEyILB59ETSCA2cfQkSMlxb6jbMBqf81"></script>
        //     <script src="https://geonine.io/galvanic/bundles/jqueryval?v=m3KdtKGknztXn2nVX7H34q3CKPF1DlhsvuVAJYrQfMk1"></script>
        //     <script src="https://geonine.io/galvanic/plugins/metisMenu?v=lX3z5tSNjqKf9dJbUlN8hxZPs8-QOZcSMSAXXTflEKU1"></script>
        //     <script src="https://geonine.io/galvanic/plugins/pace?v=T0xxEq2YEiraT0k37gLqzlpoxdcu1Dwr81r_VU-cH6Q1"></script>
        //     <script src="https://geonine.io/galvanic/plugins/slimScroll?v=Uin95EwzswHK3MjnPYJT0IIu_sfIoxGwdr5n_SnamSE1"></script>
        //     <script src="https://geonine.io/galvanic/plugins/select2?v=_RsR3zuRZqsMlp1GJaThsRk_Mzp0mgvl1vXvXMcAFr41"></script>
        //     <script src="https://geonine.io/galvanic/plugins/icheck?v=fqUiKssKMHgEiENYIMoLlfoZaxn4V1GpsYfdJkzcq7k1"></script>
        //     <script src="https://geonine.io/galvanic/plugins/bootbox?v=ex-O_dpNihw77lJx47j96At9Hi82YbPAlg47Ztt6-1c1"></script>
        //     <script src="https://geonine.io/galvanic/plugins/datepicker?v=6ckLgr2PUCJQnl-Y3Z5BNB54kLsnbrkaTxKaq_K0k0w1"></script>
        //     <script src="https://geonine.io/galvanic/bundles/layoutconfig?v=NKRBdJxPHhr6E4qvsfaSMwlgVHV-4fbDCRDORLEBsQs1"></script>
        //     <script src="https://geonine.io/galvanic/bundles/core?v=5vWVSE2zkkvkuFucguPEOZCaFGAl_Fg5-yJfBqPyy-U1"></script>
        //     <script src="https://geonine.io/galvanic/Scripts/bootstrap.bundle.min.js"></script>
        //     <script src="https://geonine.io/galvanic/Content/theme/js/sb-admin-2.min.js"></script>
        //     <script src="https://geonine.io/galvanic/Scripts/timeout-dialog.js"></script>

        //     <script src="https://geonine.io/galvanic/plugins/dataTable?v=kprMBTKswVYVJ92GZXiZgIz_a6NQtYvDmubpCqXyXj01"></script>

        //     <script src="https://unpkg.com/@googlemaps/markerclusterer@2.0.15/dist/index.min.js"></script>
        //     <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg1DO6oHxnDvgcEaT95Gc6J_LfiWUQhAo&callback=initMap&libraries=places"></script>
        //     <script src="https://geonine.io/galvanic/Scripts/EVUser/Map/MapCustomControl.js?v=1"></script>

        //     <script src="' . base_url('/app/map/index2.js') . '"></script>
        //     <script src="' . base_url('/app/map/index3.js') . '"></script>
        //     <script src="' . base_url('/app/map/index4.js') . '"></script>
        //     <script src="' . base_url('/app/map/index5.js') . '"></script>
        // ';
        $data['js_critical'] = '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            
            <script src="' . base_url('/app/map/core.js') . '"></script>
            <script src="' . base_url('/app/map/timeout-dialog.js') . '"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
          
            <script src="https://unpkg.com/@googlemaps/markerclusterer@2.0.15/dist/index.min.js"></script>
            <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg1DO6oHxnDvgcEaT95Gc6J_LfiWUQhAo&callback=initMap&libraries=places&callback=initMap"></script>
            <script src="' . base_url('/app/map/index.js') . '"></script>
        ';


        // <script src="' . base_url('/app/map/MapCustomControl.js') . '"></script>
        // <script src="' . base_url('/app/map/index2.js') . '"></script>
        // <script src="' . base_url('/app/map/index3.js') . '"></script>
        // <script src="' . base_url('/app/map/index4.js') . '"></script>
        // <script src="' . base_url('/app/map/index5.js') . '"></script>

        echo view('/app', $data);
    }

    public function GetLocations()
    {
        $status = 500;
        $response['success'] = 0;
        $response['message'] = '';

        try {
            $status = 200;

            $response_detail = $this->evxApi->getEvStationDetailMap();

            if ($response_detail) {

                $status = 200;
                $response['success'] = 1;
                $response['message'] = 'พบ Location';

                $response['data'] = $response_detail;
            } else {
                $status = 200;
                $response['success'] = 0;
                $response['message'] = 'ไม่พบ Location';
            }
            return $this->response
                ->setStatusCode($status)
                ->setContentType('application/json')
                ->setJSON($response);
        } catch (\Exception $e) {
            echo $e->getMessage() . ' ' . $e->getLine();
        }

    }

    public function GetMobileLocations()
    {
        $status = 500;
        $response['success'] = 0;
        $response['message'] = '';

        try {
            $status = 200;
            $response = [];
        } catch (\Exception $e) {
        }

        return $this->response
            ->setStatusCode($status)
            ->setContentType('application/json')
            ->setJSON($response);
    }

    public function GetUserChargingStatusByTag()
    {
        $status = 500;
        $response['success'] = 0;
        $response['message'] = '';

        try {
            $status = 200;
            $response = [];
        } catch (\Exception $e) {
        }

        return $this->response
            ->setStatusCode($status)
            ->setContentType('application/json');
    }

    public function SocketKey()
    {
        $status = 500;
        $response['success'] = 0;
        $response['message'] = '';

        try {
            $status = 200;
            $response = [];
        } catch (\Exception $e) {
        }

        return $this->response
            ->setStatusCode($status)
            ->setContentType('application/json')
            ->setJSON($response);
    }

    public function GetDetail()
    {
        $status = 500;
        $response['success'] = 0;
        $response['message'] = '';

        try {
            $status = 200;
            $data = [
                "KeyId" => "ee7d39f7-de90-4fc7-bf48-fbc72c11c68d",
                "StationName" => "Creekside by BCharge ",
                "Address" => null,
                "Website" => null,
                "IotUrl" => null,
                "Phone" => "0918692286",
                "Email" => null,
                "IsAlldayOpen" => true,
                "FullAddress" => " 10110",
                "Description" => null,
                "StationId" => 146,
                "StationServiceFee" => "",
                "StationHasServiceFee" => false,
                "IsPrivateStation" => true,
                "ChargePoints" => [
                    [
                        "ChargePointName" => "Creekside02",
                        "OutputPower" => 22,
                        "HasReserve" => false,
                        "Connectors" => [
                            [
                                "ChargePointId" => "THBCHEX000012",
                                "ConnectorId" => 1,
                                "ChargerType" => "AC",
                                "ConnectorTypeId" => 4,
                                "ConnectorIconUrl" =>
                                "https://geonine.io/evpublic/connector/4.png",
                                "ConnectorTypeName" => "Type 2",
                                "ConnectorStatus" => "Available",
                                "ConnectorStatusDisplay" => "พร้อมใช้งาน",
                                "ServiceCharge" => "10 บาท/kWh",
                                "IsTouMeter" => false,
                                "ServiceChargeOnPeak" => null,
                                "ServiceChargeOffPeak" => null,
                                "StationServiceFee" => null,
                                "ServiceChargeList" => [],
                                "ConnectorKey" => "5265e240-a857-46a4-8304-185d4b1d4795",
                                "OutputPower" => 22,
                                "OutputPowerFormat" => "22",
                            ],
                        ],
                        "HasPlugNCharge" => false,
                        "HasRfidCharge" => false,
                    ],
                ],
                "WorkingHour" => [
                    [
                        "DayWeekId" => 1,
                        "OpenTime" => "00:00:00.0000000",
                        "CloseTime" => "23:59:00.0000000",
                    ],
                    [
                        "DayWeekId" => 2,
                        "OpenTime" => "00:00:00.0000000",
                        "CloseTime" => "23:59:00.0000000",
                    ],
                    [
                        "DayWeekId" => 3,
                        "OpenTime" => "00:00:00.0000000",
                        "CloseTime" => "23:59:00.0000000",
                    ],
                    [
                        "DayWeekId" => 4,
                        "OpenTime" => "00:00:00.0000000",
                        "CloseTime" => "23:59:00.0000000",
                    ],
                    [
                        "DayWeekId" => 5,
                        "OpenTime" => "00:00:00.0000000",
                        "CloseTime" => "23:59:00.0000000",
                    ],
                    [
                        "DayWeekId" => 6,
                        "OpenTime" => "00:00:00.0000000",
                        "CloseTime" => "23:59:00.0000000",
                    ],
                    [
                        "DayWeekId" => 7,
                        "OpenTime" => "00:00:00.0000000",
                        "CloseTime" => "23:59:00.0000000",
                    ],
                ],
                "Amenities" => [
                    ["AmenityName" => "ที่จอดรถ", "Icon" => "fas fa-parking"],
                    ["AmenityName" => "ห้องน้ำ", "Icon" => "fas fa-restroom"],
                ],
                "PaymentMethods" => [
                    [
                        "PaymentMethodName" => "บัตรเครดิต",
                        "Icon" => "fas fa-credit-card",
                        "IconUrl" =>
                        "https://geonine.io/evpublic/payment_method/credit-card.svg",
                        "IconUrlPng" =>
                        "https://geonine.io/evpublic/payment_method/credit-card.png",
                    ],
                    [
                        "PaymentMethodName" => "QR Code",
                        "Icon" => "fas fa-qrcode",
                        "IconUrl" =>
                        "https://geonine.io/evpublic/payment_method/qrcode.svg",
                        "IconUrlPng" =>
                        "https://geonine.io/evpublic/payment_method/qrcode_icon.png",
                    ],
                    [
                        "PaymentMethodName" => "Galvanic Wallet",
                        "Icon" => "fas fa-wallet",
                        "IconUrl" =>
                        "https://geonine.io/evpublic/payment_method/wallet.svg",
                        "IconUrlPng" =>
                        "https://geonine.io/evpublic/payment_method/wallet.png",
                    ],
                    [
                        "PaymentMethodName" => "TrueMoney Wallet",
                        "Icon" => "fas fa-wallet",
                        "IconUrl" =>
                        "https://geonine.io/evpublic/payment_method/truemoney.svg",
                        "IconUrlPng" =>
                        "https://geonine.io/evpublic/payment_method/truemoney_icon.png",
                    ],
                ],
            ];
            $response = $data;
        } catch (\Exception $e) {
        }

        return $this->response
            ->setStatusCode($status)
            ->setContentType('application/json')
            ->setJSON($response);
    }
}

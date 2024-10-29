<?php

namespace app\controllers;

use app\exceptions\Exception;
use app\models\CouriersModel;
use app\models\RegionsModel;
use app\models\TripsModels;
use DateTime;

class App
{

    private $regionsModel = null;

    private $couriersModel = null;

    private $tripsModel = null;

    private $exception = null;

    public function __construct()
    {
        $this->exception = new Exception();
        $this->regionsModel = new RegionsModel();
        $this->couriersModel = new CouriersModel();
        $this->tripsModel = new TripsModels();
    }

    public function view()
    {
        $regions = $this->regionsModel->getAllRegions();
        $couriers = $this->couriersModel->getAllCouriers();
        $dataAll = $this->tripsModel->getTripsAllData();
        includeView('layouts/main', compact('dataAll', 'regions', 'couriers'));
    }

    public function sort($url)
    {
        $data = $this->exception->sortException($url);

        if ($data['status'] === 'error') {
            echo $data;
            return;
        }

        $param = $url[1];
        $sort = $url[2];

        $data = $this->tripsModel->getTripsAllDataSort($param, $sort);
        echo json_encode(["status" => "ok", "data" => $data]);
    }

    public function addTrip()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $regionId = $data['region'] ?? null;
        $courierId = $data['courier'] ?? null;

        $region = $this->regionsModel->getRegionById($regionId);

        $arrival_date  = $region['travel_days'];
        $return_date = $region['travel_days_back'];

        $dateToday = new DateTime();

        $departure_date = $dateToday->format('Y-m-d');

        $dateToday->modify("+$arrival_date days");
        $arrival_date = $dateToday->format('Y-m-d');

        $dateToday->modify("+$return_date days");
        $return_date = $dateToday->format('Y-m-d');

        $this->tripsModel->addTrip([
            'courier_id' => $courierId,
            'region_id' => $regionId,
            'departure_date' => $departure_date,
            'arrival_date' => $arrival_date,
            'return_date' => $return_date,
        ]);

        $this->couriersModel->setBusy($courierId, true);

        $dataCouriers = $this->couriersModel->getAllCouriers();

        $dataAll = $this->tripsModel->getTripsAllData();

        echo json_encode([
            'dataAll' => $dataAll,
            'dataCouriers' => $dataCouriers
        ]);
    }

    public function region($url)
    {
        $id = $url[1];
        $region = $this->regionsModel->getRegionById($id);
        echo json_encode($region);
    }

    public function getAllCouriers()
    {
        $couriers = $this->couriersModel->getAllCouriers();
        echo json_encode($couriers);
    }

    public function createCourier()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $name = $data['nsf'] ?? null;

        $data = $this->couriersModel->createCourier([
            'name' => $name,
            'is_busy' => NULL,
        ]);

        echo json_encode($data);
    }

}
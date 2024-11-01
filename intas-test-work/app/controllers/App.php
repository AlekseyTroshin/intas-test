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
        $daysDate = $this->tripsModel->getTripsDepartureDate();
        $regions = $this->regionsModel->getAllRegions();
        $couriers = $this->couriersModel->getAllCouriers();
        $dataAll = $this->tripsModel->getTripsAllData();
        includeView('layouts/main', compact('dataAll', 'regions', 'couriers', 'daysDate'));
    }

    public function sort($url)
    {
        $exception = $this->exception->sortException($url);

        if ($exception['status'] === 'error') {
            echo $exception;
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

        $exception = $this->exception->addTripException($data);

        if (isset($exception) && $exception['status'] === 'error') {
            echo $exception;
            return;
        }

        $regionId = $data['region'];
        $courierId = $data['courier'];

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
            'status' => 'ok',
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

        $exception = $this->exception->createCourierException($data);

        if (isset($exception) && $exception['status'] === 'error') {
            echo $exception;
            return;
        }

        $name = $data['nsf'];

        $data = $this->couriersModel->createCourier([
            'name' => $name,
            'is_busy' => NULL,
        ]);

        echo json_encode([
            "status" => "ok",
            "data" => $data
        ]);
    }

    public function checkSelectedDate($url)
    {
        $exception = $this->exception->checkSelectedDateException($url);

        if ($exception['status'] === 'error') {
            echo $exception;
            return;
        }

        $param = $url[1];

        if ($param === 'all') {
            $data = $this->tripsModel->getTripsAllData();
        } else {
            $data = $this->tripsModel->getTripsByDate($param);
        }

        echo json_encode(["status" => "ok", "data" => $data]);
    }

}
<?php


class Trip
{
    private $id;
    private $courier_id;
    private $region_id;
    private $departure_date;
    private $arrival_date;
    private $return_date;

    public function __construct($id) 
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCourierId()
    {
        return $this->courier_id;
    }

    public function setCourierId($courier_id)
    {
        $this->courier_id = $courier_id;
    }

    public function getRegionId()
    {
        return $this->region_id;
    }

    public function setRegionId($region_id)
    {
        $this->region_id = $region_id;
    }

    public function getDepartureDate()
    {
        return $this->departure_date;
    }

    public function setDepartureDate($departure_date)
    {
        $this->departure_date = $departure_date;
    }

    public function getArrivalDate()
    {
        return $this->arrival_date;
    }

    public function setArrivalDate($arrival_date)
    {
        $this->arrival_date = $arrival_date;
    }

    public function getReturnDate()
    {
        return $this->return_date;
    }

    public function setReturnDate($return_date)
    {
        $this->return_date = $return_date;
    }
}
<?php

class Courier
{
    private $id;
    private $name;
    private $days;
    private $daysOff;
    private $is_busy;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->days = 0;
        $this->daysOff = 0;
        $this->is_busy = false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDays($days)
    {
        $this->days = $days;
    }

    public function getDays()
    {
        return $this->days;
    }

    public function setDaysOff($daysOff)
    {
        $this->daysOff = $daysOff;
    }

    public function getDaysOff()
    {
        return $this->daysOff;
    }

    public function setBusy($is_busy)
    {
        $this->is_busy = $is_busy;
    }

    public function isBusy()
    {
        return $this->is_busy;
    }
}
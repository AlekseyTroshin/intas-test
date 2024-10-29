<?php

class Region
{
    private $id;
    private $name;
    private $days;
    private $daysBack;

    public function __construct($id, $name, $days, $daysBack)
    {
        $this->id = $id;
        $this->name = $name;
        $this->days = $days;
        $this->daysBack = $daysBack;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDays()
    {
        return $this->days;
    }

    public function getDaysBack()
    {
        return $this->daysBack;
    }
}
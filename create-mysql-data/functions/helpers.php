<?php

function getRandomNum($min, $max)
{
    return rand($min, $max);
}

function getRandomItemArr($arr, $min, $max)
{   
    return $arr[getRandomNum($min, $max - 1)];
}

function getDeliveryDate($dateFormat, $days)
{
    $date = DateTime::createFromFormat('Y-m-d', $dateFormat);
    $date->modify("+$days days");
    return $date->format('Y-m-d');
}









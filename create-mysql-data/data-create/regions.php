<?php

function regions($amoutRegions) 
{
    require_once './pdo/Region.php';
    require_once './data/cities.php';
    
    $regions = [];

    for ($i = 0; $i < $amoutRegions; $i++) {
        $name = $cities[$i];
        $days = getRandomNum(1, 7);
        $daysBack = getRandomNum(1, 7);
        $regions[] = new Region($i + 1, $name, $days, $daysBack);
    }

    return $regions;
}
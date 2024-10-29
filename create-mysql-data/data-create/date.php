<?php

function getDays($days)
{
	$calendar = [];

   $date = new DateTime();
   $date->modify("-$days days");

   for ($i = 1; $i <= $days; $i++) {
      $date->modify("+1 days");
      $calendar[] = $date->format('Y-m-d');
   }
    
    return $calendar;
}
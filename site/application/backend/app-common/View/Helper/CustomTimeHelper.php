<?php
App::uses('TimeHelper', 'View/Helper');

class CustomTimeHelper extends TimeHelper {
    public function differenceInMonths($start, $finish, $suffix = "&nbsp;months") {
     
     	$startUnix = self::fromString($start);
     	$finishUnix = self::fromString($finish);

     	$diffInMonths = ($finishUnix - $startUnix) / (60 * 60 * 24 * 365 / 12);

     	return round($diffInMonths, 1) . $suffix;

    }
}
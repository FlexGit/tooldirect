<?php

namespace lib;

class helper {
	public static function formatAvail($quantity) {
		if ($quantity <= 0)
			$statusId = 0;
		elseif ($quantity <= 2)
			$statusId = 1;
		elseif ($quantity >= 3 && $quantity <= 5)
			$statusId = 2;
		elseif ($quantity > 5 && $quantity <= 10)
			$statusId = 3;
		elseif ($quantity > 10 && $quantity <= 20)
			$statusId = 4;
		elseif ($quantity > 20)
			$statusId = 5;
		
		return $statusId;
	}

	public static function distance($lat1,$lng1,$lat2,$lng2) {
		$lat1 = deg2rad($lat1);
		$lng1 = deg2rad($lng1);
		$lat2 = deg2rad($lat2);
		$lng2 = deg2rad($lng2);
		return round(6378137 * acos(cos($lat1) * cos($lat2) * cos($lng1 - $lng2) + sin($lat1) * sin($lat2)));
	}
	
}
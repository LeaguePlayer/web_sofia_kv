<?php 

class MyHelper {

	public static function getFormatedDate($out, $date){
		$date = new DateTime($date);
		return $date->format($out);
	}
}
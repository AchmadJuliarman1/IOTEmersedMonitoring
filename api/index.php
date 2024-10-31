<?php 

include_once "Database.php";

// local
$db = new Database("localhost", "root", "", "iot_emersed");

// hosting
// $db = new Database("localhost", "skripsia_iot_emersed", "", "skripsia_iot_emersed");

$url = explode("/", $_GET["url"]);


if(strtolower($url[0]) == "realtime"){

	$db->getRealTime();

}else if(strtolower($url[0]) == "getall"){

	$data = $db->getAllData();
	var_dump($data);

}else if(strtolower($url[0]) == "post"){

	$data = json_decode(file_get_contents('php://input'), true);
	$co2 = $data["co2"];
	$humidity = $data["humidity"];
	$lux = $data["lux"];
	$waktu = $data["waktu"];

	$db->inputPeriodikData($co2, $humidity, $lux, $waktu);
	echo 'Data Yang anda posting';
	var_dump($data);

}else if(strtolower($url[0]) == "post-status"){

	$data = json_decode(file_get_contents('php://input'), true);
	$alat = $data["alat"];
	$status = $data["status"];
	$waktu = $data["waktu"];
	$db->inputLogStatus($alat, $status, $waktu);
	echo 'Data Status tersimpan ';
	var_dump($data);

}


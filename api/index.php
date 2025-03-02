<?php 

include_once "Database.php";

// local
// $db = new Database("localhost", "root", "", "iot_emersed");

// hosting
$db = new Database("localhost", "skripsia_iot_emersed", "ArmanSkripsian", "skripsia_iot_emersed");

$url = explode("/", $_GET["url"]);


if(strtolower($url[0]) == "realtime"){
	$data = json_decode(file_get_contents('php://input'), true);
	$co2 = $data["co2"];
	$humidity = $data["humidity"];
	$lux = $data["lux"];
	$waktu = $data["waktu"];
	$lama_hidup = $data["lama_hidup"];
	$status_lampu = '';
	$status_mistMaker = '';
	$status_solenoid = '';

	$jamSekarang = date("H", strtotime($waktu));
	$jamLampuMati = 7+$lama_hidup;

	if($co2 <= 1000 && $jamSekarang <= $jamLampuMati && $jamSekarang >= 7){
		$status_solenoid = 'ON';
	}else{
		$status_solenoid = 'OFF';
	}

	if($humidity <= 80){
		$status_mistMaker = 'ON';
	}else{
		$status_mistMaker = 'OFF';
	}
    
	if($jamSekarang < 7+$lama_hidup){
		$status_lampu = 'ON';
	}else{
		$status_lampu = 'OFF';
	}
    
	$db->inputRealTimeData($co2, $humidity, $lux, $waktu, $lama_hidup, $waktu_berjalan);
	$db->inputLogData($co2, $humidity, $lux, $waktu, $lama_hidup, $status_lampu, $status_mistMaker, $status_solenoid);
	var_dump($data);
}else if(strtolower($url[0]) == "get-realtime"){

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
	var_dump($data);

}


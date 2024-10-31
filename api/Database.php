<?php 
class Database{

	public $conn;

	function __construct($host, $username, $pass, $dbname){
		$this->conn = mysqli_connect($host, $username, $pass, $dbname);
	}

	function getAllData(){
		$sql = "SELECT * FROM data_sensor";
		$query = mysqli_query($this->conn, $sql);
		return mysqli_fetch_all($query, MYSQLI_ASSOC);
	}

	function getRealTime(){
		$sql = "SELECT * FROM realtime";
		$query = mysqli_query($this->conn, $sql);
		echo json_encode(mysqli_fetch_all($query, MYSQLI_ASSOC));
	}

	function inputRealTimeData($moisture, $temperature){
		$sql = "UPDATE realtime
		SET moisture = '$moisture',
		temperature = '$temperature'
		WHERE id = 1";
		mysqli_query($this->conn, $sql);
	}

	function inputPeriodikData($co2, $humidity, $lux, $waktu){
		// date_default_timezone_set("Asia/Jakarta");
		// $waktu = date("Y/m/d H:i:s");
		$sql = "INSERT INTO data_sensor (co2, humidity, lux, waktu)
		VALUES('$co2', '$humidity', '$lux', '$waktu')";
		if(!mysqli_query($this->conn, $sql)){
			$this->conn->error;
		}	
	}

	function inputLogStatus($alat, $status, $waktu){
		$sql = "INSERT INTO log_status_alat (alat, status, waktu) 
		VALUES('$alat', '$status,', '$waktu')";
		mysqli_query($this->conn, $sql);
	}
}

 ?>
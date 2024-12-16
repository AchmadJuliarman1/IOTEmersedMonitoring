<?php 
class Database{

	public $conn;

	function __construct($host, $username, $pass, $dbname){
		$this->conn = mysqli_connect($host, $username, $pass, $dbname);
	}

	function query($result){
		$data = array();
		foreach ($result as $r) {
			array_push($data, $r[0]);
		}
		return $data;
	}

	function getLabelWaktu(){
		$sql = "SELECT waktu FROM data_sensor";
		$query = mysqli_query($this->conn, $sql);
		$result = mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getLabelPerbandingan(){
		$sql = "SELECT waktu FROM data_sensor WHERE HOUR(WAKTU) = 7 OR HOUR(WAKTU)  = 13 OR HOUR(WAKTU) = 16;";
		$query = mysqli_query($this->conn, $sql);
		$result = mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getCo2IOT(){
		$sql = "SELECT co2 FROM data_sensor WHERE HOUR(WAKTU) = 7 OR HOUR(WAKTU)  = 13 OR HOUR(WAKTU) = 16;";
		$query = mysqli_query($this->conn, $sql);
		$result = mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getAllData(){
		$sql = "SELECT * FROM data_sensor";
		$query = mysqli_query($this->conn, $sql);
		return mysqli_fetch_all($query, MYSQLI_ASSOC);
	}

	function getAllDataCo2(){
		$sql = "SELECT co2, waktu FROM data_sensor ORDER BY waktu ASC";
		$query = mysqli_query($this->conn, $sql);
		$result =  mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getAllDataHumidity(){
		$sql = "SELECT humidity, waktu FROM data_sensor ORDER BY waktu ASC";
		$query = mysqli_query($this->conn, $sql);
		$result = mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getAllDataLux(){
		$sql = "SELECT lux, waktu FROM data_sensor ORDER BY waktu ASC";
		$query = mysqli_query($this->conn, $sql);
		$result =  mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getRealTime(){
		$sql = "SELECT * FROM realtime";
		$query = mysqli_query($this->conn, $sql);
		echo json_encode(mysqli_fetch_all($query, MYSQLI_ASSOC));
	}

	function inputRealTimeData($co2, $humidity, $lux, $waktu, $lama_hidup, $waktuBerjalan){
		$sql = "UPDATE realtime
		SET co2 = '$co2',
		humidity = '$humidity',
		lux = '$lux',
		waktu = '$waktu',
		lama_hidup = '$lama_hidup',
		waktu_berjalan = '$waktuBerjalan' ";
		mysqli_query($this->conn, $sql);
	}

	function inputPeriodikData($co2, $humidity, $lux, $waktu){
		// date_default_timezone_set("Asia/Jakarta");
		// $waktu = date("Y/m/d H:i:s");
		$sql = "INSERT INTO data_sensor (co2, humidity, lux, waktu) 
		VALUES('$co2', '$humidity', '$lux', '$waktu')";
		mysqli_query($this->conn, $sql);
	}

}

 ?>
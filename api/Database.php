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

	function getAllDataCo2(){
		$sql = "SELECT co2, waktu FROM data_sensor";
		$query = mysqli_query($this->conn, $sql);
		return mysqli_fetch_all($query, MYSQLI_ASSOC);
	}

	function getAllDataHumidity(){
		$sql = "SELECT humidity, waktu FROM data_sensor";
		$query = mysqli_query($this->conn, $sql);
		return mysqli_fetch_all($query, MYSQLI_ASSOC);
	}

	function getAllDataLux(){
		$sql = "SELECT lux, waktu FROM data_sensor";
		$query = mysqli_query($this->conn, $sql);
		return mysqli_fetch_all($query, MYSQLI_ASSOC);
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
<?php 
class Database{

	public $conn;
	public $new_file_name_k, $new_file_name_i;
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
		$sql = "SELECT lux, waktu FROM data_sensor WHERE HOUR(WAKTU) = 7  ORDER BY waktu ASC";
		$query = mysqli_query($this->conn, $sql);
		$result =  mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getWaktuLux(){
		$sql = "SELECT waktu FROM data_sensor WHERE HOUR(waktu) = 7 ORDER BY waktu ASC";
		$query = mysqli_query($this->conn, $sql);
		$result =  mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getRealTime(){
		$sql = "SELECT * FROM realtime";
		$query = mysqli_query($this->conn, $sql);
		echo json_encode(mysqli_fetch_all($query, MYSQLI_ASSOC));
	}

	function inputRealTimeData($co2, $humidity, $lux, $waktu, $lama_hidup){
		$sql = "UPDATE realtime
		SET co2 = '$co2',
		humidity = '$humidity',
		lux = '$lux',
		waktu = '$waktu',
		lama_hidup = '$lama_hidup'";
		mysqli_query($this->conn, $sql);
	}

	function inputPeriodikData($co2, $humidity, $lux, $waktu){
		// date_default_timezone_set("Asia/Jakarta");
		// $waktu = date("Y/m/d H:i:s");
		$sql = "INSERT INTO data_sensor (co2, humidity, lux, waktu) 
		VALUES('$co2', '$humidity', '$lux', '$waktu')";
		mysqli_query($this->conn, $sql);
	}

	function inputLogData($co2, $humidity, $lux, $waktu, $lama_hidup, $status_lampu, $status_mistMaker, $status_solenoid){
		$sql = "INSERT INTO log_data(co2, humidity, lux, waktu, lama_hidup, status_lampu, status_mistMaker, status_solenoid) 
		VALUES('$co2', '$humidity', '$lux', '$waktu', '$lama_hidup','$status_lampu', '$status_mistMaker', '$status_solenoid')";
		mysqli_query($this->conn, $sql);
	}

	function getDataParamIOT(){
		$sql = "SELECT co2, humidity, suhu, lux, waktu FROM log_data
		WHERE HOUR(waktu) IN (8, 12, 16)
		AND MINUTE(waktu) = 0
		AND SECOND(waktu) <= 10;";

		$query = mysqli_query($this->conn, $sql);
		$result =  mysqli_fetch_all($query, MYSQLI_ASSOC);
		return $result;
	}

	function getDataKonvensional(){
		$sql = "SELECT * FROM data_parameter_konvensional";
		$query = mysqli_query($this->conn, $sql);
		$result =  mysqli_fetch_all($query, MYSQLI_ASSOC);
		return $result;
	}
}

 ?>
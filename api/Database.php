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

	function getCo2IOT(){
		$sql = "SELECT co2 FROM data_sensor WHERE HOUR(WAKTU) = 7 OR HOUR(WAKTU)  = 13 OR HOUR(WAKTU) = 16;";
		$query = mysqli_query($this->conn, $sql);
		$result = mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getHumidityIOT(){
		$sql = "SELECT humidity FROM data_sensor WHERE HOUR(WAKTU) = 7 OR HOUR(WAKTU)  = 13 OR HOUR(WAKTU) = 16;";
		$query = mysqli_query($this->conn, $sql);
		$result = mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getLuxIOT(){
		$sql = "SELECT lux FROM data_sensor WHERE HOUR(WAKTU) = 7 OR HOUR(WAKTU)  = 13 OR HOUR(WAKTU) = 16;";
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

	function getDataKonvensionalPanjang(){
		$sql = "SELECT panjang_k FROM perbandingan";
		$query = mysqli_query($this->conn, $sql);
		$result =  mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getDataKonvensionalLebar(){
		$sql = "SELECT lebar_k FROM perbandingan";
		$query = mysqli_query($this->conn, $sql);
		$result =  mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getDataKonvensionalTinggi(){
		$sql = "SELECT Tinggi_k FROM perbandingan";
		$query = mysqli_query($this->conn, $sql);
		$result =  mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getDataKonvensionalJumlahTunas(){
		$sql = "SELECT jumlah_tunas_k FROM perbandingan";
		$query = mysqli_query($this->conn, $sql);
		$result =  mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getDataIOTPanjang(){
		$sql = "SELECT panjang_i FROM perbandingan";
		$query = mysqli_query($this->conn, $sql);
		$result =  mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getDataIOTLebar(){
		$sql = "SELECT lebar_i FROM perbandingan";
		$query = mysqli_query($this->conn, $sql);
		$result =  mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getDataIOTTinggi(){
		$sql = "SELECT Tinggi_i FROM perbandingan";
		$query = mysqli_query($this->conn, $sql);
		$result =  mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getDataIOTJumlahTunas(){
		$sql = "SELECT jumlah_tunas_i FROM perbandingan";
		$query = mysqli_query($this->conn, $sql);
		$result =  mysqli_fetch_all($query);
		return $this->query($result);
	}

	function getLabelPerbandingan(){
		$sql = "SELECT hari FROM perbandingan";
		$query = mysqli_query($this->conn, $sql);
		$result =  mysqli_fetch_all($query);
		return $this->query($result);
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

	function inputDataPerbandingan($data){
		$hari = $data["hari"];
		$batang = $data["batang"];
		$panjang_k = $data["panjang_k"];
		$lebar_k = $data["lebar_k"];
		$tinggi_k = $data["tinggi_k"];
		$jumlah_tunas_k = $data["jumlah_tunas_k"];
		$panjang_i = $data["panjang_i"];
		$lebar_i = $data["lebar_i"];
		$tinggi_i = $data["tinggi_i"];
		$jumlah_tunas_i = $data["jumlah_tunas_i"];

		$sql = "INSERT INTO perbandingan (hari, batang, panjang_k, lebar_k, tinggi_k, jumlah_tunas_k, panjang_i, lebar_i, tinggi_i, jumlah_tunas_i)
		VALUES ('$hari', '$batang','$panjang_k', '$lebar_k', '$tinggi_k', '$jumlah_tunas_k', '$panjang_i', '$lebar_i', '$tinggi_i', '$jumlah_tunas_i')";

		if (mysqli_query($this->conn, $sql)) {
	        if (mysqli_affected_rows($this->conn) > 0) {
	            return 1;
	        } else {
	            return 0;
	        }
	    } else {
	        return "Error: " . mysqli_error($this->db->conn);
	    }
	}

	function uploadGambar($file){
		$target_dir = '../gambar/';
		$waktu = date("Ymd_His");
		$file_extension_konvensional = pathinfo($file["gambar_k"]["name"], PATHINFO_EXTENSION);
		$file_extension_iot = pathinfo($file["gambar_i"]["name"], PATHINFO_EXTENSION);
		$new_file_name_k = "gambarK_" . $waktu . "." . $file_extension_konvensional;
		$new_file_name_i = "gambarI_" . $waktu . "." . $file_extension_konvensional;

		$target_file_k = $target_dir . $new_file_name_k;
		$target_file_i = $target_dir . $new_file_name_i;

		$this->new_file_name_k = $new_file_name_k;
		$this->new_file_name_i = $new_file_name_i;
		// Memindahkan file ke lokasi tujuan dengan nama yang sudah diubah
		if(move_uploaded_file($file["gambar_k"]["tmp_name"], $target_file) && move_uploaded_file($file["gambar_i"]["tmp_name"], $target_file)){
			return true;
		}else{
			return false;
		}
	}

}

 ?>
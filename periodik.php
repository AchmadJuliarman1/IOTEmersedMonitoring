<?php 
include_once 'header.php'; 
include_once 'api/Database.php'; 
// local
$db = new Database("localhost", "root", "", "iot_emersed");

// hosting
// $db = new Database("localhost", "skripsia_iot_emersed", "", "skripsia_iot_emersed");
$co2 = $db->getAllDataCo2();
$humidity = $db->getAllDataHumidity();
$lux = $db->getAllDataLux();

$co2Data = array();
$humidityData = array();
$luxData = array();
$waktu = array();
foreach ($co2 as $c) {
	array_push($co2Data, $c["co2"]);
}

foreach ($humidity as $h) {
	array_push($humidityData, $h["humidity"]);
}

foreach ($lux as $l) {
	array_push($luxData, $l["lux"]);
}

// label
foreach ($lux as $f) {
	array_push($waktu, $f["waktu"]);
}

$co2Data = implode(",",$co2Data);
$humidityData = implode(",",$humidityData);
$luxData = implode(",",$luxData);
$quotedDates = array_map(function($date) {
    return "'" . $date . "'";
}, $waktu);
// Menggabungkan kembali array dengan koma
$label = implode(",", $quotedDates);

?>

<div class="container d-flex flex-column" style="margin-left: 20vw;">
<div class="chart-co2 my-4">
	<canvas id="co2Chart"></canvas>
</div>

<div class="chart-humidity my-4">
	<canvas id="humidityChart"></canvas>
</div>

<div class="chart-lux my-4">
	<canvas id="luxChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx1 = document.getElementById('co2Chart');
  const ctx2 = document.getElementById('humidityChart');
  const ctx3 = document.getElementById('luxChart');
  new Chart(ctx1, {
    type: 'line',
    data: {
      labels: [<?= $label ?>],
      datasets: [{
        label: 'CO2',
        data: [<?= $co2Data ?>],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  new Chart(ctx2, {
    type: 'line',
    data: {
      labels: [<?= $label ?>],
      datasets: [{
        label: 'Humidity',
        data: [<?= $humidityData ?>],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  new Chart(ctx3, {
    type: 'line',
    data: {
      labels: [<?= $label ?>],
      datasets: [{
        label: 'LUX',
        data: [<?= $luxData ?>],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
 
</div>
<?php include_once 'footer.php' ?>
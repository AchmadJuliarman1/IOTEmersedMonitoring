<?php 
include_once 'header.php'; 
include_once 'api/Database.php'; 
// local
$db = new Database("localhost", "root", "", "iot_emersed");

// hosting
// $db = new Database("localhost", "skripsia_iot_emersed", "ArmanSkripsian", "skripsia_iot_emersed");
$co2 = implode(",", $db->getAllDataCo2());
$humidity = implode(",", $db->getAllDataHumidity());
$lux = implode(",", $db->getAllDataLux());


// label
$waktu = $db->getLabelWaktu();
$quotedDates = array_map(function($date) {
    return "'" . $date . "'";
}, $waktu);
// Menggabungkan kembali array dengan koma
$label = implode(",", $quotedDates);

// label lux
$waktuLux = $db->getWaktuLux();
$quotedDates = array_map(function($date) {
    return "'" . $date . "'";
}, $waktuLux);
// Menggabungkan kembali array dengan koma
$labelLux = implode(",", $quotedDates);

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
        data: [<?= $co2 ?>],
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
        data: [<?= $humidity ?>],
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
      labels: [<?= $labelLux ?>],
      datasets: [{
        label: 'LUX',
        data: [<?= $lux ?>],
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
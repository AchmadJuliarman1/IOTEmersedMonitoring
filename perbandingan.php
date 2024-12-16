<?php 
include_once 'header.php';
include_once 'api/Database.php'; 
$db = new Database("localhost", "root", "", "iot_emersed");
// hosting
// $db = new Database("localhost", "skripsia_iot_emersed", "ArmanSkripsian", "skripsia_iot_emersed");
$waktu = $db->getLabelPerbandingan();
$quotedDates = array_map(function($date) {
    return "'" . $date . "'";
}, $waktu);

$label = implode(",", $quotedDates);

// DATA
$humidityIOT = implode(",", $db->getHumidityIOT());
$luxIOT = implode(",", $db->getLuxIOT());

?>
<div class="container">
<div class="mt-4">
  <canvas id="humidityChart"></canvas>
</div>

<div class="mt-4">
  <canvas id="luxChart"></canvas>
</div>

<script>
const ctx1 = document.getElementById('humidityChart');
const ctx2 = document.getElementById('luxChart');

const dataHumidity = {
  labels: [<?= $label ?>],
  datasets: [
    {
      label: 'Humidity Konvensional',
      data: [1, 2, 1],
      borderColor: '#36A2EB',
      backgroundColor: '#9BD0F5',
    },
    {
      label: 'Humidity IOT',
      data: [<?= $humidityIOT ?>],
      borderColor: '#FF6384',
      backgroundColor: '#FFB1C1',
    }
  ]
};

const dataLux = {
  labels: [<?= $label ?>],
  datasets: [
    {
      label: 'LUX Konvensional',
      data: [1, 2, 1],
      borderColor: '#36A2EB',
      backgroundColor: '#9BD0F5',
    },
    {
      label: 'LUX IOT',
      data: [<?= $luxIOT ?>],
      borderColor: '#FF6384',
      backgroundColor: '#FFB1C1',
    }
  ]
};

new Chart(ctx1, {
    type: 'line',
    data: dataHumidity,
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
    data: dataLux,
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
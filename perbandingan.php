<?php 
// include_once 'header.php';
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
$co2IOT = implode(",", $db->getCo2IOT());

?>
<div class="container">
<div>
  <canvas id="co2Chart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('co2Chart');
const data = {
  labels: [<?= $label ?>],
  datasets: [
    {
      label: 'Konvensional',
      data: [1, 2, 1],
      borderColor: '#36A2EB',
      backgroundColor: '#9BD0F5',
    },
    {
      label: 'IOT',
      data: [<?= $co2IOT ?>],
      borderColor: '#FF6384',
      backgroundColor: '#FFB1C1',
    }
  ]
};
  new Chart(ctx, {
    type: 'line',
    data: data,
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
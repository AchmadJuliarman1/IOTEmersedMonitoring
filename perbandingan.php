<?php 
include_once 'header.php';
include_once 'api/Database.php'; 
$db = new Database("localhost", "root", "", "iot_emersed");
// hosting
// $db = new Database("localhost", "skripsia_iot_emersed", "ArmanSkripsian", "skripsia_iot_emersed");

$label = implode(',' ,$db->getLabelPerbandingan());
$panjang_k = implode(',', $db->getDataKonvensionalPanjang());
$lebar_k = implode(',', $db->getDataKonvensionalLebar());
$tinggi_k = implode(',', $db->getDataKonvensionalTinggi());
$jumlah_k = implode(',', $db->getDataKonvensionalJumlahTunas());

$panjang_i = implode(',', $db->getDataIOTPanjang());
$lebar_i = implode(',', $db->getDataIOTLebar());
$tinggi_i = implode(',', $db->getDataIOTTinggi());
$jumlah_i = implode(',', $db->getDataIOTJumlahTunas());


?>
<div class="container" style="margin-left: 18vw;">
<div class="mt-4">
  <canvas id="panjang"></canvas>
</div>

<div class="mt-4">
  <canvas id="lebar"></canvas>
</div>

<div class="mt-4">
  <canvas id="tinggi"></canvas>
</div>

<div class="mt-4">
  <canvas id="jumlahTunas"></canvas>
</div>

<script>
const ctx1 = document.getElementById('panjang');
const ctx2 = document.getElementById('lebar');
const ctx3 = document.getElementById('tinggi');
const ctx4 = document.getElementById('jumlahTunas');

const dataJumlahTunas = {
  labels: [<?= $label ?>],
  datasets: [
    {
      label: 'Jumlah Tunas Konvensional',
      data: [<?= $jumlah_k ?>],
      borderColor: '#36A2EB',
      backgroundColor: '#9BD0F5',
    },
    {
      label: 'Jumlah Tunas IOT',
      data: [<?= $jumlah_i ?>],
      borderColor: '#FF6384',
      backgroundColor: '#FFB1C1',
    }
  ]
};

const dataPanjang = {
  labels: [<?= $label ?>],
  datasets: [
    {
      label: 'Panjang Konvensional',
      data: [<?= $panjang_k ?>],
      borderColor: '#36A2EB',
      backgroundColor: '#9BD0F5',
    },
    {
      label: 'Panjang IOT',
      data: [<?= $panjang_i ?>],
      borderColor: '#FF6384',
      backgroundColor: '#FFB1C1',
    }
  ]
};

const dataLebar = {
  labels: [<?= $label ?>],
  datasets: [
    {
      label: 'Lebar Konvensional',
      data: [<?= $lebar_k ?>],
      borderColor: '#36A2EB',
      backgroundColor: '#9BD0F5',
    },
    {
      label: 'Lebar IOT',
      data: [<?= $lebar_i ?>],
      borderColor: '#FF6384',
      backgroundColor: '#FFB1C1',
    }
  ]
};

const dataTinggi = {
  labels: [<?= $jumlah_k ?>],
  datasets: [
    {
      label: 'tINGGI Konvensional',
      data: [<?= $tinggi_k ?>],
      borderColor: '#36A2EB',
      backgroundColor: '#9BD0F5',
    },
    {
      label: 'tINGGI IOT',
      data: [<?= $tinggi_k ?>],
      borderColor: '#FF6384',
      backgroundColor: '#FFB1C1',
    }
  ]
};

new Chart(ctx1, {
    type: 'line',
    data: dataPanjang,
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
    data: dataLebar,
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
    data: dataTinggi,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
});

new Chart(ctx4, {
    type: 'line',
    data: dataJumlahTunas,
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
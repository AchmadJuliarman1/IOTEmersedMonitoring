<?php 
include_once 'header.php';
include_once 'api/Database.php'; 
$db = new Database("localhost", "root", "", "iot_emersed");
// hosting
// $db = new Database("localhost", "skripsia_iot_emersed", "ArmanSkripsian", "skripsia_iot_emersed");
// var_dump($db->getDataKonvensional());

$dataIOT = $db->getDataParamIOT();
$dataKonvensional = $db->getDataKonvensional();

$resultDataIoT = [];
foreach ($dataIOT as $entry) {
    $date_hour = date("Y-m-d H", strtotime($entry["waktu"])); // Ambil TANGGAL + JAM
    
    // Jika belum ada atau detik lebih kecil, simpan data ini
    if (!isset($result[$date_hour]) || strtotime($entry["waktu"]) < strtotime($result[$date_hour]["waktu"])) {
        $result[$date_hour] = $entry;
    }
}
// Mengubah hasil menjadi array numerik
$resultDataIoT = array_values($result);

$groupedData = [];
for($i=0; $i<count($dataKonvensional); $i++){
  $groupedData[$dataKonvensional[$i]["hari_ke"]][] = $dataKonvensional[$i];
  $groupedData[$dataKonvensional[$i]["hari_ke"]][] = $resultDataIoT[$i];
}
// var_dump($groupedData); die();

?>
<div class="container" style="margin-left: 18vw;">
<h1>Perbandingan Parameter</h1>
<?php foreach ($groupedData as $hari => $records): ?>
<table class="table table-hover">
  <thead class="table-primary">
    <tr>
      <th colspan="3">Hari Ke <?= $hari ?></th>
    </tr>
    <tr>
      <th scope="col">Parameter</th>
      <th scope="col">Konvensional</th>
      <th scope="col">IoT</th>
      <th scope="col">Selisih</th>
    </tr>
  </thead>
  <tbody>
    <?php for ($i = 0; $i < count($records); $i += 2): ?>
      <?php if (isset($records[$i+1])): // Pastikan ada pasangan IoT ?>
        <tr>
          <td colspan="4" class="badge text-bg-info text-center">
            <?= $records[$i]["waktu"] ?>
          </td>
        </tr>
        <tr>
          <td>CO2</td>
          <td><?= $records[$i]["co2"] ?> ppm</td>
          <td><?= $records[$i+1]["co2"] ?> ppm</td>
          <td><?= abs($records[$i+1]["co2"] -  $records[$i]["co2"]) ?> ppm</td>
        </tr>
        <tr>
          <td>Humidity</td>
          <td><?= $records[$i]["humidity"] ?> %</td>
          <td><?= $records[$i+1]["humidity"] ?> %</td>
          <td><?= abs($records[$i+1]["humidity"] -  $records[$i]["humidity"]) ?> %</td>
        </tr>
        <tr>
          <td>Suhu</td>
          <td><?= $records[$i]["suhu"] ?> °C</td>
          <td><?= $records[$i+1]["suhu"] ?> °C</td>
          <td><?= abs($records[$i+1]["suhu"] -  $records[$i]["suhu"]) ?> °C</td>
        </tr>
        <tr>
          <td>Lux</td>
          <td><?= $records[$i]["lux"] ?> lux</td>
          <td><?= $records[$i+1]["lux"] ?> lux</td>
          <td><?= abs($records[$i+1]["lux"] -  $records[$i]["lux"]) ?> lux</td>
        </tr>
      <?php else: // Jika tidak ada pasangan IoT, tampilkan satu kolom saja ?>
        <tr>
          <td colspan="3" class="badge text-bg-warning text-center">
            Data IoT Tidak Tersedia
          </td>
        </tr>
        <tr>
          <td>CO2</td>
          <td><?= $records[$i]["co2"] ?></td>
          <td>-</td>
        </tr>
        <tr>
          <td>Humidity</td>
          <td><?= $records[$i]["humidity"] ?></td>
          <td>-</td>
        </tr>
        <tr>
          <td>Suhu</td>
          <td><?= $records[$i]["suhu"] ?></td>
          <td>-</td>
        </tr>
        <tr>
          <td>Lux</td>
          <td><?= $records[$i]["lux"] ?></td>
          <td>-</td>
        </tr>
      <?php endif; ?>
    <?php endfor; ?>
  </tbody>
</table>
<?php endforeach; ?>

</div>

<script>


</script>
 
</div>
<?php include_once 'footer.php' ?>
<?php 
include_once 'header.php'; 
include_once 'api/Database.php'; 
$db = new Database("localhost", "root", "", "iot_emersed");

// Parameter mapping untuk bahasa Inggris
$param_names = [
    'panjang' => 'Length Ratio',
    'lebar'   => 'Width Ratio',
    'tinggi'  => 'Height Ratio',
    'tunas'   => 'Shoots Comparison'
];

// Function to get parameter data from DB
function getDataParameter($conn, $tanaman_id, $table, $param) {
    $sql = "SELECT hari, $param AS value FROM `$table` WHERE tanaman = $tanaman_id ORDER BY hari ASC";
    $res = mysqli_query($conn, $sql);
    $labels = [];
    $values = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $labels[] = $row['hari'];
        $values[] = $row['value'];
    }
    return ['labels' => $labels, 'values' => $values];
}

$parameters = array_keys($param_names);
$data_chart = [];

foreach ($parameters as $param) {
    for ($i = 1; $i <= 4; $i++) {
        $iot  = getDataParameter($db->conn, $i, 'data_pertumbuhan_iot', $param);
        $konv = getDataParameter($db->conn, $i, 'data_pertumbuhan_konvensional', $param);

        $data_chart[$param][] = [
            'labels' => $iot['labels'],
            'iot'    => $iot['values'],
            'konv'   => $konv['values']
        ];
    }
}
?> 

<div class="container" style="margin-left: 20vw;">
    <?php foreach ($parameters as $param): ?>
        <h2 class="mt-4 text-primary">Plant <?= $param_names[$param] ?></h2>
        <?php for ($i = 1; $i <= 4; $i++): ?>
            <div class="mb-5">
                <h4><span class="badge bg-secondary"><?= $param_names[$param] ?> - Plant <?= $i ?></span></h4>
                <canvas id="<?= $param ?>_plant<?= $i ?>"></canvas>
            </div>
        <?php endfor; ?>
    <?php endforeach; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dataChart = <?= json_encode($data_chart) ?>;
    const paramNames = <?= json_encode($param_names) ?>;

    Object.keys(dataChart).forEach(param => {
        dataChart[param].forEach((chartData, index) => {
            const ctx = document.getElementById(param + '_plant' + (index + 1));
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [
                        {
                            label: 'Conventional',
                            data: chartData.konv,
                            borderColor: 'green',
                            backgroundColor: 'rgba(0, 128, 0, 0.2)',
                            tension: 0.2
                        },
                        {
                            label: 'IoT',
                            data: chartData.iot,
                            borderColor: 'blue',
                            backgroundColor: 'rgba(0, 0, 255, 0.2)',
                            tension: 0.2
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: `${paramNames[param]} - Plant ${index + 1}`
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Day'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: `${paramNames[param]}`
                            }
                        }
                    }
                }
            });
        });
    });
</script>

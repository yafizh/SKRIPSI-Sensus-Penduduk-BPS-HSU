<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Grafik Pendidikan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../../assets/images/logo/logo.jpg" type="image/x-icon" />
</head>

<body>
    <?php include_once('header.php'); ?>
    <h4 class="text-center my-3">Laporan Grafik Pendidikan</h4>
    <section class="p-3">
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-3">
                <table class="table">
                    <tr>
                        <td class="align-middle td-fit">Periode Sensus</td>
                        <td class="pl-5">: <?= $_GET['dari_periode_sensus']; ?> - <?= $_GET['sampai_periode_sensus']; ?></td>
                    </tr>
                    <tr>
                        <?php $pendidikan = $koneksi->query("SELECT * FROM pendidikan WHERE id=" . $_GET['id_pendidikan'])->fetch_assoc(); ?>
                        <td class="align-middle td-fit">Pendidikan</td>
                        <td class="pl-5">: <?= $pendidikan['nama']; ?></td>
                    </tr>
                    <?php if (isset($_GET['kecamatan'])) : ?>
                        <tr>
                            <td class="align-middle td-fit">Kecamatan</td>
                            <td class="pl-5">: <?= $_GET['kecamatan']; ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if (isset($_GET['kelurahan'])) : ?>
                        <tr>
                            <td class="align-middle td-fit">Kelurahan/Desa</td>
                            <td class="pl-5">: <?= $_GET['kelurahan']; ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </section>
    <main class="p-3">
        <canvas id="Chart2" style="width: 100%; height: 350px"></canvas>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="../../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/js/Chart.min.js"></script>
    <script src="../../../assets/js/apexcharts.min.js"></script>
    <script src="../../../assets/js/dynamic-pie-chart.js"></script>
    <?php
    $q = "
        SELECT 
            ps.tahun,
            COUNT(p.id) jumlah
        FROM 
            penduduk p 
        INNER JOIN 
            periode_sensus ps 
        ON 
            ps.id=p.id_periode_sensus 
        INNER JOIN 
            `kelurahan/desa` kd  
        ON 
            kd.id=p.`id_kelurahan/desa`
        INNER JOIN 
            kecamatan k 
        ON 
            k.id=kd.id_kecamatan  
        WHERE 
            (ps.tahun >= " . $_GET['dari_periode_sensus'] . " AND ps.tahun <= " . $_GET['sampai_periode_sensus'] . ")
            AND 
            p.id_pendidikan=" . $_GET['id_pendidikan'] . "
        ";

    if (isset($_GET['kecamatan']))
        $q .= " AND k.nama='" . $_GET['kecamatan'] . "'";

    if (isset($_GET['kelurahan']))
        $q .= " AND kd.nama='" . $_GET['kelurahan'] . "'";

    $q .= "GROUP BY ps.tahun ORDER BY ps.tahun";

    $result = $koneksi->query($q)->fetch_all(MYSQLI_ASSOC);

    $labels = [];
    $data = [];
    foreach ($result as $value) {
        $labels[] = $value['tahun'];
        $data[] = $value['jumlah'];
    }
    ?>
    <script>
        const ctx2 = document.getElementById("Chart2").getContext("2d");
        const chart2 = new Chart(ctx2, {
            // The type of chart we want to create
            type: "bar", // also try bar or other graph types
            // The data for our dataset
            data: {
                labels: JSON.parse('<?= json_encode($labels); ?>'),
                // Information about the dataset
                datasets: [{
                    label: "",
                    backgroundColor: "#4A6CF7",
                    barThickness: 6,
                    maxBarThickness: 8,
                    data: JSON.parse('<?= json_encode($data); ?>'),
                }, ],
            },
            // Configuration options
            options: {
                borderColor: "#F3F6F8",
                borderWidth: 15,
                backgroundColor: "#F3F6F8",
                tooltips: {
                    callbacks: {
                        labelColor: function(tooltipItem, chart) {
                            return {
                                backgroundColor: "rgba(104, 110, 255, .0)",
                            };
                        },
                    },
                    backgroundColor: "#F3F6F8",
                    titleFontColor: "#8F92A1",
                    titleFontSize: 12,
                    bodyFontColor: "#171717",
                    bodyFontStyle: "bold",
                    bodyFontSize: 16,
                    multiKeyBackground: "transparent",
                    displayColors: false,
                    xPadding: 30,
                    yPadding: 10,
                    bodyAlign: "center",
                    titleAlign: "center",
                },

                title: {
                    display: false,
                },
                legend: {
                    display: false,
                },

                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawTicks: false,
                            drawBorder: false,
                        },
                        ticks: {
                            padding: 35,
                            // max: 1200,
                            min: 0,
                            callback: function(value) {
                                if (value % 1 === 0) {
                                    return value;
                                }
                            }
                        },
                    }, ],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                            color: "rgba(143, 146, 161, .1)",
                            zeroLineColor: "rgba(143, 146, 161, .1)",
                        },
                        ticks: {
                            padding: 20,
                        },
                    }, ],
                },
            },
        });
    </script>
    <script>
        // setTimeout(() => {
        //     window.print();
        // }, 1000);
    </script>
</body>

</html>
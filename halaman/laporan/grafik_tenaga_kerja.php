<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Laporan Grafik Tenaga Kerja</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="tables-wrapper">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card-style mb-30">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <?php $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus ORDER BY tahun"); ?>
                                    <div class="select-style-1">
                                        <label>Dari Periode Sensus</label>
                                        <div class="select-position">
                                            <select name="dari_periode_sensus" required>
                                                <option value="" selected disabled>Pilih Periode Sensus</option>
                                                <?php while ($row = $periode_sensus->fetch_assoc()) : ?>
                                                    <option <?= ($_POST['dari_periode_sensus'] ?? '') == $row['tahun'] ? 'selected' : '' ?> value="<?= $row['tahun']; ?>"><?= $row['tahun']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <?php $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus ORDER BY tahun DESC"); ?>
                                    <div class="select-style-1">
                                        <label>Sampai Periode Sensus</label>
                                        <div class="select-position">
                                            <select name="sampai_periode_sensus" required>
                                                <option value="" selected disabled>Pilih Periode Sensus</option>
                                                <?php while ($row = $periode_sensus->fetch_assoc()) : ?>
                                                    <option <?= ($_POST['sampai_periode_sensus'] ?? '') == $row['tahun'] ? 'selected' : '' ?> value="<?= $row['tahun']; ?>"><?= $row['tahun']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <?php $periode_sensus = $koneksi->query("SELECT * FROM jenis_pekerjaan ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Tenaga Kerja</label>
                                        <div class="select-position">
                                            <select name="jenis_pekerjaan" required>
                                                <option value="" selected disabled>Pilih Tenaga Kerja</option>
                                                <?php while ($row = $periode_sensus->fetch_assoc()) : ?>
                                                    <option <?= ($_POST['jenis_pekerjaan'] ?? '') == $row['id'] ? 'selected' : '' ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <?php $kecamatan = $koneksi->query("SELECT DISTINCT UPPER(nama) nama FROM kecamatan ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Kecamatan</label>
                                        <div class="select-position">
                                            <select name="kecamatan">
                                                <option value="" selected disabled>Semua Kecamatan</option>
                                                <?php while ($row = $kecamatan->fetch_assoc()) : ?>
                                                    <option <?= ($_POST['kecamatan'] ?? '') == $row['nama'] ? 'selected' : '' ?> value="<?= $row['nama']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <?php $kelurahan = $koneksi->query("SELECT DISTINCT UPPER(nama) nama FROM `kelurahan/desa` ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Kelurahan/Desa</label>
                                        <div class="select-position">
                                            <select name="kelurahan">
                                                <option value="" selected disabled>Semua Kelurahan/Desa</option>
                                                <?php while ($row = $kelurahan->fetch_assoc()) : ?>
                                                    <option <?= ($_POST['kelurahan'] ?? '') == $row['nama'] ? 'selected' : '' ?> value="<?= $row['nama']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Filter</button>
                                    <?php if (
                                        isset($_POST['dari_periode_sensus'])
                                        &&
                                        isset($_POST['sampai_periode_sensus'])
                                        &&
                                        isset($_POST['jenis_pekerjaan'])
                                    ) : ?>
                                        <?php
                                        $link = "halaman/laporan/cetak/kecamatan.php?dari_periode_sensus=" . $_POST['dari_periode_sensus'] . "&sampai_periode_sensus=" . $_POST['dari_periode_sensus'] . "&jenis_pekerjaan=" . $_POST['jenis_pekerjaan'];
                                        if (isset($_POST['kecamatan']))
                                            $link .= "&kecamatan=" . $_POST['kecamatan'];
                                        if (isset($_POST['kelurahan']))
                                            $link .= "&kelurahan=" . $_POST['kelurahan'];
                                        ?>
                                        <a href="<?= $link; ?>" target="_blank" class="main-btn btn-sm success-btn btn-hover">Cetak</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php if (isset($_POST['dari_periode_sensus']) && isset($_POST['sampai_periode_sensus'])) : ?>
                    <div class="col-12">
                        <div class="card-style mb-30">
                            <div class="title d-flex flex-wrap align-items-center justify-content-between">
                                <div class="left">
                                    <h6 class="text-medium mb-30">Grafik Tenaga Kerja Periode Sensus <?= $_POST['dari_periode_sensus']; ?> - <?= $_POST['sampai_periode_sensus']; ?> <?= isset($_POST['kecamatan']) ? 'Kecamatan ' . $_POST['kecamatan'] : ''; ?> <?= isset($_POST['kelurahan']) ? 'Kelurahan ' . $_POST['kelurahan'] : ''; ?></h6>
                                </div>
                            </div>
                            <div class="chart">
                                <canvas id="Chart2" style="width: 100%; height: 400px"></canvas>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php require_once('layout/js.php'); ?>
<?php if (isset($_POST['dari_periode_sensus']) && isset($_POST['sampai_periode_sensus'])) : ?>

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
        (ps.tahun >= " . $_POST['dari_periode_sensus'] . " AND ps.tahun <= " . $_POST['sampai_periode_sensus'] . ") 
        AND 
        p.jenis_pekerjaan=" . $_POST['jenis_pekerjaan'] . "
    ";

    if (isset($_POST['kecamatan']))
        $q .= " AND k.nama='" . $_POST['kecamatan'] . "'";

    if (isset($_POST['kelurahan']))
        $q .= " AND kd.nama='" . $_POST['kelurahan'] . "'";

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
<?php endif; ?>
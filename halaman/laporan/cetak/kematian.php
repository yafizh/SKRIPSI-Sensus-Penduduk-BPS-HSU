<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Kematian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../../assets/images/logo/logo.jpg" type="image/x-icon" />
</head>

<body>
    <?php include_once('header.php'); ?>
    <?php
    $q = "
    SELECT * FROM penduduk
        ";

    if (isset($_GET['id_periode_sensus']))
        $q .= " AND periode_sensus.id=" . $_GET['id_periode_sensus'];

    if (isset($_GET['kecamatan']))
        $q .= " AND kecamatan.nama='" . $_GET['kecamatan'] . "'";

    if (isset($_GET['kelurahan']))
        $q .= " AND `kelurahan/desa`.nama='" . $_GET['kelurahan'] . "'";

    // $q .= " ORDER BY kematian.nama";
    $result = $koneksi->query($q);
    ?>
    <h4 class="text-center my-3">Laporan Kematian</h4>
    <section class="p-3">
        <div class="row">
            <div class="col-12 col-sm-6">
                <table class="table">
                    <?php if (isset($_GET['id_periode_sensus'])) : ?>
                        <?php $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus WHERE id=" . $_GET['id_periode_sensus'])->fetch_assoc();  ?>
                        <tr>
                            <td class="align-middle td-fit">Periode Sensus</td>
                            <td class="pl-5">: <?= $periode_sensus['tahun']; ?></td>
                        </tr>
                    <?php endif; ?>
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
                    <tr>
                        <td class="align-middle td-fit">Total Kematian</td>
                        <td class="pl-5">: <?= $result->num_rows; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
    <main class="p-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle fit">
                        <h6>No</h6>
                    </th>
                    <?php if (!isset($_POST['id_periode_sensus'])) : ?>
                        <th class="text-center align-middle">
                            <h6>Periode Sensus</h6>
                        </th>
                    <?php endif; ?>
                    <?php if (!isset($_POST['kecamatan'])) : ?>
                        <th class="text-center align-middle">
                            <h6>Kecamatan</h6>
                        </th>
                    <?php endif; ?>
                    <?php if (!isset($_POST['kelurahan'])) : ?>
                        <th class="text-center align-middle">
                            <h6>Kelurahan/Desa</h6>
                        </th>
                    <?php endif; ?>
                    <th class="text-center align-middle">
                        <h6>NIK</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Nama</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Jenis Kelamin</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Penyebab Kematian</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Tanggal</h6>
                    </th>
            </thead>
            <?php
            $no = 1;
            ?>
            <tbody>
                <?php if ($result->num_rows) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td class="text-center fit">
                                <p><?= $no++; ?></p>
                            </td>
                            <td class="text-center">
                                <p>2024</p>
                            </td>
                            <td class="text-center">
                                <p>Amuntai Selatan</p>
                            </td>
                            <td class="text-center">
                                <p>Jawa</p>
                            </td>
                            <td class="text-center">
                                <p><?= $row['nik']; ?></p>
                            </td>
                            <td>
                                <p><?= $row['nama']; ?></p>
                            </td>
                            <td class="text-center">
                                <p><?= $row['jenis_kelamin']; ?></p>
                            </td>
                            <td class="text-center">
                                <p>Sakit</p>
                            </td>
                            <td class="text-center">
                                <p>10 Januari 2024</p>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td class="text-center" colspan="6">Data Kosong</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <?php include_once('footer.php'); ?>
</body>

</html>
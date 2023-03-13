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
        SELECT 
            kecamatan.nama nama_kecamatan,
            kematian.*, 
            DATE(kematian.tanggal_waktu) tanggal,
            penyebab_kematian.nama penyebab_kematian,
            `kelurahan/desa`.nama nama_kelurahan,
            `kelurahan/desa`.status status_kelurahan,
            periode_sensus.tahun
        FROM 
            kematian 
        INNER JOIN 
            penyebab_kematian 
        ON 
            penyebab_kematian.id=kematian.id_penyebab_kematian 
        INNER JOIN 
            `kelurahan/desa` 
        ON 
            `kelurahan/desa`.id=`kematian`.`id_kelurahan/desa`  
        INNER JOIN 
            kecamatan 
        ON 
            kecamatan.id=`kelurahan/desa`.id_kecamatan 
        INNER JOIN 
            periode_sensus 
        ON 
            periode_sensus.id=kematian.id_periode_sensus 
        WHERE 
            1=1 
        ";

    if (isset($_GET['id_periode_sensus']))
        $q .= " AND periode_sensus.id=" . $_GET['id_periode_sensus'];

    if (isset($_GET['kecamatan']))
        $q .= " AND kecamatan.nama='" . $_GET['kecamatan'] . "'";

    if (isset($_GET['kelurahan']))
        $q .= " AND `kelurahan/desa`.nama='" . $_GET['kelurahan'] . "'";

    $q .= " ORDER BY kematian.nama";
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
                            <td class="text-center align-middle fit">
                                <p class="m-0"><?= $no++; ?></p>
                            </td>
                            <?php if (!isset($_GET['id_periode_sensus'])) : ?>
                                <td class="text-center">
                                    <p class="m-0"><?= $row['tahun']; ?></p>
                                </td>
                            <?php endif; ?>
                            <?php if (!isset($_GET['kecamatan'])) : ?>
                                <td class="text-center">
                                    <p class="m-0"><?= $row['nama_kecamatan']; ?></p>
                                </td>
                            <?php endif; ?>
                            <?php if (!isset($_GET['kelurahan'])) : ?>
                                <td class="text-center">
                                    <p class="m-0"><?= $row['nama_kelurahan']; ?></p>
                                </td>
                            <?php endif; ?>
                            <td class="text-center align-middle">
                                <p class="m-0"><?= $row['nik']; ?></p>
                            </td>
                            <td class="align-middle">
                                <p class="m-0"><?= $row['nama']; ?></p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="m-0"><?= $row['jenis_kelamin']; ?></p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="m-0"><?= $row['penyebab_kematian']; ?></p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="m-0"><?= indonesiaDate($row['tanggal']); ?></p>
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
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Kelahiran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../../assets/images/logo/logo.jpg" type="image/x-icon" />
</head>

<body>
    <?php include_once('header.php'); ?>
    <?php
    $q = "
        SELECT 
            penduduk.*
        FROM 
            kelahiran 
        INNER JOIN 
            penduduk 
        ON 
            penduduk.id=kelahiran.id_penduduk  
        INNER JOIN 
            `kelurahan/desa` 
        ON 
            `kelurahan/desa`.id=`kelahiran`.`id_kelurahan/desa`  
        INNER JOIN 
            kecamatan 
        ON 
            kecamatan.id=`kelurahan/desa`.id_kecamatan 
        INNER JOIN 
            periode_sensus 
        ON 
            periode_sensus.id=kelahiran.id_periode_sensus 
        WHERE 
            periode_sensus.id=" . $_GET['id_periode_sensus'] . " 
            AND 
            kecamatan.nama='" . $_GET['kecamatan'] . "' 
            AND 
            `kelurahan/desa`.nama='" . $_GET['kelurahan'] . "'
        ";
    $q .= " ORDER BY penduduk.nama";
    $result = $koneksi->query($q);
    ?>
    <h4 class="text-center my-3">Laporan Kelahiran</h4>
    <?php $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus WHERE id=" . $_GET['id_periode_sensus'])->fetch_assoc();  ?>
    <section class="p-3">
        <div class="row">
            <div class="col-12 col-sm-6">
                <table class="table">
                    <tr>
                        <td class="align-middle td-fit">Periode Sensus</td>
                        <td class="pl-5">: <?= $periode_sensus['tahun']; ?></td>
                    </tr>
                    <tr>
                        <td class="align-middle td-fit">Kecamatan</td>
                        <td class="pl-5">: <?= $_GET['kecamatan']; ?></td>
                    </tr>
                    <tr>
                        <td class="align-middle td-fit">Kelurahan/Desa</td>
                        <td class="pl-5">: <?= $_GET['kelurahan']; ?></td>
                    </tr>
                    <tr>
                        <td class="align-middle td-fit">Total Kelahiran</td>
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
                    <th class="text-center align-middle">
                        <h6>Nama</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Tempat Lahir</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Tanggal Lahir</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Jenis Kelamin</h6>
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
                            <td class="align-middle">
                                <p class="m-0"><?= $row['nama']; ?></p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="m-0"><?= $row['tempat_lahir']; ?></p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="m-0"><?= indonesiaDate($row['tanggal_lahir']); ?></p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="m-0"><?= $row['jenis_kelamin']; ?></p>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td class="text-center" colspan="5">Data Kosong</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <?php include_once('footer.php'); ?>
</body>

</html>
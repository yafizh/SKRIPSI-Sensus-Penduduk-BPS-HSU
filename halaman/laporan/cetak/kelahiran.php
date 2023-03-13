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
            kecamatan.nama nama_kecamatan,
            penduduk.*, 
            `kelurahan/desa`.nama nama_kelurahan,
            `kelurahan/desa`.status status_kelurahan,
            periode_sensus.tahun
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
            1=1 
        ";

    if (isset($_POST['id_periode_sensus']))
        $q .= " AND periode_sensus.id=" . $_POST['id_periode_sensus'];

    if (isset($_POST['kecamatan']))
        $q .= " AND kecamatan.nama='" . $_POST['kecamatan'] . "'";

    if (isset($_POST['kelurahan']))
        $q .= " AND `kelurahan/desa`.nama='" . $_POST['kelurahan'] . "'";

    $q .= " ORDER BY penduduk.nama";
    $result = $koneksi->query($q);
    ?>
    <h4 class="text-center my-3">Laporan Kelahiran</h4>
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
                    <tr>
                        <?php
                        $q = "SELECT * FROM petugas";

                        if (isset($_GET['id_periode_sensus']))
                            $q .= " WHERE id_periode_sensus=" . $periode_sensus['id'];

                        $petugas = $koneksi->query($q);
                        ?>
                        <td class="align-middle td-fit">Jumlah Petugas</td>
                        <td class="pl-5">: <?= $petugas->num_rows; ?></td>
                    </tr>
                    <tr>
                        <?php
                        $q = "SELECT * FROM penduduk";

                        if (isset($_GET['id_periode_sensus']))
                            $q .= " WHERE id_periode_sensus=" . $periode_sensus['id'];

                        $penduduk = $koneksi->query($q);
                        ?>
                        <td class="align-middle td-fit">Jumlah Penduduk</td>
                        <td class="pl-5">: <?= $penduduk->num_rows; ?></td>
                    </tr>
                    <tr>
                        <?php
                        $q = "SELECT * FROM kelahiran";

                        if (isset($_GET['id_periode_sensus']))
                            $q .= " WHERE id_periode_sensus=" . $periode_sensus['id'];

                        $kelahiran = $koneksi->query($q);
                        ?>
                        <td class="align-middle td-fit">Jumlah Kelahiran</td>
                        <td class="pl-5">: <?= $kelahiran->num_rows; ?></td>
                    </tr>
                    <tr>
                        <?php
                        $q = "SELECT * FROM kematian";

                        if (isset($_GET['id_periode_sensus']))
                            $q .= " WHERE id_periode_sensus=" . $periode_sensus['id'];

                        $kematian = $koneksi->query($q);
                        ?>
                        <td class="align-middle td-fit">Jumlah Kematian</td>
                        <td class="pl-5">: <?= $kematian->num_rows; ?></td>
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
                            <?php if (!isset($_POST['id_periode_sensus'])) : ?>
                                <td class="text-center align-middle">
                                    <p class="m-0"><?= $row['tahun']; ?></p>
                                </td>
                            <?php endif; ?>
                            <?php if (!isset($_POST['kecamatan'])) : ?>
                                <td class="text-center align-middle">
                                    <p class="m-0"><?= $row['nama_kecamatan']; ?></p>
                                </td>
                            <?php endif; ?>
                            <?php if (!isset($_POST['kelurahan'])) : ?>
                                <td class="text-center align-middle">
                                    <p class="m-0"><?= $row['nama_kelurahan']; ?></p>
                                </td>
                            <?php endif; ?>
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
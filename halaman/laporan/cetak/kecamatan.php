<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Kecamatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../../assets/images/logo/logo.jpg" type="image/x-icon" />
</head>

<body>
    <?php include_once('header.php'); ?>
    <h4 class="text-center my-3">Laporan Kecamatan</h4>

    <section class="p-3">
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-2">
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
                    <th rowspan="2" class="text-center align-middle fit">
                        <h6>No</h6>
                    </th>
                    <th rowspan="2" class="text-center align-middle">
                        <h6>Periode Sensus</h6>
                    </th>
                    <th rowspan="2" class="text-center align-middle">
                        <h6>Nama Kecamatan</h6>
                    </th>
                    <th class="text-center align-middle" colspan="5">
                        Jumlah
                    </th>
                </tr>
                <tr>
                    <th class="text-center align-middle">
                        <h6>Petugas</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Kelurahan/Desa</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Penduduk</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Kematian</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Kelahiran</h6>
                    </th>
                </tr>
            </thead>
            <?php
            $q = "
            SELECT 
                kecamatan.*,
                periode_sensus.tahun,
                (SELECT IFNULL(COUNT(*), 0) FROM petugas_kecamatan WHERE id_kecamatan=kecamatan.id) jumlah_petugas,
                (SELECT IFNULL(COUNT(*), 0) FROM `kelurahan/desa` WHERE id_kecamatan=kecamatan.id) jumlah_kelurahan,
                (SELECT IFNULL(COUNT(*), 0) FROM penduduk INNER JOIN `kelurahan/desa` ON `kelurahan/desa`.id=penduduk.`id_kelurahan/desa` WHERE `kelurahan/desa`.id_kecamatan=kecamatan.id) jumlah_penduduk, 
                (SELECT IFNULL(COUNT(*), 0) FROM kelahiran INNER JOIN `kelurahan/desa` ON `kelurahan/desa`.id=kelahiran.`id_kelurahan/desa` WHERE `kelurahan/desa`.id_kecamatan=kecamatan.id) jumlah_kelahiran, 
                (SELECT IFNULL(COUNT(*), 0) FROM kematian INNER JOIN `kelurahan/desa` ON `kelurahan/desa`.id=kematian.`id_kelurahan/desa` WHERE `kelurahan/desa`.id_kecamatan=kecamatan.id) jumlah_kematian 
            FROM 
                kecamatan 
            INNER JOIN 
                periode_sensus 
            ON 
                periode_sensus.id=kecamatan.id_periode_sensus";

            if (isset($_GET['id_periode_sensus']))
                $q .= " WHERE periode_sensus.id=" . $_GET['id_periode_sensus'];

            $q .= " ORDER BY periode_sensus.tahun DESC";
            $result = $koneksi->query($q);
            $no = 1;
            $jumlah_petugas = 0;
            $jumlah_kelurahan = 0;
            $jumlah_penduduk = 0;
            $jumlah_kematian = 0;
            $jumlah_kelahiran = 0;
            ?>
            <tbody>
                <?php if ($result->num_rows) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td class="text-center align-middle fit">
                                <p class="m-0"><?= $no++; ?></p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="m-0"><?= $row['tahun']; ?></p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="m-0"><?= $row['nama']; ?></p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="m-0"><?= $row['jumlah_petugas']; ?></p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="m-0"><?= $row['jumlah_kelurahan']; ?></p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="m-0"><?= $row['jumlah_penduduk']; ?></p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="m-0"><?= $row['jumlah_kematian']; ?></p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="m-0"><?= $row['jumlah_kelahiran']; ?></p>
                            </td>
                            <?php
                            $jumlah_petugas += $row['jumlah_petugas'];
                            $jumlah_kelurahan += $row['jumlah_kelurahan'];
                            $jumlah_penduduk += $row['jumlah_penduduk'];
                            $jumlah_kematian += $row['jumlah_kematian'];
                            $jumlah_kelahiran += $row['jumlah_kelahiran'];
                            ?>
                        </tr>
                    <?php endwhile; ?>
                    <tr>
                        <td colspan="3" class="text-center align-middle fit">
                            <p class="m-0"><b>Total</b></p>
                        </td>
                        <td class="text-center align-middle">
                            <p class="m-0"><b><?= $jumlah_petugas; ?></b></p>
                        </td>
                        <td class="text-center align-middle">
                            <p class="m-0"><b><?= $jumlah_kelurahan; ?></b></p>
                        </td>
                        <td class="text-center align-middle">
                            <p class="m-0"><b><?= $jumlah_penduduk; ?></b></p>
                        </td>
                        <td class="text-center align-middle">
                            <p class="m-0"><b><?= $jumlah_kematian; ?></b></p>
                        </td>
                        <td class="text-center align-middle">
                            <p class="m-0"><b><?= $jumlah_kelahiran; ?></b></p>
                        </td>
                    </tr>
                <?php else : ?>
                    <tr>
                        <td class="text-center" colspan="8">Data Kosong</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <?php include_once('footer.php'); ?>
</body>

</html>
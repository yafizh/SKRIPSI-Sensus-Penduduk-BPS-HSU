<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Pencapaian Petugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../../assets/images/logo/logo.jpg" type="image/x-icon" />
</head>

<body>
    <?php include_once('header.php'); ?>
    <h4 class="text-center my-3">Laporan Pencapaian Petugas</h4>
    <?php $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus WHERE id=" . $_GET['id_periode_sensus'])->fetch_assoc();  ?>
    <?php $pegawai = $koneksi->query("SELECT * FROM pegawai WHERE id=" . $_GET['id_pegawai'])->fetch_assoc();  ?>
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
                        <td class="align-middle td-fit">Pegawai</td>
                        <td class="pl-5">: <?= $pegawai['nip']; ?>/<?= $pegawai['nama']; ?></td>
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
                        <h6>Nama Kelurahan/Desa</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Rumah Tangga</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Penduduk</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Kelahiran</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Kematian</h6>
                    </th>
            </thead>
            <?php
            $q = "
            SELECT 
                kd.nama,
                kd.status,
                (SELECT COUNT(id) FROM kartu_keluarga WHERE `id_kelurahan/desa`=kd.id) jumlah_rumah_tangga, 
                (SELECT COUNT(id) FROM penduduk WHERE `id_kelurahan/desa`=kd.id) jumlah_penduduk, 
                (SELECT COUNT(id) FROM kelahiran WHERE `id_kelurahan/desa`=kd.id) jumlah_kelahiran,
                (SELECT COUNT(id) FROM kematian WHERE `id_kelurahan/desa`=kd.id) jumlah_kematian
            FROM 
                `kelurahan/desa` kd 
            INNER JOIN 
                kecamatan k 
            ON 
                k.id=kd.id_kecamatan 
            INNER JOIN 
                periode_sensus ps
            ON 
                ps.id=k.id_periode_sensus 
            INNER JOIN 
                petugas p
            ON 
                p.id_periode_sensus=ps.id 
            WHERE 
                ps.id=" . $_GET['id_periode_sensus'] . " 
                AND 
                k.nama='" . $_GET['kecamatan'] . "' 
                AND 
                p.id_pegawai=" . $_GET['id_pegawai'] . "
            ";

            $q .= " ORDER BY kd.nama";

            $result = $koneksi->query($q);
            $no = 1;
            ?>
            <tbody>
                <?php if ($result->num_rows) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <?php if (
                            $row['jumlah_rumah_tangga'] ||
                            $row['jumlah_penduduk'] ||
                            $row['jumlah_kelahiran'] ||
                            $row['jumlah_kematian']
                        ) : ?>
                            <tr>
                                <td class="text-center align-middle fit">
                                    <p class="m-0"><?= $no++; ?></p>
                                </td>
                                <td class="text-center align-middle">
                                    <p><?= $row['status']; ?> <?= $row['nama']; ?></p>
                                </td>
                                <td class="text-center align-middle">
                                    <p class="m-0"><?= $row['jumlah_rumah_tangga']; ?></p>
                                </td>
                                <td class="text-center align-middle">
                                    <p class="m-0"><?= $row['jumlah_penduduk']; ?></p>
                                </td>
                                <td class="text-center align-middle">
                                    <p class="m-0"><?= $row['jumlah_kelahiran']; ?></p>
                                </td>
                                <td class="text-center align-middle">
                                    <p class="m-0"><?= $row['jumlah_kematian']; ?></p>
                                </td>
                            </tr>
                        <?php endif; ?>
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
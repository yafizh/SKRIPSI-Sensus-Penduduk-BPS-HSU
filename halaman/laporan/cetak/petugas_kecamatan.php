<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Petugas Kecamatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../../assets/images/logo/logo.jpg" type="image/x-icon" />
</head>

<body>
    <?php include_once('header.php'); ?>
    <h4 class="text-center my-3">Laporan Petugas Kecamatan</h4>
    <?php if (isset($_GET['id_periode_sensus'])) : ?>
        <?php $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus WHERE id=" . $_GET['id_periode_sensus'])->fetch_assoc();  ?>
        <section class="p-3">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-2">
                    <table class="table">
                        <tr>
                            <td class="align-middle td-fit">Periode Sensus</td>
                            <td class="pl-5">: <?= $periode_sensus['tahun']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <main class="p-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle fit">
                        <h6>No</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Periode Sensus</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Kecamatan</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>NIP</h6>
                    </th>
                    <th class="text-center align-middle">
                        <h6>Nama</h6>
                    </th>
                </tr>
            </thead>
            <?php
            $q = "
                SELECT 
                    kecamatan.nama nama_kecamatan,
                    pegawai.*,
                    periode_sensus.tahun
                FROM 
                    petugas_kecamatan 
                INNER JOIN 
                    kecamatan 
                ON 
                    kecamatan.id=petugas_kecamatan.id_kecamatan 
                INNER JOIN 
                    petugas 
                ON 
                    petugas.id=petugas_kecamatan.id_petugas 
                INNER JOIN 
                    pegawai 
                ON 
                    pegawai.id=petugas.id_pegawai 
                INNER JOIN 
                    periode_sensus 
                ON 
                    periode_sensus.id=kecamatan.id_periode_sensus";

            if (isset($_GET['id_periode_sensus']))
                $q .= " WHERE periode_sensus.id=" . $_GET['id_periode_sensus'];

            $q .= " ORDER BY periode_sensus.tahun DESC";
            $result = $koneksi->query($q);
            $no = 1;
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
                                <p class="m-0"><?= $row['nama_kecamatan']; ?></p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="m-0"><?= $row['nip']; ?></p>
                            </td>
                            <td class="text-center align-middle">
                                <p class="m-0"><?= $row['nama']; ?></p>
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
<?php
$kelurahan = $koneksi->query("SELECT * FROM `kelurahan/desa` WHERE id=" . $_GET['id_kelurahan'])->fetch_assoc();
$kecamatan = $koneksi->query("SELECT * FROM kecamatan WHERE id=" . $_GET['id_kecamatan'])->fetch_assoc();

if (isset($_SESSION['user']['id_petugas'])) {
    $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus WHERE status='Berjalan'");
    if ($periode_sensus->num_rows)
        $periode_sensus = $periode_sensus->fetch_assoc();
    else
        $periode_sensus = null;
} else
    $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus WHERE id=" . $_GET['id_periode_sensus'])->fetch_assoc();

?>
<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <?php if ($_SESSION['user']['id_petugas']) : ?>
                            <h3>
                                <a href="?page=kecamatan&sub_page=kelurahan&action=tampil&id_kecamatan=<?= $kecamatan['id']; ?>&id_kelurahan=<?= $kelurahan['id']; ?>" class="breadcrumb-item">Data Sensus</a>
                                <span style="color: #5D657B;">/</span>
                                Data Kelahiran
                            </h3>
                        <?php else : ?>
                            <h3>
                                <a href="?page=data_sensus&sub_page=penduduk&action=tampil" class="breadcrumb-item">Data Penduduk</a>
                                <span style="color: #5D657B;">/</span>
                                <a href="?page=data_sensus&sub_page=penduduk&action=detail_per_kecamatan&id_kecamatan=<?= $kecamatan['id']; ?>&id_periode_sensus=<?= $periode_sensus['id']; ?>" class="breadcrumb-item">Kecamatan <?= $kecamatan['nama']; ?></a>
                                <span style="color: #5D657B;">/</span>
                                <?= $kelurahan['status']; ?> <?= $kelurahan['nama']; ?> (Periode Sensus <?= $periode_sensus['tahun']; ?>)
                            </h3>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- <?php if ($_SESSION['user']['id_petugas']) : ?>
                    <div class="col-auto">
                        <a href="?page=kecamatan&sub_page=kelurahan&action=tambah_kelahiran&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>" class="btn btn-primary mb-30">Tambah</a>
                    </div>
                <?php endif; ?> -->
            </div>
        </div>
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <div class="table-responsive">
                            <table id="table" class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center fit">
                                            <h6>No</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Nama</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Tempat Lahir</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Tanggal Lahir</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Jenis Kelamin</h6>
                                        </th>
                                        <th class="fit">
                                            <h6></h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                    SELECT 
                                        k.*,
                                        p.nama,
                                        p.tempat_lahir, 
                                        p.tanggal_lahir, 
                                        p.jenis_kelamin,
                                        p.id id_penduduk,
                                        ak.id_kartu_keluarga 
                                    FROM 
                                        kelahiran k 
                                    INNER JOIN 
                                        penduduk p
                                    ON 
                                        p.id=k.id_penduduk 
                                    INNER JOIN 
                                        anggota_keluarga ak
                                    ON 
                                        p.id=ak.id_penduduk
                                    WHERE 
                                        k.`id_kelurahan/desa`=" . $kelurahan['id'] . " 
                                        AND 
                                        k.`id_periode_sensus`=" . $periode_sensus['id'] . " 
                                    ORDER BY 
                                        k.id DESC";
                                $result = $koneksi->query($q);
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
                                                    <p><?= $row['nama']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['tempat_lahir']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['tanggal_lahir']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['jenis_kelamin']; ?></p>
                                                </td>
                                                <td class="fit">
                                                    <div class="d-flex gap-3">
                                                        <div class="action">
                                                            <a href="?page=kecamatan&sub_page=kelurahan&action=ubah_anggota_keluarga&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>&id_penduduk=<?= $row['id_penduduk']; ?>&id_kartu_keluarga=<?= $row['id_kartu_keluarga']; ?>&kelahiran=1" class="text-warning">
                                                                <i class="lni lni-pencil"></i>
                                                            </a>
                                                        </div>
                                                        <div class="action">
                                                            <a onclick="return confirm('Yakin?')" href="?page=kecamatan&sub_page=kelurahan&action=hapus_kelahiran&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>&id=<?= $row['id']; ?>" class="text-danger">
                                                                <i class="lni lni-trash-can"></i>
                                                            </a>
                                                        </div>
                                                    </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once('layout/js.php'); ?>
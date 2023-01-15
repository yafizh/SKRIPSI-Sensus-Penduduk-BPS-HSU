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
                                Data Penduduk
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
                <?php if ($_SESSION['user']['id_petugas']) : ?>
                    <div class="col-auto">
                        <a href="?page=kecamatan&sub_page=kelurahan&action=tambah&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>" class="btn btn-primary mb-30">Tambah</a>
                    </div>
                <?php endif; ?>
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
                                            <h6>Nomor Kartu Keluarga</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Kepala Keluarga</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Jumlah Anggota Rumah Tangga (ART)</h6>
                                        </th>
                                        <th class="fit">
                                            <h6></h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                    SELECT 
                                        kk.*,
                                        (
                                            SELECT
                                                p.nama 
                                            FROM 
                                                anggota_keluarga ak 
                                            INNER JOIN 
                                                penduduk p  
                                            ON 
                                                p.id=ak.id_penduduk 
                                            INNER JOIN 
                                                status_keluarga sk 
                                            ON 
                                                sk.id=ak.id_status_keluarga 
                                            WHERE 
                                                sk.tingkat=1 
                                                AND 
                                                ak.id_kartu_keluarga=kk.id 
                                        ) kepala_keluarga, 
                                        (SELECT COUNT(*) FROM anggota_keluarga WHERE id_kartu_keluarga=kk.id) AS jumlah 
                                    FROM 
                                        kartu_keluarga kk  
                                    WHERE 
                                        kk.`id_kelurahan/desa`=" . $kelurahan['id'] . " 
                                        AND 
                                        kk.`id_periode_sensus`=" . $periode_sensus['id'] . " 
                                    ORDER BY 
                                        kk.nomor_kartu_keluarga";
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
                                                    <p><?= $row['nomor_kartu_keluarga']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['kepala_keluarga'] ?? 'Kepala Keluarga Belum Ditambahkan'; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['jumlah']; ?></p>
                                                </td>
                                                <td class="fit">
                                                    <div class="d-flex gap-3">
                                                        <div class="action">
                                                            <a href="?page=kecamatan&sub_page=kelurahan&action=detail_per_anggota_keluarga&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>&id_kartu_keluarga=<?= $row['id']; ?>" class="text-secondary">
                                                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                                    <path fill="currentColor" d="M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M12,4.5C17,4.5 21.27,7.61 23,12C21.27,16.39 17,19.5 12,19.5C7,19.5 2.73,16.39 1,12C2.73,7.61 7,4.5 12,4.5M3.18,12C4.83,15.36 8.24,17.5 12,17.5C15.76,17.5 19.17,15.36 20.82,12C19.17,8.64 15.76,6.5 12,6.5C8.24,6.5 4.83,8.64 3.18,12Z" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <div class="action">
                                                            <a href="?page=kecamatan&sub_page=kelurahan&action=ubah&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>&id_kartu_keluarga=<?= $row['id']; ?>" class="text-warning">
                                                                <i class="lni lni-pencil"></i>
                                                            </a>
                                                        </div>
                                                        <div class="action">
                                                            <a onclick="return confirm('Yakin?')" href="?page=kecamatan&sub_page=kelurahan&action=hapus&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>&id_kartu_keluarga=<?= $row['id']; ?>" class="text-danger">
                                                                <i class="lni lni-trash-can"></i>
                                                            </a>
                                                        </div>
                                                    </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once('layout/js.php'); ?>
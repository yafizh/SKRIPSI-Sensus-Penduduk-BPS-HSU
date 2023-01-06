<?php
$kecamatan = $koneksi->query("SELECT * FROM kecamatan WHERE id=" . $_GET['id_kecamatan'])->fetch_assoc();
$periode_sensus = $koneksi->query("SELECT * FROM periode_sensus WHERE id=" . $_GET['id_periode_sensus'])->fetch_assoc();
?>
<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3><a href="?page=petugas&sub_page=petugas_kecamatan&action=tampil" class="breadcrumb-item">Data Petugas Kecamatan</a> <span style="color: #5D657B;">/</span> Kecamatan <?= $kecamatan['nama']; ?> (Periode Sensus <?= $periode_sensus['tahun']; ?>)</h3>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="?page=petugas&sub_page=petugas_kecamatan&action=tambah&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_periode_sensus=<?= $_GET['id_periode_sensus']; ?>" class="btn btn-primary mb-30">Tambah</a>
                </div>
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
                                            <h6>NIP</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Nama</h6>
                                        </th>
                                        <th class="fit">
                                            <h6></h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                    SELECT 
                                        pk.*,
                                        pegawai.nip,
                                        pegawai.nama 
                                    FROM 
                                        petugas_kecamatan pk 
                                    INNER JOIN 
                                        petugas 
                                    ON 
                                        petugas.id=pk.id_petugas 
                                    INNER JOIN 
                                        pegawai 
                                    ON 
                                        pegawai.id=petugas.id_pegawai 
                                    WHERE 
                                        pk.id_kecamatan=" . $_GET['id_kecamatan'] . " 
                                    ORDER BY 
                                        pegawai.nama";
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
                                                    <p><?= $row['nip']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['nama']; ?></p>
                                                </td>
                                                <td class="fit">
                                                    <div class="d-flex gap-3">
                                                        <div class="action">
                                                            <a href="?page=petugas&sub_page=petugas_kecamatan&action=ubah&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_periode_sensus=<?= $_GET['id_periode_sensus']; ?>&id=<?= $row['id']; ?>" class="text-warning">
                                                                <i class="lni lni-pencil"></i>
                                                            </a>
                                                        </div>
                                                        <div class="action">
                                                            <a onclick="return confirm('Yakin?')" href="?page=petugas&sub_page=petugas_kecamatan&action=hapus&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_periode_sensus=<?= $_GET['id_periode_sensus']; ?>&id=<?= $row['id']; ?>" class="text-danger">
                                                                <i class="lni lni-trash-can"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td class="text-center" colspan="3">Data Kosong</td>
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
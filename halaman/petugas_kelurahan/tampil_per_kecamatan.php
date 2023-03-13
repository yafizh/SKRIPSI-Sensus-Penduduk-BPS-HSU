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
                        <h3><a href="?page=petugas&sub_page=petugas_kelurahan&action=tampil" class="breadcrumb-item">Data Petugas Kelurahan/Desa</a> <span style="color: #5D657B;">/</span> Kecamatan <?= $kecamatan['nama']; ?> (Periode Sensus <?= $periode_sensus['tahun']; ?>)</h3>
                    </div>
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
                                            <h6>Nama Kelurahan/Desa</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Jumlah Rumah Tangga</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Jumlah Petugas</h6>
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
                                        (
                                            SELECT 
                                                COUNT(*) 
                                            FROM 
                                                petugas p
                                            INNER JOIN 
                                                `petugas_kelurahan/desa` pkd 
                                            ON 
                                                pkd.id_petugas=p.id 
                                            WHERE 
                                                pkd.`id_kelurahan/desa`=k.id 
                                        ) jumlah
                                    FROM 
                                        `kelurahan/desa` k  
                                    WHERE 
                                        k.id_kecamatan=" . $kecamatan['id'] . " 
                                    ORDER BY 
                                        k.nama";
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
                                                    <p><?= $row['status']; ?> <?= $row['nama']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['jumlah_rumah_tangga']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['jumlah']; ?></p>
                                                </td>
                                                <td class="fit">
                                                    <div class="action">
                                                        <a href="?page=petugas&sub_page=petugas_kelurahan&action=detail_petugas&id_kecamatan=<?= $kecamatan['id']; ?>&id_kelurahan=<?= $row['id']; ?>&id_periode_sensus=<?= $periode_sensus['id']; ?>" class="text-secondary">
                                                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                                <path fill="currentColor" d="M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M12,4.5C17,4.5 21.27,7.61 23,12C21.27,16.39 17,19.5 12,19.5C7,19.5 2.73,16.39 1,12C2.73,7.61 7,4.5 12,4.5M3.18,12C4.83,15.36 8.24,17.5 12,17.5C15.76,17.5 19.17,15.36 20.82,12C19.17,8.64 15.76,6.5 12,6.5C8.24,6.5 4.83,8.64 3.18,12Z" />
                                                            </svg>
                                                        </a>
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
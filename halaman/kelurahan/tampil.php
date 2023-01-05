<?php
if (isset($_POST['id_periode_sensus']))
    $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus WHERE id=" . $_POST['id_periode_sensus'])->fetch_all(MYSQLI_ASSOC);
else
    $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus ORDER BY FIELD(`status`, 'Berjalan', 'Selesai', 'Menunggu')")->fetch_all(MYSQLI_ASSOC);
?>
<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <?php if (count($periode_sensus)) : ?>
                            <h3>Data Kelurahan/Desa (Periode Sensus <?= $periode_sensus[0]['tahun']; ?>)</h3>
                        <?php else : ?>
                            <h3>Data Kelurahan/Desa</h3>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-auto">
                    <button data-bs-toggle="modal" data-bs-target="#ModalOne" class="btn btn-info text-white mb-30">Pilih Periode Sensus</button>
                </div>
            </div>
        </div>
        <div class="follow-up-modal">
            <div class="modal fade" id="ModalOne" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content card-style text-center">
                        <div class="modal-body">
                            <div class="content mb-30">
                                <?php $data = $koneksi->query("SELECT * FROM periode_sensus ORDER BY tahun DESC"); ?>
                                <form action="" method="POST">
                                    <div class="select-style-1">
                                        <label class="text-start">Pilih Periode</label>
                                        <div class="select-position">
                                            <select name="id_periode_sensus" required>
                                                <option value="" selected disabled>Pilih Periode Sensus</option>
                                                <?php while ($row = $data->fetch_assoc()) : ?>
                                                    <?php if (($_POST['id_periode_sensus'] ?? '') == $row['id']) : ?>
                                                        <option selected value="<?= $row['id']; ?>"><?= $row['tahun']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $row['id']; ?>"><?= $row['tahun']; ?></option>
                                                    <?php endif; ?>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="action d-flex flex-wrap justify-content-center">
                                        <button name="submit" type="submit" class="main-btn primary-btn-outline square-btn btn-hover m-1">
                                            Pilih
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <?php if (count($periode_sensus)) : ?>
                            <div class="table-responsive">
                                <table id="table" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center fit">
                                                <h6>No</h6>
                                            </th>
                                            <th class="text-center">
                                                <h6>Nama Kecamatan</h6>
                                            </th>
                                            <th class="text-center">
                                                <h6>Jumlah Kelurahan/Desa</h6>
                                            </th>
                                            <th class="fit">
                                                <h6></h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $q = "
                                    SELECT 
                                        *,
                                        (SELECT COUNT(*) FROM `kelurahan/desa` WHERE id_kecamatan=kecamatan.id) AS jumlah 
                                    FROM 
                                        kecamatan 
                                    INNER JOIN 
                                        periode_sensus 
                                    ON 
                                        periode_sensus.id=kecamatan.id_periode_sensus 
                                    WHERE 
                                        periode_sensus.id=" . $periode_sensus[0]['id'] . " 
                                    ORDER BY 
                                        nama";
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
                                                        <p><?= $row['jumlah']; ?></p>
                                                    </td>
                                                    <td class="fit">
                                                        <div class="action">
                                                            <a onclick="return confirm('Yakin?')" href="?page=kecamatan&action=hapus&id=<?= $row['id']; ?>" class="text-danger">
                                                                <i class="lni lni-trash-can"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td class="text-center" colspan="4">Data Kosong</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else : ?>
                            <h4 class="text-center py-5">Periode Sensus Belum Ditambahkan</h4>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once('layout/js.php'); ?>
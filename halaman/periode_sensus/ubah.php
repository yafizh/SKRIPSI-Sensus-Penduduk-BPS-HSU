<?php
$data = $koneksi->query("SELECT * FROM periode_sensus WHERE id=" . $_GET['id'])->fetch_assoc();
if (isset($_POST['edit'])) {
    $tahun = $koneksi->real_escape_string($_POST['tahun']);
    $tanggal_mulai = $koneksi->real_escape_string($_POST['tanggal_mulai']);
    $tanggal_selesai = $koneksi->real_escape_string($_POST['tanggal_selesai']);
    $status = $koneksi->real_escape_string($_POST['status']);

    $q = "
        UPDATE periode_sensus SET
            `tahun`='$tahun',
            `tanggal_mulai`='$tanggal_mulai',
            `tanggal_selesai`='$tanggal_selesai',
            `status`='$status' 
        WHERE 
            id=" . $_GET['id'] . "
    ";
    if ($koneksi->query($q))
        echo "<script>location.href = '?page=periode_sensus&action=tampil';</script>";
    else die($koneksi->error);
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h2>Edit Periode Sensus</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-layout-wrapper">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="card-style mb-30">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Periode Sensus (Tahun)</label>
                                        <input type="text" name="tahun" required autocomplete="off" value="<?= $data['tahun']; ?>" class="bg-transparent" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" required value="<?= $data['tanggal_mulai']; ?>" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tanggal Selesai</label>
                                        <input type="date" name="tanggal_selesai" required value="<?= $data['tanggal_selesai']; ?>" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="select-style-1">
                                        <label>Status</label>
                                        <div class="select-position">
                                            <select name="status" required>
                                                <option value="" disabled>Pilih Status</option>
                                                <option value="Menunggu" <?= $data['status'] == 'Menunggu' ? 'selected' : ''; ?>>Menunggu</option>
                                                <option value="Berjalan" <?= $data['status'] == 'Berjalan' ? 'selected' : ''; ?>>Berjalan</option>
                                                <option value="Selesai" <?= $data['status'] == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?page=periode_sensus&action=tampil" class="main-btn btn-sm secondary-btn btn-hover">Kembali</a>
                                    <button name="edit" class="main-btn btn-sm primary-btn btn-hover">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
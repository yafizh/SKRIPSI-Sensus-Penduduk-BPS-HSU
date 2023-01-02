<?php
$data = $koneksi->query("SELECT * FROM jenis_pekerjaan WHERE id=" . $_GET['id'])->fetch_assoc();
if (isset($_POST['edit'])) {
    $nama = $koneksi->real_escape_string($_POST['nama']);

    if ($koneksi->query("UPDATE jenis_pekerjaan SET nama='$nama' WHERE id=" . $_GET['id']))
        echo "<script>location.href = '?page=master_data&sub_page=jenis_pekerjaan&action=tampil';</script>";
    else die($mysqli->error);
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h2>Edit Jenis Pekerjaan</h2>
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
                                        <label>Jenis Pekerjaan</label>
                                        <input type="text" class="bg-transparent" name="nama" autocomplete="off" value="<?= $data['nama']; ?>" required />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?page=master_data&sub_page=jenis_pekerjaan&action=tampil" class="main-btn btn-sm secondary-btn btn-hover">Kembali</a>
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
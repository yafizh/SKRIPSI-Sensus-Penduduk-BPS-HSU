<?php
$kecamatan = $koneksi->query("SELECT * FROM kecamatan WHERE id=" . $_GET['id_kecamatan'])->fetch_assoc();
$kelurahan = $koneksi->query("SELECT * FROM `kelurahan/desa` WHERE id=" . $_GET['id_kelurahan'])->fetch_assoc();
if (isset($_POST['tambah'])) {
    $nomor_kartu_keluarga = $koneksi->real_escape_string($_POST['nomor_kartu_keluarga']);
    $rt = $koneksi->real_escape_string($_POST['rt']);
    $rw = $koneksi->real_escape_string($_POST['rw']);
    $kode_pos = $koneksi->real_escape_string($_POST['kode_pos']);
    $alamat = $koneksi->real_escape_string($_POST['alamat']);

    $q = "
        INSERT INTO kartu_keluarga(
            `id_kelurahan/desa`,
            `id_periode_sensus`,
            nomor_kartu_keluarga,
            rt,
            rw,
            kode_pos,
            alamat 
        ) VALUES (
            " . $kelurahan['id'] . ",
            " . $kecamatan['id_periode_sensus'] . ",
            '$nomor_kartu_keluarga',
            '$rt',
            '$rw',
            '$kode_pos',
            '$alamat'
        )
    ";
    if ($koneksi->query($q))
        echo "<script>location.href = '?page=kecamatan&sub_page=kelurahan&action=tampil&id_kecamatan=" . $_GET['id_kecamatan'] . "&id_kelurahan=" . $_GET['id_kelurahan'] . "';</script>";
    else die($koneksi->error);
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h2>Tambah Rumah Tangga</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-layout-wrapper">
            <form action="" method="POST">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="card-style mb-30">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama Kecamatan</label>
                                        <input type="text" disabled value="<?= $kecamatan['nama']; ?>" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama Kelurahan</label>
                                        <input type="text" disabled value="<?= $kelurahan['nama']; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card-style mb-30">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nomor Kartu Keluarga</label>
                                        <input type="text" required autocomplete="off" autofocus class="bg-transparent" name="nomor_kartu_keluarga" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="input-style-1">
                                        <label>RT</label>
                                        <input type="text" required autocomplete="off" class="bg-transparent" name="rt" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="input-style-1">
                                        <label>RW</label>
                                        <input type="text" required autocomplete="off" class="bg-transparent" name="rw" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="input-style-1">
                                        <label>Kode Pos</label>
                                        <input type="text" required autocomplete="off" class="bg-transparent" name="kode_pos" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Alamat</label>
                                        <textarea name="alamat" required class="bg-transparent" autocomplete="off"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?page=kecamatan&sub_page=kelurahan&action=tampil&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>" class="main-btn btn-sm secondary-btn btn-hover">Kembali</a>
                                    <button name="tambah" class="main-btn btn-sm primary-btn btn-hover">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php include_once('layout/js.php'); ?>
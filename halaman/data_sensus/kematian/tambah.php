<?php
$kecamatan = $koneksi->query("SELECT * FROM kecamatan WHERE id=" . $_GET['id_kecamatan'])->fetch_assoc();
$kelurahan = $koneksi->query("SELECT * FROM `kelurahan/desa` WHERE id=" . $_GET['id_kelurahan'])->fetch_assoc();
$penduduk = $koneksi->query("SELECT p.*, a.nama agama FROM penduduk p INNER JOIN `agama/kepercayaan` a ON a.id=p.`id_agama/kepercayaan` WHERE `id_kelurahan/desa`=" . $kelurahan['id']);
if (isset($_POST['tambah'])) {
    $id_penduduk = $koneksi->real_escape_string($_POST['id_penduduk']);
    $nik = $koneksi->real_escape_string($_POST['nik']);
    $nama = $koneksi->real_escape_string($_POST['nama']);
    $jenis_kelamin = $koneksi->real_escape_string($_POST['jenis_kelamin']);
    $id_agama = $koneksi->real_escape_string($_POST['id_agama']);
    $id_penyebab_kematian = $koneksi->real_escape_string($_POST['id_penyebab_kematian']);
    $tanggal = $koneksi->real_escape_string($_POST['tanggal']);
    $waktu = $koneksi->real_escape_string($_POST['waktu']);

    $koneksi->query("DELETE FROM penduduk WHERE id=$id_penduduk");
    $q = "
        INSERT INTO kematian (
            `id_kelurahan/desa`,
            `id_periode_sensus`,
            `id_agama/kepercayaan`,
            `id_penyebab_kematian`,
            nik,
            nama,
            jenis_kelamin,
            tanggal_waktu
        ) VALUES (
            " . $kelurahan['id'] . ",
            " . $kecamatan['id_periode_sensus'] . ",
            '$id_agama',
            '$id_penyebab_kematian',
            '$nik',
            '$nama',
            '$jenis_kelamin',
            '" . $tanggal . " " . $waktu . "'
        )
    ";
    if ($koneksi->query($q))
        echo "<script>location.href = '?page=kecamatan&sub_page=kelurahan&action=detail_kematian&id_kecamatan=" . $_GET['id_kecamatan'] . "&id_kelurahan=" . $_GET['id_kelurahan'] . "';</script>";
    else die($koneksi->error);
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h2>Tambah Kematian</h2>
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
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Penduduk</label>
                                        <select class="form-control select" name="id_penduduk" id="exampleFormControlSelect1" required>
                                            <option value="" selected disabled>Pilih Penduduk</option>
                                            <?php while ($row = $penduduk->fetch_assoc()) : ?>
                                                <option data-nik="<?= $row['nik']; ?>" data-nama="<?= $row['nama']; ?>" data-jenis_kelamin="<?= $row['jenis_kelamin']; ?>" data-agama="<?= $row['agama']; ?>" data-id_agama="<?= $row['id_agama/kepercayaan']; ?>" value="<?= $row['id']; ?>"><?= $row['nik']; ?> | <?= $row['nama']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>NIK</label>
                                        <input type="text" required readonly autocomplete="off" name="nik" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama</label>
                                        <input type="text" required readonly autocomplete="off" name="nama" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Jenis Kelamin</label>
                                        <input type="text" required readonly autocomplete="off" name="jenis_kelamin" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Agama/Keyakinan</label>
                                        <input type="text" hidden name="id_agama" />
                                        <input type="text" required readonly autocomplete="off" name="agama" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php $penyebab_kematian = $koneksi->query("SELECT * FROM penyebab_kematian ORDER BY id"); ?>
                                    <div class="select-style-1">
                                        <label>Penyebab Kematian</label>
                                        <div class="select-position">
                                            <select name="id_penyebab_kematian">
                                                <option value="" selected disabled>Pilih Penyebab Kematian</option>
                                                <?php while ($row = $penyebab_kematian->fetch_assoc()) : ?>
                                                    <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="input-style-1">
                                        <label>Tanggal</label>
                                        <input type="date" required autocomplete="off" class="bg-transparent" name="tanggal" value="<?= Date("Y-m-d"); ?>" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="input-style-1">
                                        <label>Waktu</label>
                                        <input type="time" required autocomplete="off" class="bg-transparent" name="waktu" value="<?= Date("H:i"); ?>" />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?page=kecamatan&sub_page=kelurahan&action=detail_kematian&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>" class="main-btn btn-sm secondary-btn btn-hover">Kembali</a>
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
<script>
    const select = $(".select").select2();
    select.on('select2:select', function(element) {
        $("input[name=nik]").val(element.currentTarget[element.currentTarget.selectedIndex].getAttribute('data-nik'));
        $("input[name=nama]").val(element.currentTarget[element.currentTarget.selectedIndex].getAttribute('data-nama'));
        $("input[name=jenis_kelamin]").val(element.currentTarget[element.currentTarget.selectedIndex].getAttribute('data-jenis_kelamin'));
        $("input[name=agama]").val(element.currentTarget[element.currentTarget.selectedIndex].getAttribute('data-agama'));
        $("input[name=id_agama]").val(element.currentTarget[element.currentTarget.selectedIndex].getAttribute('data-id_agama'));
    });
</script>
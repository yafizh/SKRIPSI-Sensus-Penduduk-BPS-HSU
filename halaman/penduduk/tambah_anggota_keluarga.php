<?php
$kecamatan = $koneksi->query("SELECT * FROM kecamatan WHERE id=" . $_GET['id_kecamatan'])->fetch_assoc();
$kelurahan = $koneksi->query("SELECT * FROM `kelurahan/desa` WHERE id=" . $_GET['id_kelurahan'])->fetch_assoc();
$kartu_keluarga = $koneksi->query("SELECT * FROM kartu_keluarga WHERE id=" . $_GET['id_kartu_keluarga'])->fetch_assoc();
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
                        <h2>Tambah Anggota Keluarga</h2>
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
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nomor Kartu Keluarga</label>
                                        <input type="text" disabled value="<?= $kartu_keluarga['nomor_kartu_keluarga']; ?>" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="input-style-1">
                                        <label>RT</label>
                                        <input type="text" disabled value="<?= $kartu_keluarga['rt']; ?>" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="input-style-1">
                                        <label>RW</label>
                                        <input type="text" disabled value="<?= $kartu_keluarga['rw']; ?>" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="input-style-1">
                                        <label>Kode Pos</label>
                                        <input type="text" disabled value="<?= $kartu_keluarga['kode_pos']; ?>" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Alamat</label>
                                        <textarea name="alamat" required disabled autocomplete="off"><?= $kartu_keluarga['alamat']; ?></textarea>
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
                                        <label>NIK</label>
                                        <input type="text" required autocomplete="off" autofocus class="bg-transparent" name="nik" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama</label>
                                        <input type="text" required autocomplete="off" class="bg-transparent" name="nama" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tempat Lahir</label>
                                        <input type="text" required autocomplete="off" class="bg-transparent" name="tempat_lahir" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" required autocomplete="off" class="bg-transparent" name="tanggal_lahir" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="text-dark mb-1">Jenis Kelamin</label>
                                    <div class="form-check radio-style radio-primary mb-20">
                                        <input class="form-check-input" type="radio" value="Laki - Laki" name="jenis_kelamin" required id="male" />
                                        <label class="form-check-label" for="male">
                                            Laki - Laki</label>
                                    </div>
                                    <div class="form-check radio-style radio-primary mb-20">
                                        <input class="form-check-input" type="radio" value="Perempuan" name="jenis_kelamin" required id="female" />
                                        <label class="form-check-label" for="female">
                                            Perempuan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php $golongan_darah = $koneksi->query("SELECT * FROM golongan_darah ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Golongan Darah</label>
                                        <div class="select-position">
                                            <select name="id_golongan_darah" required>
                                                <option value="" selected disabled>Pilih Golongan Darah</option>
                                                <?php while ($row = $golongan_darah->fetch_assoc()) : ?>
                                                    <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php $pendidikan = $koneksi->query("SELECT * FROM pendidikan ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Pendidikan</label>
                                        <div class="select-position">
                                            <select name="id_pendidikan" required>
                                                <option value="" selected disabled>Pilih Pendidikan</option>
                                                <?php while ($row = $pendidikan->fetch_assoc()) : ?>
                                                    <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php $jenis_pekerjaan = $koneksi->query("SELECT * FROM jenis_pekerjaan ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Jenis Pekerjaan</label>
                                        <div class="select-position">
                                            <select name="id_jenis_pekerjaan" required>
                                                <option value="" selected disabled>Pilih Jenis Pekerjaan</option>
                                                <?php while ($row = $jenis_pekerjaan->fetch_assoc()) : ?>
                                                    <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php $status_perkawinan = $koneksi->query("SELECT * FROM status_perkawinan ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Status Perkawinan</label>
                                        <div class="select-position">
                                            <select name="id_status_perkawinan" required>
                                                <option value="" selected disabled>Pilih Status Perkawinan</option>
                                                <?php while ($row = $status_perkawinan->fetch_assoc()) : ?>
                                                    <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php $agama = $koneksi->query("SELECT * FROM `agama/kepercayaan` ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Agama/Kepercayaan</label>
                                        <div class="select-position">
                                            <select name="id_agama" required>
                                                <option value="" selected disabled>Pilih Agama/Kepercayaan</option>
                                                <?php while ($row = $agama->fetch_assoc()) : ?>
                                                    <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php
                                    $q = "
                                        SELECT 
                                            * 
                                        FROM 
                                            status_keluarga 
                                        WHERE 
                                            id NOT IN (SELECT id_status_keluarga FROM anggota_keluarga WHERE id_kartu_keluarga=" . $_GET['id_kartu_keluarga'] . ") 
                                            AND 
                                            tingkat = 1 
                                        ORDER BY 
                                            tingkat";
                                    $status_keluarga = $koneksi->query($q);
                                    ?>
                                    <div class="select-style-1">
                                        <label>Status Keluarga</label>
                                        <div class="select-position">
                                            <select name="id_pendidikan" required>
                                                <option value="" selected disabled>Pilih Status Keluarga</option>
                                                <?php while ($row = $status_keluarga->fetch_assoc()) : ?>
                                                    <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>NIK Ibu Kandung</label>
                                        <input type="text" required autocomplete="off" class="bg-transparent" name="nik_ibu_kandung" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama Ibu Kandung</label>
                                        <input type="text" required autocomplete="off" class="bg-transparent" name="nama_ibu_kandung" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>NIK Ayah Kandung</label>
                                        <input type="text" required autocomplete="off" class="bg-transparent" name="nik_ayah_kandung" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama Ayah Kandung</label>
                                        <input type="text" required autocomplete="off" class="bg-transparent" name="nama_ayah_kandung" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Alamat Sebelumnya</label>
                                        <textarea name="alamat_sebelumnya" required class="bg-transparent" autocomplete="off"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Alamat Sekarang</label>
                                        <textarea name="alamat_sekarang" required class="bg-transparent" autocomplete="off"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?page=kecamatan&sub_page=kelurahan&action=detail_per_anggota_keluarga&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>&id_kartu_keluarga=<?= $_GET['id_kartu_keluarga']; ?>" class="main-btn btn-sm secondary-btn btn-hover">Kembali</a>
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
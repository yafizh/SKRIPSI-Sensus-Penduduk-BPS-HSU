<?php
$q = "
    SELECT 
        p.*,
        ak.id_status_keluarga,
        (SELECT id FROM kelahiran WHERE id_penduduk=p.id) baru_lahir
    FROM 
        penduduk p 
    INNER JOIN 
        anggota_keluarga ak 
    ON 
        ak.id_penduduk=p.id 
    WHERE 
        p.id=" . $_GET['id_penduduk'] . "
";
$data = $koneksi->query($q)->fetch_assoc();
$kecamatan = $koneksi->query("SELECT * FROM kecamatan WHERE id=" . $_GET['id_kecamatan'])->fetch_assoc();
$kelurahan = $koneksi->query("SELECT * FROM `kelurahan/desa` WHERE id=" . $_GET['id_kelurahan'])->fetch_assoc();
$kartu_keluarga = $koneksi->query("SELECT * FROM kartu_keluarga WHERE id=" . $_GET['id_kartu_keluarga'])->fetch_assoc();
if (isset($_POST['edit'])) {
    $nik = $koneksi->real_escape_string($_POST['nik'] ?? '');
    $nama = $koneksi->real_escape_string($_POST['nama'] ?? '');
    $tempat_lahir = $koneksi->real_escape_string($_POST['tempat_lahir'] ?? '');
    $tanggal_lahir = $koneksi->real_escape_string($_POST['tanggal_lahir'] ?? '');
    $jenis_kelamin = $koneksi->real_escape_string($_POST['jenis_kelamin'] ?? '');
    $id_golongan_darah = $koneksi->real_escape_string($_POST['id_golongan_darah'] ?? '');
    $id_pendidikan = $koneksi->real_escape_string($_POST['id_pendidikan'] ?? '');
    $id_jenis_pekerjaan = $koneksi->real_escape_string($_POST['id_jenis_pekerjaan'] ?? '');
    $id_status_perkawinan = $koneksi->real_escape_string($_POST['id_status_perkawinan'] ?? '');
    $id_agama = $koneksi->real_escape_string($_POST['id_agama'] ?? '');
    $id_status_keluarga = $koneksi->real_escape_string($_POST['id_status_keluarga'] ?? '');
    $nik_ibu_kandung = $koneksi->real_escape_string($_POST['nik_ibu_kandung'] ?? '');
    $nama_ibu_kandung = $koneksi->real_escape_string($_POST['nama_ibu_kandung'] ?? '');
    $nik_ayah_kandung = $koneksi->real_escape_string($_POST['nik_ayah_kandung'] ?? '');
    $nama_ayah_kandung = $koneksi->real_escape_string($_POST['nama_ayah_kandung'] ?? '');
    $alamat_sebelumnya = $koneksi->real_escape_string($_POST['alamat_sebelumnya'] ?? '');
    $alamat_sekarang = $koneksi->real_escape_string($_POST['alamat_sekarang'] ?? '');


    try {
        $koneksi->begin_transaction();

        $q = "
            UPDATE penduduk SET
                `id_golongan_darah`=" . (empty($id_golongan_darah) ? 'NULL' : $id_golongan_darah) . ",
                `id_pendidikan`=" . (empty($id_pendidikan) ? 'NULL' : $id_pendidikan) . ",
                `id_jenis_pekerjaan`=" . (empty($id_jenis_pekerjaan) ? 'NULL' : $id_jenis_pekerjaan) . ",
                `id_status_perkawinan`=" . (empty($id_status_perkawinan) ? 'NULL' : $id_status_perkawinan) . ",
                `id_agama/kepercayaan`=" . (empty($id_agama) ? 'NULL' : $id_agama) . ",
                `nik`=" . (empty($nik) ? 'NULL' : "'$nik'") . ",
                `nama`=" . (empty($nama) ? 'NULL' : "'$nama'") . ",
                `tempat_lahir`=" . (empty($tempat_lahir) ? 'NULL' : "'$tempat_lahir'") . ",
                `tanggal_lahir`=" . (empty($tanggal_lahir) ? 'NULL' : "'$tanggal_lahir'") . ",
                `jenis_kelamin`=" . (empty($jenis_kelamin) ? 'NULL' : "'$jenis_kelamin'") . ",
                `nik_ibu_kandung`=" . (empty($nik_ibu_kandung) ? 'NULL' : "'$nik_ibu_kandung'") . ",
                `nama_ibu_kandung`=" . (empty($nama_ibu_kandung) ? 'NULL' : "'$nama_ibu_kandung'") . ",
                `nik_ayah_kandung`=" . (empty($nik_ayah_kandung) ? 'NULL' : "'$nik_ayah_kandung'") . ",
                `nama_ayah_kandung`=" . (empty($nama_ayah_kandung) ? 'NULL' : "'$nama_ayah_kandung'") . ",
                `alamat_sebelumnya`=" . (empty($alamat_sebelumnya) ? 'NULL' : "'$alamat_sebelumnya'") . ",
                `alamat_sekarang`=" . (empty($alamat_sekarang) ? 'NULL' : "'$alamat_sekarang'") . " 
            WHERE 
                id=" . $_GET['id_penduduk'] . "
        ";
        $koneksi->query($q);

        $q = "
        UPDATE `anggota_keluarga` SET 
            id_status_keluarga=" . (empty($id_status_keluarga) ? 'NULL' : $id_status_keluarga) . "
        WHERE 
            id=" . $kartu_keluarga['id'];
        $koneksi->query($q);

        if (($_POST['kelahiran'] ?? false) && !isset($_GET['kelahiran'])) {
            $q = "
                INSERT INTO kelahiran (
                    `id_penduduk`,
                    `id_kelurahan/desa`,
                    `id_periode_sensus`
                ) VALUES (
                    '" . $_GET['id_penduduk'] . "',
                    '" . $_GET['id_kelurahan'] . "',
                    '" . $kecamatan['id_periode_sensus'] . "'
                )
            ";
            $koneksi->query($q);
        }

        if (($_POST['kelahiran'] ?? false) === false)
            $koneksi->query("DELETE FROM kelahiran WHERE id_penduduk=" . $_GET['id_penduduk']);

        $koneksi->commit();
        if (isset($_GET['kelahiran']))
            echo "<script>location.href = '?page=kecamatan&sub_page=kelurahan&action=detail_kelahiran&id_kecamatan=" . $_GET['id_kecamatan'] . "&id_kelurahan=" . $_GET['id_kelurahan'] . "';</script>";
        else
            echo "<script>location.href = '?page=kecamatan&sub_page=kelurahan&action=detail_per_anggota_keluarga&id_kecamatan=" . $_GET['id_kecamatan'] . "&id_kelurahan=" . $_GET['id_kelurahan'] . "&id_kartu_keluarga=" . $_GET['id_kartu_keluarga'] . "';</script>";
    } catch (\Throwable $e) {
        $koneksi->rollback();
        throw $e;
    };
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h2>Edit Anggota Keluarga</h2>
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
                                        <textarea name="alamat" disabled autocomplete="off"><?= $kartu_keluarga['alamat']; ?></textarea>
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
                                        <input type="text" autocomplete="off" value="<?= $data['nik']; ?>" class="bg-transparent" name="nik" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama</label>
                                        <input type="text" autocomplete="off" class="bg-transparent" value="<?= $data['nama']; ?>" name="nama" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tempat Lahir</label>
                                        <input type="text" autocomplete="off" class="bg-transparent" value="<?= $data['tempat_lahir']; ?>" name="tempat_lahir" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" autocomplete="off" class="bg-transparent" value="<?= $data['tanggal_lahir']; ?>" name="tanggal_lahir" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="text-dark mb-1">Jenis Kelamin</label>
                                    <div class="form-check radio-style radio-primary mb-20">
                                        <input class="form-check-input" type="radio" value="Laki - Laki" <?= $data['jenis_kelamin'] == 'Laki - Laki' ? 'checked' : ''; ?> name="jenis_kelamin" id="male" />
                                        <label class="form-check-label" for="male">
                                            Laki - Laki</label>
                                    </div>
                                    <div class="form-check radio-style radio-primary mb-20">
                                        <input class="form-check-input" type="radio" value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'checked' : ''; ?> name="jenis_kelamin" id="female" />
                                        <label class="form-check-label" for="female">
                                            Perempuan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php $golongan_darah = $koneksi->query("SELECT * FROM golongan_darah ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Golongan Darah</label>
                                        <div class="select-position">
                                            <select name="id_golongan_darah">
                                                <option value="" selected disabled>Pilih Golongan Darah</option>
                                                <?php while ($row = $golongan_darah->fetch_assoc()) : ?>
                                                    <option <?= $row['id'] == $data['id_golongan_darah'] ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
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
                                            <select name="id_pendidikan">
                                                <option value="" selected disabled>Pilih Pendidikan</option>
                                                <?php while ($row = $pendidikan->fetch_assoc()) : ?>
                                                    <option <?= $row['id'] == $data['id_pendidikan'] ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
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
                                            <select name="id_jenis_pekerjaan">
                                                <option value="" selected disabled>Pilih Jenis Pekerjaan</option>
                                                <?php while ($row = $jenis_pekerjaan->fetch_assoc()) : ?>
                                                    <option <?= $row['id'] == $data['id_jenis_pekerjaan'] ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
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
                                            <select name="id_status_perkawinan">
                                                <option value="" selected disabled>Pilih Status Perkawinan</option>
                                                <?php while ($row = $status_perkawinan->fetch_assoc()) : ?>
                                                    <option <?= $row['id'] == $data['id_status_perkawinan'] ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
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
                                            <select name="id_agama">
                                                <option value="" selected disabled>Pilih Agama/Kepercayaan</option>
                                                <?php while ($row = $agama->fetch_assoc()) : ?>
                                                    <option <?= $row['id'] == $data['id_agama/kepercayaan'] ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
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
                                            id 
                                                NOT IN (
                                                    SELECT 
                                                        sk.id  
                                                    FROM 
                                                        anggota_keluarga ak
                                                    INNER JOIN 
                                                        status_keluarga sk
                                                    ON 
                                                        sk.id=ak.id_status_keluarga 
                                                    WHERE 
                                                        ak.id_kartu_keluarga=" . $_GET['id_kartu_keluarga'] . " 
                                                        AND 
                                                        sk.tingkat=1 
                                                        AND 
                                                        ak.id_penduduk!=" . $data['id'] . " 
                                                ) 
                                        ORDER BY 
                                            tingkat";
                                    $status_keluarga = $koneksi->query($q);
                                    ?>
                                    <div class="select-style-1">
                                        <label>Status Keluarga</label>
                                        <div class="select-position">
                                            <select name="id_status_keluarga">
                                                <option value="" selected disabled>Pilih Status Keluarga</option>
                                                <?php while ($row = $status_keluarga->fetch_assoc()) : ?>
                                                    <option <?= $row['id'] == $data['id_status_keluarga'] ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>NIK Ibu Kandung</label>
                                        <input type="text" autocomplete="off" class="bg-transparent" value="<?= $data['nik_ibu_kandung']; ?>" name="nik_ibu_kandung" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama Ibu Kandung</label>
                                        <input type="text" autocomplete="off" class="bg-transparent" value="<?= $data['nama_ibu_kandung']; ?>" name="nama_ibu_kandung" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>NIK Ayah Kandung</label>
                                        <input type="text" autocomplete="off" class="bg-transparent" value="<?= $data['nik_ayah_kandung']; ?>" name="nik_ayah_kandung" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama Ayah Kandung</label>
                                        <input type="text" autocomplete="off" class="bg-transparent" value="<?= $data['nama_ayah_kandung']; ?>" name="nama_ayah_kandung" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Alamat Sebelumnya</label>
                                        <textarea name="alamat_sebelumnya" class="bg-transparent" autocomplete="off"><?= $data['alamat_sebelumnya']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Alamat Sekarang</label>
                                        <textarea name="alamat_sekarang" class="bg-transparent" autocomplete="off"><?= $data['alamat_sekarang']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mb-5">
                                    <div class="form-check checkbox-style mb-20">
                                        <input class="form-check-input" type="checkbox" value="1" id="checkbox-1" <?= (isset($_GET['kelahiran']) || !is_null($data['baru_lahir'])) ? 'checked' : ''; ?> name="kelahiran">
                                        <label class="form-check-label" for="checkbox-1">Baru Lahir?</label>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?page=kecamatan&sub_page=kelurahan&action=detail_per_anggota_keluarga&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>&id_kartu_keluarga=<?= $_GET['id_kartu_keluarga']; ?>" class="main-btn btn-sm secondary-btn btn-hover">Kembali</a>
                                    <button name="edit" class="main-btn btn-sm primary-btn btn-hover">Simpan</button>
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
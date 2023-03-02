<?php
$kecamatan = $koneksi->query("SELECT * FROM kecamatan WHERE id=" . $_GET['id_kecamatan'])->fetch_assoc();
$kelurahan = $koneksi->query("SELECT * FROM `kelurahan/desa` WHERE id=" . $_GET['id_kelurahan'])->fetch_assoc();
$kartu_keluarga = $koneksi->query("SELECT * FROM kartu_keluarga WHERE id=" . $_GET['id_kartu_keluarga'])->fetch_assoc();
$ayah = $koneksi->query("SELECT p.* FROM anggota_keluarga ak INNER JOIN penduduk p ON p.id=ak.id_penduduk WHERE ak.id_kartu_keluarga=" . $_GET['id_kartu_keluarga'] . " AND (ak.id_status_keluarga=2 OR ak.id_status_keluarga=1)");
if ($ayah->num_rows) {
    $data = $ayah->fetch_assoc();
    $nik_ayah = $data['nik'];
    $nama_ayah = $data['nama'];
    $alamat_sekarang = $data['alamat_sekarang'];
    $alamat_sebelumnya = $data['alamat_sebelumnya'];
} else {
    $nik_ayah = '';
    $nama_ayah = '';
    $alamat_sekarang = '';
    $alamat_sebelumnya = '';
}

$ibu = $koneksi->query("SELECT p.* FROM anggota_keluarga ak INNER JOIN penduduk p ON p.id=ak.id_penduduk WHERE ak.id_kartu_keluarga=" . $_GET['id_kartu_keluarga'] . " AND ak.id_status_keluarga=3");
if ($ibu->num_rows) {
    $data = $ibu->fetch_assoc();
    $nik_ibu = $data['nik'];
    $nama_ibu = $data['nama'];
    $alamat_sekarang = $data['alamat_sekarang'];
    $alamat_sebelumnya = $data['alamat_sebelumnya'];
} else {
    $nik_ibu = '';
    $nama_ibu = '';

    if (empty($nik_ayah) && empty($nama_ayah)) {
        $alamat_sekarang = '';
        $alamat_sebelumnya = '';
    }
}

if (isset($_POST['tambah'])) {
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
            INSERT INTO penduduk (
                `id_kelurahan/desa`,
                `id_golongan_darah`,
                `id_pendidikan`,
                `id_jenis_pekerjaan`,
                `id_status_perkawinan`,
                `id_agama/kepercayaan`,
                `id_periode_sensus`,
                `nik`,
                `nama`,
                `tempat_lahir`,
                `tanggal_lahir`,
                `jenis_kelamin`,
                `nik_ibu_kandung`,
                `nama_ibu_kandung`,
                `nik_ayah_kandung`,
                `nama_ayah_kandung`,
                `alamat_sebelumnya`,
                `alamat_sekarang`
            ) VALUES (
                '" . $_GET['id_kelurahan'] . "',
                " . (empty($id_golongan_darah) ? 'NULL' : $id_golongan_darah) . ",
                " . (empty($id_pendidikan) ? 'NULL' : $id_pendidikan) . ",
                " . (empty($id_jenis_pekerjaan) ? 'NULL' : $id_jenis_pekerjaan) . ",
                " . (empty($id_status_perkawinan) ? 'NULL' : $id_status_perkawinan) . ",
                " . (empty($id_agama) ? 'NULL' : $id_agama) . ",
                '" . $kecamatan['id_periode_sensus'] . "',
                " . (empty($nik) ? 'NULL' : "'$nik'") . ",
                " . (empty($nama) ? 'NULL' : "'$nama'") . ",
                " . (empty($tempat_lahir) ? 'NULL' : "'$tempat_lahir'") . ",
                " . (empty($tanggal_lahir) ? 'NULL' : "'$tanggal_lahir'") . ",
                " . (empty($jenis_kelamin) ? 'NULL' : "'$jenis_kelamin'") . ",
                " . (empty($nik_ibu_kandung) ? 'NULL' : "'$nik_ibu_kandung'") . ",
                " . (empty($nama_ibu_kandung) ? 'NULL' : "'$nama_ibu_kandung'") . ",
                " . (empty($nik_ayah_kandung) ? 'NULL' : "'$nik_ayah_kandung'") . ",
                " . (empty($nama_ayah_kandung) ? 'NULL' : "'$nama_ayah_kandung'") . ",
                " . (empty($alamat_sebelumnya) ? 'NULL' : "'$alamat_sebelumnya'") . ",
                " . (empty($alamat_sekarang) ? 'NULL' : "'$alamat_sekarang'") . " 
            )
        ";
        $koneksi->query($q);

        $id_penduduk = $koneksi->insert_id;

        if ($_POST['kelahiran'] ?? false) {
            $q = "
                INSERT INTO kelahiran (
                    `id_penduduk`,
                    `id_kelurahan/desa`,
                    `id_periode_sensus`
                ) VALUES (
                    '" . $id_penduduk . "',
                    '" . $_GET['id_kelurahan'] . "',
                    '" . $kecamatan['id_periode_sensus'] . "'
                )
            ";
            $koneksi->query($q);
        }

        $q = "
        INSERT INTO `anggota_keluarga` (
            id_kartu_keluarga, 
            id_penduduk,
            id_status_keluarga  
        ) VALUES (
            " . $_GET['id_kartu_keluarga'] . ",
            " . $id_penduduk . ",
            " . (empty($id_status_keluarga) ? 'NULL' : $id_status_keluarga) . " 
        )";
        $koneksi->query($q);

        $koneksi->commit();
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
                                        <input type="text" autocomplete="off" autofocus class="bg-transparent" name="nik" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama</label>
                                        <input type="text" autocomplete="off" class="bg-transparent" name="nama" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tempat Lahir</label>
                                        <input type="text" autocomplete="off" class="bg-transparent" name="tempat_lahir" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" autocomplete="off" class="bg-transparent" name="tanggal_lahir" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="text-dark mb-1">Jenis Kelamin</label>
                                    <div class="form-check radio-style radio-primary mb-20">
                                        <input class="form-check-input" type="radio" value="Laki - Laki" name="jenis_kelamin" id="male" />
                                        <label class="form-check-label" for="male">
                                            Laki - Laki</label>
                                    </div>
                                    <div class="form-check radio-style radio-primary mb-20">
                                        <input class="form-check-input" type="radio" value="Perempuan" name="jenis_kelamin" id="female" />
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
                                            <select name="id_pendidikan">
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
                                            <select name="id_jenis_pekerjaan">
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
                                            <select name="id_status_perkawinan">
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
                                            <select name="id_agama">
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
                                                    <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>NIK Ibu Kandung</label>
                                        <input type="text" autocomplete="off" class="bg-transparent" name="nik_ibu_kandung" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama Ibu Kandung</label>
                                        <input type="text" autocomplete="off" class="bg-transparent" name="nama_ibu_kandung" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>NIK Ayah Kandung</label>
                                        <input type="text" autocomplete="off" class="bg-transparent" name="nik_ayah_kandung" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama Ayah Kandung</label>
                                        <input type="text" autocomplete="off" class="bg-transparent" name="nama_ayah_kandung" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Alamat Sebelumnya</label>
                                        <textarea name="alamat_sebelumnya" class="bg-transparent" autocomplete="off"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Alamat Sekarang</label>
                                        <textarea name="alamat_sekarang" class="bg-transparent" autocomplete="off"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mb-5">
                                    <div class="form-check checkbox-style mb-20">
                                        <input class="form-check-input" type="checkbox" value="1" id="checkbox-1" name="kelahiran">
                                        <label class="form-check-label" for="checkbox-1">Baru Lahir?</label>
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
<script>
    document.querySelector('select[name=id_status_keluarga]').addEventListener('change', function() {
        if (this.options[this.selectedIndex].value == 4) {
            document.querySelector('input[name=nama_ayah_kandung]').value = '<?= $nama_ayah; ?>';
            document.querySelector('input[name=nik_ayah_kandung]').value = '<?= $nik_ayah; ?>';
            document.querySelector('input[name=nama_ibu_kandung]').value = '<?= $nama_ibu; ?>';
            document.querySelector('input[name=nik_ibu_kandung]').value = '<?= $nik_ibu; ?>';
            document.querySelector('textarea[name=alamat_sekarang]').value = '<?= $alamat_sekarang; ?>';
            document.querySelector('textarea[name=alamat_sebelumnya]').value = '<?= $alamat_sebelumnya; ?>';
        } else {
            document.querySelector('input[name=nama_ayah_kandung]').value = '';
            document.querySelector('input[name=nik_ayah_kandung]').value = '';
            document.querySelector('input[name=nama_ibu_kandung]').value = '';
            document.querySelector('input[name=nik_ibu_kandung]').value = '';
            document.querySelector('textarea[name=alamat_sekarang]').value = '';
            document.querySelector('textarea[name=alamat_sebelumnya]').value = '';
        }
    });
</script>
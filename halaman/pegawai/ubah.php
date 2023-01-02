<?php
$data = $koneksi->query("SELECT * FROM pegawai WHERE id=" . $_GET['id'])->fetch_assoc();
if (isset($_POST['edit'])) {
    $id_pendidikan = $koneksi->real_escape_string($_POST['id_pendidikan']);
    $id_agama = $koneksi->real_escape_string($_POST['id_agama']);
    $nip = $koneksi->real_escape_string($_POST['nip']);
    $nama = $koneksi->real_escape_string($_POST['nama']);
    $tempat_lahir = $koneksi->real_escape_string($_POST['tempat_lahir']);
    $tanggal_lahir = $koneksi->real_escape_string($_POST['tanggal_lahir']);
    $jenis_kelamin = $koneksi->real_escape_string($_POST['jenis_kelamin']);

    if ($_FILES['foto']['error'] != 4) {
        $target_dir = "../uploads/";
        $foto = $target_dir . Date("YmdHis") . '.' . strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

        if (!is_dir($target_dir)) mkdir($target_dir, 0700, true);
        if (!move_uploaded_file($_FILES['foto']["tmp_name"], $foto))
            echo "<script>alert('Gagal meng-upload gambar!')</script>";
    } else
        $foto = $data['foto'];

    $q = "
    UPDATE pegawai SET 
        `id_pendidikan`='$id_pendidikan',
        `id_agama/kepercayaan`='$id_agama',
        `nip`='$nip',
        `nama`='$nama',
        `tempat_lahir`='$tempat_lahir',
        `tanggal_lahir`='$tanggal_lahir',
        `jenis_kelamin`='$jenis_kelamin',
        `foto`='$foto' 
    WHERE 
        id=" . $_GET['id'] . "
";
    if ($koneksi->query($q))
        echo "<script>location.href = '?page=pegawai&action=tampil';</script>";
    else die($koneksi->error);
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h2>Edit Pegawai</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-layout-wrapper">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="card-style mb-30">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>NIP</label>
                                        <input type="text" value="<?= $data['nip']; ?>" name="nip" required autocomplete="off" autofocus class="bg-transparent" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama</label>
                                        <input type="text" value="<?= $data['nama']; ?>" name="nama" required autocomplete="off" class="bg-transparent" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tempat Lahir</label>
                                        <input type="text" value="<?= $data['tempat_lahir']; ?>" name="tempat_lahir" required autocomplete="off" class="bg-transparent" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" value="<?= $data['tanggal_lahir']; ?>" name="tanggal_lahir" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="text-dark mb-1">Jenis Kelamin</label>
                                    <div class="form-check radio-style radio-primary mb-20">
                                        <input class="form-check-input" type="radio" value="Laki - Laki" name="jenis_kelamin" required <?= $data['jenis_kelamin'] == 'Laki - Laki' ? 'checked' : ''; ?> id="male" />
                                        <label class="form-check-label" for="male">
                                            Laki - Laki</label>
                                    </div>
                                    <div class="form-check radio-style radio-primary mb-20">
                                        <input class="form-check-input" type="radio" value="Perempuan" name="jenis_kelamin" required <?= $data['jenis_kelamin'] == 'Perempuan' ? 'checked' : ''; ?> id="female" />
                                        <label class="form-check-label" for="female">
                                            Perempuan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php $pendidikan = $koneksi->query("SELECT * FROM pendidikan ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Pendidikan</label>
                                        <div class="select-position">
                                            <select name="id_pendidikan" required>
                                                <option value="" disabled>Pilih Pendidikan</option>
                                                <?php while ($row = $pendidikan->fetch_assoc()) : ?>
                                                    <?php if ($data['id_pendidikan'] == $row['id']) : ?>
                                                        <option value="<?= $row['id']; ?>" selected><?= $row['nama']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                    <?php endif; ?>
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
                                                <option value="" disabled>Pilih Agama/Kepercayaan</option>
                                                <?php while ($row = $agama->fetch_assoc()) : ?>
                                                    <?php if ($data['id_agama/kepercayaan'] == $row['id']) : ?>
                                                        <option value="<?= $row['id']; ?>" selected><?= $row['nama']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                    <?php endif; ?>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Foto</label>
                                        <input type="file" name="foto" class="bg-transparent" />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?page=pegawai&action=tampil" class="main-btn btn-sm secondary-btn btn-hover">Kembali</a>
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
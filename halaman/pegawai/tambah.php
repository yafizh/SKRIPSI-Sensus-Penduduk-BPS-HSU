<?php
if (isset($_POST['tambah'])) {
    $id_pendidikan = $koneksi->real_escape_string($_POST['id_pendidikan']);
    $id_agama = $koneksi->real_escape_string($_POST['id_agama']);
    $nip = $koneksi->real_escape_string($_POST['nip']);
    $nama = $koneksi->real_escape_string($_POST['nama']);
    $tempat_lahir = $koneksi->real_escape_string($_POST['tempat_lahir']);
    $tanggal_lahir = $koneksi->real_escape_string($_POST['tanggal_lahir']);
    $jenis_kelamin = $koneksi->real_escape_string($_POST['jenis_kelamin']);

    $target_dir = "../uploads/";
    $foto = $target_dir . Date("YmdHis") . '.' . strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

    if (!is_dir($target_dir)) mkdir($target_dir, 0700, true);
    if (move_uploaded_file($_FILES['foto']["tmp_name"], $foto)) {
        $q = "
            INSERT INTO pegawai (
                `id_pendidikan`,
                `id_agama/kepercayaan`,
                `nip`,
                `nama`,
                `tempat_lahir`,
                `tanggal_lahir`,
                `jenis_kelamin`,
                `foto`
            ) VALUES (
                '$id_pendidikan',
                '$id_agama',
                '$nip',
                '$nama',
                '$tempat_lahir',
                '$tanggal_lahir',
                '$jenis_kelamin',
                '$foto' 
            )
        ";
        if ($koneksi->query($q))
            echo "<script>location.href = '?page=pegawai&action=tampil';</script>";
        else die($koneksi->error);
    } else
        echo "<script>alert('Gagal meng-upload gambar!')</script>";
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h2>Tambah Pegawai</h2>
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
                                        <input type="text" name="nip" required autocomplete="off" autofocus class="bg-transparent" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama</label>
                                        <input type="text" name="nama" required autocomplete="off" class="bg-transparent" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" required autocomplete="off" class="bg-transparent" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" required />
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
                                    <div class="input-style-1">
                                        <label>Foto</label>
                                        <input type="file" name="foto" required class="bg-transparent" />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?page=pegawai&action=tampil" class="main-btn btn-sm secondary-btn btn-hover">Kembali</a>
                                    <button name="tambah" class="main-btn btn-sm primary-btn btn-hover">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
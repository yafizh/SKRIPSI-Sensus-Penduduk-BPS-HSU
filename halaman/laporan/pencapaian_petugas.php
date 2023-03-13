<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Laporan Pencapaian Petugas</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="tables-wrapper">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card-style mb-30">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <?php $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus ORDER BY tahun DESC"); ?>
                                    <div class="select-style-1">
                                        <label>Dari Periode Sensus</label>
                                        <div class="select-position">
                                            <select name="id_periode_sensus" required>
                                                <option value="" selected disabled>Pilih Periode Sensus</option>
                                                <?php while ($row = $periode_sensus->fetch_assoc()) : ?>
                                                    <option <?= ($_POST['id_periode_sensus'] ?? '') == $row['id'] ? 'selected' : '' ?> value="<?= $row['id']; ?>"><?= $row['tahun']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <?php $kecamatan = $koneksi->query("SELECT DISTINCT UPPER(nama) nama FROM kecamatan ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Kecamatan</label>
                                        <div class="select-position">
                                            <select name="kecamatan" required>
                                                <option value="" selected disabled>Semua Kecamatan</option>
                                                <?php while ($row = $kecamatan->fetch_assoc()) : ?>
                                                    <option <?= ($_POST['kecamatan'] ?? '') == $row['nama'] ? 'selected' : '' ?> value="<?= $row['nama']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <?php $pegawai = $koneksi->query("SELECT * FROM pegawai ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Pegawai</label>
                                        <div class="select-position">
                                            <select required name="id_pegawai">
                                                <option value="" selected disabled>Pilih Pegawai</option>
                                                <?php while ($row = $pegawai->fetch_assoc()) : ?>
                                                    <option <?= ($_POST['id_pegawai'] ?? '') == $row['id'] ? 'selected' : '' ?> data-nip="<?= $row['nip']; ?>" value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="input-style-1">
                                        <label>NIP</label>
                                        <input type="text" name="nip" value="<?= $_POST['nip'] ?? ''; ?>" readonly />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Filter</button>
                                    <?php if (isset($_POST['id_periode_sensus'])) : ?>
                                        <?php
                                        $link = "halaman/laporan/cetak/pencapaian_petugas.php?id_periode_sensus=" . $_POST['id_periode_sensus'];
                                        $link .= "&kecamatan=" . $_POST['kecamatan'];
                                        $link .= "&id_pegawai=" . $_POST['id_pegawai'];
                                        ?>
                                        <a href="<?= $link; ?>" target="_blank" class="main-btn btn-sm success-btn btn-hover">Cetak</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php if (isset($_POST['id_periode_sensus'])) : ?>
                    <div class="col-12">
                        <div class="card-style mb-30">
                            <div class="table-responsive">
                                <table id="table" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center fit">
                                                <h6>No</h6>
                                            </th>
                                            <th class="text-center">
                                                <h6>Nama Kelurahan/Desa</h6>
                                            </th>
                                            <th class="text-center">
                                                <h6>Rumah Tangga</h6>
                                            </th>
                                            <th class="text-center">
                                                <h6>Penduduk</h6>
                                            </th>
                                            <th class="text-center">
                                                <h6>Kelahiran</h6>
                                            </th>
                                            <th class="text-center">
                                                <h6>Kematian</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $q = "
                                        SELECT 
                                            kd.nama,
                                            kd.status,
                                            (SELECT COUNT(id) FROM kartu_keluarga WHERE `id_kelurahan/desa`=kd.id) jumlah_rumah_tangga, 
                                            (SELECT COUNT(id) FROM penduduk WHERE `id_kelurahan/desa`=kd.id) jumlah_penduduk, 
                                            (SELECT COUNT(id) FROM kelahiran WHERE `id_kelurahan/desa`=kd.id) jumlah_kelahiran,
                                            (SELECT COUNT(id) FROM kematian WHERE `id_kelurahan/desa`=kd.id) jumlah_kematian
                                        FROM 
                                            `kelurahan/desa` kd 
                                        INNER JOIN 
                                            kecamatan k 
                                        ON 
                                            k.id=kd.id_kecamatan 
                                        INNER JOIN 
                                            periode_sensus ps
                                        ON 
                                            ps.id=k.id_periode_sensus 
                                        INNER JOIN 
                                            petugas p
                                        ON 
                                            p.id_periode_sensus=ps.id 
                                        WHERE 
                                            ps.id=" . $_POST['id_periode_sensus'] . " 
                                            AND 
                                            k.nama='" . $_POST['kecamatan'] . "' 
                                            AND 
                                            p.id_pegawai=" . $_POST['id_pegawai'] . "
                                        ";

                                    $q .= " ORDER BY kd.nama";

                                    $result = $koneksi->query($q);
                                    $no = 1;
                                    ?>
                                    <tbody>
                                        <?php if ($result->num_rows) : ?>
                                            <?php while ($row = $result->fetch_assoc()) : ?>
                                                <?php if (
                                                    $row['jumlah_rumah_tangga'] ||
                                                    $row['jumlah_penduduk'] ||
                                                    $row['jumlah_kelahiran'] ||
                                                    $row['jumlah_kematian']
                                                ) : ?>
                                                    <tr>
                                                        <td class="text-center fit">
                                                            <p><?= $no++; ?></p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p><?= $row['status']; ?> <?= $row['nama']; ?></p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p><?= $row['jumlah_rumah_tangga']; ?></p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p><?= $row['jumlah_penduduk']; ?></p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p><?= $row['jumlah_kelahiran']; ?></p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p><?= $row['jumlah_kematian']; ?></p>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td class="text-center" colspan="6">Data Kosong</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php require_once('layout/js.php'); ?>
<script>
    document.querySelector('select[name=id_pegawai]').addEventListener('change', function() {
        document.querySelector('input[name=nip]').value = this.options[this.selectedIndex].getAttribute('data-nip');
    });
</script>
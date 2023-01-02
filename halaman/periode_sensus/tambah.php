<?php
if (isset($_POST['tambah'])) {
    $tahun = $koneksi->real_escape_string($_POST['tahun']);
    $tanggal_mulai = $koneksi->real_escape_string($_POST['tanggal_mulai']);
    $tanggal_selesai = $koneksi->real_escape_string($_POST['tanggal_selesai']);
    $status = $koneksi->real_escape_string($_POST['status']);

    $q = "
        INSERT INTO periode_sensus (
            `tahun`,
            `tanggal_mulai`,
            `tanggal_selesai`,
            `status`
        ) VALUES (
            '$tahun',
            '$tanggal_mulai',
            '$tanggal_selesai',
            '$status'
        )
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
                        <h2>Tambah Periode Sensus</h2>
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
                                        <input type="text" name="tahun" required autocomplete="off" autofocus class="bg-transparent" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tanggal Selesai</label>
                                        <input type="date" name="tanggal_selesai" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="select-style-1">
                                        <label>Status</label>
                                        <div class="select-position">
                                            <select name="status" required>
                                                <option value="" selected disabled>Pilih Status</option>
                                                <option value="Menunggu">Menunggu</option>
                                                <option value="Berjalan">Berjalan</option>
                                                <option value="Selesai">Selesai</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?page=periode_sensus&action=tampil" class="main-btn btn-sm secondary-btn btn-hover">Kembali</a>
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
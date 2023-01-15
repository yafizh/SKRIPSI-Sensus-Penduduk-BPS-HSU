<?php
if (isset($_POST['id_periode_sensus']))
    $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus WHERE id=" . $_POST['id_periode_sensus'])->fetch_all(MYSQLI_ASSOC);
else
    $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus ORDER BY FIELD(`status`, 'Berjalan', 'Selesai', 'Menunggu')")->fetch_all(MYSQLI_ASSOC);
?>
<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Data Sensus</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <div class="table-responsive">
                            <table id="table" class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <h6></h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Jumlah</h6>
                                        </th>
                                        </th>
                                        <th class="fit">
                                            <h6></h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                (SELECT COUNT(*) FROM penduduk WHERE `id_kelurahan/desa`=".$_GET['id_kelurahan'].")
                                UNION ALL
                                (SELECT COUNT(*) FROM kelahiran INNER JOIN penduduk ON penduduk.id=kelahiran.id_penduduk WHERE penduduk.`id_kelurahan/desa`=".$_GET['id_kelurahan'].")
                                UNION ALL
                                (SELECT COUNT(*) FROM kematian WHERE `id_kelurahan/desa`=".$_GET['id_kelurahan'].")";

                                $result = $koneksi->query($q)->fetch_all(MYSQLI_NUM);
                                $no = 1;
                                ?>
                                <tbody>
                                    <tr>
                                        <td>Penduduk</td>
                                        <td class="text-center"><?= $result[0][0]; ?></td>
                                        <td>
                                            <div class="action">
                                                <a href="?page=kecamatan&sub_page=kelurahan&action=detail_penduduk&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>" class="text-secondary">
                                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M12,4.5C17,4.5 21.27,7.61 23,12C21.27,16.39 17,19.5 12,19.5C7,19.5 2.73,16.39 1,12C2.73,7.61 7,4.5 12,4.5M3.18,12C4.83,15.36 8.24,17.5 12,17.5C15.76,17.5 19.17,15.36 20.82,12C19.17,8.64 15.76,6.5 12,6.5C8.24,6.5 4.83,8.64 3.18,12Z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kelahiran</td>
                                        <td class="text-center"><?= $result[1][0]; ?></td>
                                        <td>
                                            <div class="action">
                                                <a href="?page=kecamatan&sub_page=kelurahan&action=detail_kelahiran&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>" class="text-secondary">
                                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M12,4.5C17,4.5 21.27,7.61 23,12C21.27,16.39 17,19.5 12,19.5C7,19.5 2.73,16.39 1,12C2.73,7.61 7,4.5 12,4.5M3.18,12C4.83,15.36 8.24,17.5 12,17.5C15.76,17.5 19.17,15.36 20.82,12C19.17,8.64 15.76,6.5 12,6.5C8.24,6.5 4.83,8.64 3.18,12Z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kematian</td>
                                        <td class="text-center"><?= $result[2][0]; ?></td>
                                        <td>
                                            <div class="action">
                                                <a href="?page=kecamatan&sub_page=kelurahan&action=detail_kematian&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>" class="text-secondary">
                                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M12,4.5C17,4.5 21.27,7.61 23,12C21.27,16.39 17,19.5 12,19.5C7,19.5 2.73,16.39 1,12C2.73,7.61 7,4.5 12,4.5M3.18,12C4.83,15.36 8.24,17.5 12,17.5C15.76,17.5 19.17,15.36 20.82,12C19.17,8.64 15.76,6.5 12,6.5C8.24,6.5 4.83,8.64 3.18,12Z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once('layout/js.php'); ?>
<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h2>Data Kecamatan</h2>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="?page=kecamatan&action=tambah" class="btn btn-primary mb-30">Tambah</a>
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
                                        <th class="text-center fit">
                                            <h6>No</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Nama Kecamatan</h6>
                                        </th>
                                        <th class="fit">
                                            <h6></h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $result = $koneksi->query("SELECT * FROM kecamatan ORDER BY nama");
                                $no = 1;
                                ?>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) : ?>
                                        <tr>
                                            <td class="text-center fit">
                                                <p><?= $no++; ?></p>
                                            </td>
                                            <td class="text-center">
                                                <p><?= $row['nama']; ?></p>
                                            </td>
                                            <td class="d-flex gap-2 fit">
                                                <div class="action">
                                                    <a href="?page=kecamatan&action=ubah&id=<?= $row['id']; ?>" class="text-warning">
                                                        <i class="lni lni-pencil"></i>
                                                    </a>
                                                </div>
                                                <div class="action">
                                                    <a onclick="return confirm('Yakin?')" href="?page=kecamatan&action=hapus&id=<?= $row['id']; ?>" class="text-danger">
                                                        <i class="lni lni-trash-can"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/Chart.min.js"></script>
<script src="assets/js/apexcharts.min.js"></script>
<script src="assets/js/dynamic-pie-chart.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/fullcalendar.js"></script>
<script src="assets/js/jvectormap.min.js"></script>
<script src="assets/js/world-merc.js"></script>
<script src="assets/js/polyfill.js"></script>
<script src="assets/js/quill.min.js"></script>
<script src="assets/js/datatable.js"></script>
<script src="assets/js/Sortable.min.js"></script>
<script src="assets/js/main.js"></script>
<script>
    const dataTable = new simpleDatatables.DataTable("#table", {
        searchable: true,
    });
</script>
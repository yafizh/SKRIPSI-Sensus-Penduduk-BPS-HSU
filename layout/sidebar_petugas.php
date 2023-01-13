<?php
$periode_sensus = $koneksi->query("SELECT * FROM periode_sensus WHERE status='Berjalan'");
if ($periode_sensus->num_rows) {
    $periode_sensus = $periode_sensus->fetch_assoc();
    $q = "
        SELECT 
            k.id id_kecamatan,
            k.nama 
        FROM 
            petugas_kecamatan pk 
        INNER JOIN 
            petugas p 
        ON 
            p.id=pk.id_petugas 
        INNER JOIN 
            kecamatan k  
        ON 
            k.id=pk.id_kecamatan 
        WHERE 
            p.id_periode_sensus=" . $periode_sensus['id'] . " 
            AND 
            p.id=" . $_SESSION['user']['id_petugas'] . "
    ";
    $kecamatan = $koneksi->query($q);

    $q = "
        SELECT 
            kd.id id_kelurahan,
            kd.nama 
        FROM 
            `petugas_kelurahan/desa` pkd 
        INNER JOIN 
            petugas p 
        ON 
            p.id=pkd.id_petugas 
        INNER JOIN 
            `kelurahan/desa` kd  
        ON 
            kd.id=pkd.`id_kelurahan/desa` 
        WHERE 
            p.id_periode_sensus=" . $periode_sensus['id'] . " 
            AND 
            p.id=" . $_SESSION['user']['id_petugas'] . "
    ";
    $kelurahan = $koneksi->query($q);
}
?>
<aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
        <img src="assets/images/logo/bps.png" width="50" class="mb-3" alt="logo" />
        <h6>APLIKASI SENSUS PENDUDUK BADAN PUSAT STATISTIK HULU SUNGAI UTARA</h6>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <?php if ($kecamatan->num_rows) : ?>
                <span class="divider">
                    <br>
                    <h6>Kecamatan</h6>
                </span>
                <?php while ($row = $kecamatan->fetch_assoc()) : ?>
                    <li class="nav-item nav-item-has-children <?= (($_GET['page'] ?? '') == 'kecamatan') && (($_GET['id_kecamatan'] ?? '') == $row['id_kecamatan']) ? 'active' : ''; ?>">
                        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#kecamatan-<?= $row['id_kecamatan']; ?>" aria-controls="kecamatan-<?= $row['id_kecamatan']; ?>" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="text"><?= $row['nama']; ?></span>
                        </a>
                        <?php $kelurahan_dalam_kecamatan = $koneksi->query("SELECT * FROM `kelurahan/desa` WHERE id_kecamatan=" . $row['id_kecamatan']); ?>
                        <ul id="kecamatan-<?= $row['id_kecamatan']; ?>" class="collapse dropdown-nav <?= (($_GET['page'] ?? '') == 'kecamatan') && (($_GET['id_kecamatan'] ?? '') == $row['id_kecamatan']) ? 'show' : ''; ?>">
                            <?php while ($row2 = $kelurahan_dalam_kecamatan->fetch_assoc()) : ?>
                                <li><a href="?page=kecamatan&sub_page=kelurahan&action=tampil&id_kecamatan=<?= $row['id_kecamatan']; ?>&id_kelurahan=<?= $row2['id']; ?>" class="<?= (($_GET['sub_page'] ?? '') == 'kelurahan') && (($_GET['id_kelurahan'] ?? '') == $row2['id']) ? 'active' : ''; ?>"><?= $row2['status']; ?> <?= $row2['nama']; ?></a></li>
                            <?php endwhile; ?>
                        </ul>
                    </li>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php if ($kelurahan->num_rows) : ?>
                <span class="divider">
                    <br>
                    <h6>Kelurahan/Desa</h6>
                </span>
                <?php while ($row = $kelurahan->fetch_assoc()) : ?>
                    <li class="nav-item"><a href="#"><span class="text"><?= $row['nama']; ?></span></a></li>
                <?php endwhile; ?>
            <?php endif; ?>
        </ul>
    </nav>
</aside>
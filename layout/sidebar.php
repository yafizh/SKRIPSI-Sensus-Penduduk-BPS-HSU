<aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
        <img src="assets/images/logo/bps.png" width="50" class="mb-3" alt="logo" />
        <h6>APLIKASI SENSUS PENDUDUK BADAN PUSAT STATISTIK HULU SUNGAI UTARA</h6>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li class="nav-item">
                <a href="?">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19,5V7H15V5H19M9,5V11H5V5H9M19,13V19H15V13H19M9,17V19H5V17H9M21,3H13V9H21V3M11,3H3V13H11V3M21,11H13V21H21V11M11,15H3V21H11V15Z" />
                        </svg>
                    </span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <span class="divider">
                <br>
                <h6>Menu Utama</h6>
            </span>
            <li class="nav-item <?= ($_GET['page'] ?? '') == 'admin' ? 'active' : ''; ?>">
                <a href="?page=admin&action=tampil">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M17 17V21H19V17H21L18 14L15 17H17M11 4C8.8 4 7 5.8 7 8S8.8 12 11 12 15 10.2 15 8 13.2 4 11 4M11 6C12.1 6 13 6.9 13 8S12.1 10 11 10 9 9.1 9 8 9.9 6 11 6M11 13C8.3 13 3 14.3 3 17V20H12.5C12.2 19.4 12.1 18.8 12 18.1H4.9V17C4.9 16.4 8 14.9 11 14.9C11.5 14.9 12 15 12.5 15C12.8 14.4 13.1 13.8 13.6 13.3C12.6 13.1 11.7 13 11 13" />
                        </svg>
                    </span>
                    <span class="text">Admin</span>
                </a>
            </li>
            <li class="nav-item nav-item-has-children <?= ($_GET['page'] ?? '') == 'master_data' ? 'active' : ''; ?>">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_2" aria-controls="ddmenu_2" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 3C7.58 3 4 4.79 4 7V17C4 19.21 7.59 21 12 21S20 19.21 20 17V7C20 4.79 16.42 3 12 3M18 17C18 17.5 15.87 19 12 19S6 17.5 6 17V14.77C7.61 15.55 9.72 16 12 16S16.39 15.55 18 14.77V17M18 12.45C16.7 13.4 14.42 14 12 14C9.58 14 7.3 13.4 6 12.45V9.64C7.47 10.47 9.61 11 12 11C14.39 11 16.53 10.47 18 9.64V12.45M12 9C8.13 9 6 7.5 6 7S8.13 5 12 5C15.87 5 18 6.5 18 7S15.87 9 12 9Z" />
                        </svg>
                    </span>
                    <span class="text">Master Data</span>
                </a>
                <ul id="ddmenu_2" class="collapse dropdown-nav <?= ($_GET['page'] ?? '') == 'master_data' ? 'show' : ''; ?>">
                    <li><a href="?page=master_data&sub_page=golongan_darah&action=tampil" class="<?= ($_GET['sub_page'] ?? '') == 'golongan_darah' ? 'active' : ''; ?>">Golongan Darah</a></li>
                    <li><a href="?page=master_data&sub_page=status_keluarga&action=tampil" class="<?= ($_GET['sub_page'] ?? '') == 'status_keluarga' ? 'active' : ''; ?>">Status Keluarga</a></li>
                    <li><a href="?page=master_data&sub_page=pendidikan&action=tampil" class="<?= ($_GET['sub_page'] ?? '') == 'pendidikan' ? 'active' : ''; ?>">Pendidikan</a></li>
                    <li><a href="?page=master_data&sub_page=agama&action=tampil" class="<?= ($_GET['sub_page'] ?? '') == 'agama' ? 'active' : ''; ?>">Agama/Kepercayaan</a></li>
                    <li><a href="?page=master_data&sub_page=penyebab_kematian&action=tampil" class="<?= ($_GET['sub_page'] ?? '') == 'penyebab_kematian' ? 'active' : ''; ?>">Penyebab Kematian</a></li>
                    <li><a href="?page=master_data&sub_page=jenis_pekerjaan&action=tampil" class="<?= ($_GET['sub_page'] ?? '') == 'jenis_pekerjaan' ? 'active' : ''; ?>">Jenis Pekerjaan</a></li>
                    <li><a href="?page=master_data&sub_page=status_perkawinan&action=tampil" class="<?= ($_GET['sub_page'] ?? '') == 'status_perkawinan' ? 'active' : ''; ?>">Status Perkawinan</a></li>
                </ul>
            </li>
            <li class="nav-item <?= ($_GET['page'] ?? '') == 'pegawai' ? 'active' : ''; ?>">
                <a href="?page=pegawai&action=tampil">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M16.36 12.76C18.31 13.42 20 14.5 20 16V21H4V16C4 14.5 5.69 13.42 7.65 12.76L8.27 14L8.5 14.5C7 14.96 5.9 15.62 5.9 16V19.1H10.12L11 14.03L10.06 12.15C10.68 12.08 11.33 12.03 12 12.03C12.67 12.03 13.32 12.08 13.94 12.15L13 14.03L13.88 19.1H18.1V16C18.1 15.62 17 14.96 15.5 14.5L15.73 14L16.36 12.76M12 5C10.9 5 10 5.9 10 7C10 8.1 10.9 9 12 9C13.1 9 14 8.1 14 7C14 5.9 13.1 5 12 5M12 11C9.79 11 8 9.21 8 7C8 4.79 9.79 3 12 3C14.21 3 16 4.79 16 7C16 9.21 14.21 11 12 11Z" />
                        </svg>
                    </span>
                    <span class="text">Data Pegawai</span>
                </a>
            </li>
            <li class="nav-item <?= ($_GET['page'] ?? '') == 'periode_sensus' ? 'active' : ''; ?>">
                <a href="?page=periode_sensus&action=tampil">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19 19H5V8H19M16 1V3H8V1H6V3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3H18V1M18 14L15 11V13H9V11L6 14L9 17V15H15V17L18 14Z" />
                        </svg>
                    </span>
                    <span class="text">Periode Sensus</span>
                </a>
            </li>
            <span class="divider">
                <br>
                <h6>Data Sensus</h6>
            </span>
            <li class="nav-item <?= ($_GET['page'] ?? '') == 'kecamatan' ? 'active' : ''; ?>">
                <a href="?page=kecamatan&action=tampil">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M11.5,1L2,6V8H21V6M16,10V17H19V10M2,22H21V19H2M10,10V17H13V10M4,10V17H7V10H4Z" />
                        </svg>
                    </span>
                    <span class="text">Data Kecamatan</span>
                </a>
            </li>
            <li class="nav-item <?= ($_GET['page'] ?? '') == 'kelurahan' ? 'active' : ''; ?>">
                <a href="?page=kelurahan&action=tampil">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M6.5,10H4.5V17H6.5V10M12.5,10H10.5V17H12.5V10M21,19H2V21H21V19M18.5,10H16.5V17H18.5V10M11.5,3.26L16.71,6H6.29L11.5,3.26M11.5,1L2,6V8H21V6L11.5,1Z" />
                        </svg>
                    </span>
                    <span class="text">Data Kelurahan/Desa</span>
                </a>
            </li>
            <li class="nav-item nav-item-has-children <?= ($_GET['page'] ?? '') == 'petugas' ? 'active' : ''; ?>">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#petugas" aria-controls="petugas" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M16 9C16 14.33 8 14.33 8 9H10C10 11.67 14 11.67 14 9M20 18V21H4V18C4 15.33 9.33 14 12 14C14.67 14 20 15.33 20 18M18.1 18C18.1 17.36 14.97 15.9 12 15.9C9.03 15.9 5.9 17.36 5.9 18V19.1H18.1M12.5 2C12.78 2 13 2.22 13 2.5V5.5H14V3C15.45 3.67 16.34 5.16 16.25 6.75C16.25 6.75 16.95 6.89 17 8H7C7 6.89 7.75 6.75 7.75 6.75C7.66 5.16 8.55 3.67 10 3V5.5H11V2.5C11 2.22 11.22 2 11.5 2" />
                        </svg>
                    </span>
                    <span class="text">Petugas</span>
                </a>
                <ul id="petugas" class="collapse dropdown-nav <?= ($_GET['page'] ?? '') == 'petugas' ? 'show' : ''; ?>">
                    <li><a href="?page=petugas&sub_page=petugas_kecamatan&action=tampil" class="<?= ($_GET['sub_page'] ?? '') == 'petugas_kecamatan' ? 'active' : ''; ?>">Petugas Kecamatan</a></li>
                    <li><a href="?page=petugas&sub_page=petugas_kelurahan&action=tampil" class="<?= ($_GET['sub_page'] ?? '') == 'petugas_kelurahan' ? 'active' : ''; ?>">Petugas Kelurahan/Desa</a></li>
                </ul>
            </li>
            <!-- <li class="nav-item nav-item-has-children <?= ($_GET['page'] ?? '') == 'data_sensus' ? 'active' : ''; ?>">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#data-sensus" aria-controls="data-sensus" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M18 2A2 2 0 0 1 20 4V20A2 2 0 0 1 18 22H6A2 2 0 0 1 4 20V4A2 2 0 0 1 6 2H18M18 4H13V9L10.5 6.7L8 9V4H6V20H18M13 11A2 2 0 1 1 11 13A2 2 0 0 1 13 11M17 19H9V18C9 16.67 11.67 16 13 16S17 16.67 17 18V19" />
                        </svg>
                    </span>
                    <span class="text">Data Sensus</span>
                </a>
                <ul id="data-sensus" class="collapse dropdown-nav <?= ($_GET['page'] ?? '') == 'data_sensus' ? 'show' : ''; ?>">
                    <li><a href="?page=data_sensus&sub_page=penduduk&action=tampil" class="<?= ($_GET['sub_page'] ?? '') == 'penduduk' ? 'active' : ''; ?>">Penduduk</a></li>
                    <li><a href="#">Kelahiran</a></li>
                    <li><a href="#">Kematian</a></li>
                    <li><a href="#">Pendidikan</a></li>
                    <li><a href="#">Tenaga Kerja</a></li>
                </ul>
            </li> -->
            <span class="divider">
                <br>
                <h6>Laporan</h6>
            </span>
            <li class="nav-item nav-item-has-children <?= ($_GET['page'] ?? '') == 'laporan' ? 'active' : ''; ?>">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#laporan" aria-controls="laporan" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M16 0H8C6.9 0 6 .9 6 2V18C6 19.1 6.9 20 8 20H20C21.1 20 22 19.1 22 18V6L16 0M20 18H8V2H15V7H20V18M4 4V22H20V24H4C2.9 24 2 23.1 2 22V4H4M10 10V12H18V10H10M10 14V16H15V14H10Z" />
                        </svg>
                    </span>
                    <span class="text">Laporan</span>
                </a>
                <ul id="laporan" class="collapse dropdown-nav <?= ($_GET['page'] ?? '') == 'laporan' ? 'show' : ''; ?>">
                    <li><a href="?page=laporan&sub_page=kecamatan&action=tampil" class="<?= ($_GET['sub_page'] ?? '') == 'kecamatan' ? 'active' : ''; ?>">Kecamatan</a></li>
                    <li><a href="#">Kelurahan/Desa</a></li>
                    <li><a href="#">Petugas Kecamatan</a></li>
                    <li><a href="#">Petugas Kelurahan/Desa</a></li>
                    <li><a href="#">Grafik Penduduk</a></li>
                    <li><a href="#">Grafik Kematian</a></li>
                    <li><a href="#">Grafik Pendidikan</a></li>
                    <li><a href="#">Grafik Kelahiran</a></li>
                    <li><a href="#">Grafik Tenaga Kerja</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>
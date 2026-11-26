<?php
include 'config.php';

$menu = $_GET['menu'] ?? 'dashboard';
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIM Sarpras Madrasah</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="assets/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f4f9f4;
            overflow-x: hidden;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #198754, #146c43);
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
        }

        .sidebar .logo {
            font-size: 20px;
            font-weight: bold;
            color: white;
            padding: 1px;
          
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar .nav-link {
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            margin: 4px 10px;
            transition: 0.3s;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            padding-left: 25px;
        }

        .sidebar .nav-link.active {
            background: white;
            color: #198754 !important;
            font-weight: bold;
        }

        .sidebar .submenu .nav-link {
            font-size: 14px;
            padding-left: 35px;
        }

        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }

        .topbar {
            background: white;
            padding: 15px 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .card-dashboard {
            border: none;
            border-radius: 15px;
            color: white;
            overflow: hidden;
            transition: 0.3s;
        }

        .card-dashboard:hover {
            transform: translateY(-5px);
        }

        .card-dashboard i {
            font-size: 40px;
            opacity: 0.3;
        }

        .bg-sarana {
            background: linear-gradient(45deg, #11998e, #38ef7d);
        }

        .bg-ruangan {
            background: linear-gradient(45deg, #0d6efd, #5b86e5);
        }

        .bg-pinjam {
            background: linear-gradient(45deg, #f7971e, #ffd200);
        }

        .bg-rusak {
            background: linear-gradient(45deg, #eb3349, #f45c43);
        }

        .content-area {
            padding: 25px;
        }

        .menu-title {
            font-size: 12px;
            text-transform: uppercase;
            padding: 15px 20px 5px;
            color: rgba(255, 255, 255, 0.7);
        }
    </style>

</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">

                      <div class="logo d-flex align-items-center justify-content-center">
            <img src="assets/logokemenagnew.png" alt="Logo Kemenag" style="height: 120px; width: auto; margin: -15px 0;">
        </div>

        <div class="mt-2">

            <!-- DASHBOARD -->
            <a href="halaman.php"
                class="nav-link <?= ($menu == 'dashboard') ? 'active' : ''; ?>">

                <i class="bi bi-speedometer2"></i>
                Dashboard

            </a>

            <!-- MASTER DATA -->
            <div class="menu-title">
                Master Data
            </div>

            <a class="nav-link"
                data-bs-toggle="collapse"
                href="#masterMenu">

                <i class="bi bi-database"></i>
                Master Data

            </a>

            <div class="collapse submenu
        <?= in_array($menu, ['user', 'kategori', 'ruangan', 'sumber_dana', 'satuan']) ? 'show' : ''; ?>"
                id="masterMenu">

                <a href="halaman.php?menu=user"
                    class="nav-link <?= ($menu == 'user') ? 'active' : ''; ?>">

                    <i class="bi bi-person"></i>
                    Data Pengguna

                </a>

                <a href="halaman.php?menu=kategori"
                    class="nav-link <?= ($menu == 'kategori') ? 'active' : ''; ?>">

                    <i class="bi bi-tags"></i>
                    Kategori Barang

                </a>

                <a href="halaman.php?menu=ruangan"
                    class="nav-link <?= ($menu == 'ruangan') ? 'active' : ''; ?>">

                    <i class="bi bi-door-open"></i>
                    Ruangan

                </a>

                <a href="halaman.php?menu=sumber_dana"
                    class="nav-link <?= ($menu == 'sumber_dana') ? 'active' : ''; ?>">

                    <i class="bi bi-cash"></i>
                    Sumber Dana

                </a>

            

            </div>

            <!-- DATA ASET -->
            <div class="menu-title">
                Data Aset
            </div>

            <a class="nav-link"
                data-bs-toggle="collapse"
                href="#asetMenu">

                <i class="bi bi-box-seam"></i>
                Data Aset

            </a>

            <div class="collapse submenu
        <?= in_array($menu, ['sarana', 'prasarana_tanah', 'prasarana_gedung']) ? 'show' : ''; ?>"
                id="asetMenu">

                <a href="halaman.php?menu=sarana"
                    class="nav-link <?= ($menu == 'sarana') ? 'active' : ''; ?>">

                    <i class="bi bi-box"></i>
                    Sarana (Barang)

                </a>

                <a href="halaman.php?menu=prasarana_tanah"
                    class="nav-link <?= ($menu == 'prasarana_tanah') ? 'active' : ''; ?>">

                    <i class="bi bi-geo-alt"></i>
                    Tanah

                </a>

                <a href="halaman.php?menu=prasarana_gedung"
                    class="nav-link <?= ($menu == 'prasarana_gedung') ? 'active' : ''; ?>">

                    <i class="bi bi-building"></i>
                    Gedung

                </a>

            </div>

            <!-- TRANSAKSI -->
            <div class="menu-title">
                Transaksi
            </div>

            <a class="nav-link"
                data-bs-toggle="collapse"
                href="#transaksiMenu">

                <i class="bi bi-arrow-left-right"></i>
                Transaksi

            </a>

            <div class="collapse submenu
        <?= in_array($menu, ['barang_masuk', 'mutasi', 'peminjaman', 'pemeliharaan', 'penghapusan']) ? 'show' : ''; ?>"
                id="transaksiMenu">

                <a href="halaman.php?menu=barang_masuk"
                    class="nav-link <?= ($menu == 'barang_masuk') ? 'active' : ''; ?>">

                    <i class="bi bi-box-arrow-in-down"></i>
                    Barang Masuk

                </a>

                <a href="halaman.php?menu=mutasi"
                    class="nav-link <?= ($menu == 'mutasi') ? 'active' : ''; ?>">

                    <i class="bi bi-arrow-left-right"></i>
                    Mutasi Barang

                </a>

                <a href="halaman.php?menu=peminjaman"
                    class="nav-link <?= ($menu == 'peminjaman') ? 'active' : ''; ?>">

                    <i class="bi bi-journal-arrow-up"></i>
                    Peminjaman

                </a>

                <a href="halaman.php?menu=pemeliharaan"
                    class="nav-link <?= ($menu == 'pemeliharaan') ? 'active' : ''; ?>">

                    <i class="bi bi-tools"></i>
                    Pemeliharaan

                </a>

                <a href="halaman.php?menu=penghapusan"
                    class="nav-link <?= ($menu == 'penghapusan') ? 'active' : ''; ?>">

                    <i class="bi bi-trash"></i>
                    Penghapusan

                </a>

            </div>

            <!-- LAPORAN -->
            <div class="menu-title">
                Laporan
            </div>

            <a class="nav-link"
                data-bs-toggle="collapse"
                href="#laporanMenu">

                <i class="bi bi-file-earmark-text"></i>
                Laporan

            </a>

            <div class="collapse submenu
        <?= in_array($menu, [
            'lap_sarana',
            'lap_prasarana',
            'lap_peminjaman',
            'lap_mutasi',
            'lap_pemeliharaan',
            'lap_penghapusan'
        ]) ? 'show' : ''; ?>"
                id="laporanMenu">

                <a href="halaman.php?menu=lap_sarana"
                    class="nav-link <?= ($menu == 'lap_sarana') ? 'active' : ''; ?>">

                    Rekap Sarana

                </a>

                <a href="halaman.php?menu=lap_prasarana"
                    class="nav-link <?= ($menu == 'lap_prasarana') ? 'active' : ''; ?>">

                    Rekap Prasarana

                </a>

                <a href="halaman.php?menu=lap_peminjaman"
                    class="nav-link <?= ($menu == 'lap_peminjaman') ? 'active' : ''; ?>">

                    Rekap Peminjaman

                </a>

                <a href="halaman.php?menu=lap_mutasi"
                    class="nav-link <?= ($menu == 'lap_mutasi') ? 'active' : ''; ?>">

                    Rekap Mutasi

                </a>

                <a href="halaman.php?menu=lap_pemeliharaan"
                    class="nav-link <?= ($menu == 'lap_pemeliharaan') ? 'active' : ''; ?>">

                    Rekap Pemeliharaan

                </a>

                <a href="halaman.php?menu=lap_penghapusan"
                    class="nav-link <?= ($menu == 'lap_penghapusan') ? 'active' : ''; ?>">

                    Rekap Penghapusan

                </a>

            </div>

            <!-- LOGOUT -->
            <div class="menu-title">
                Account
            </div>

            <a href="logout.php"
                class="nav-link">

                <i class="bi bi-box-arrow-right"></i>
                Logout

            </a>

        </div>

    </div>

    <!-- MAIN -->
    <div class="main-content">

        <!-- TOPBAR -->
        <div class="topbar d-flex justify-content-between align-items-center">

            <div>

                <h4 class="mb-0 fw-bold">
                    Inventaris Sarana & Prasarana MTsn 3 Kota Banjarmasin
                </h4>

                <small class="text-muted">
                    Madrasah - Sarana & Prasarana
                </small>

            </div>

            <div>

                <span class="badge bg-success p-2">

                    <i class="bi bi-person-circle"></i>
                    Administrator

                </span>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="content-area">

            <?php
            if ($menu == 'dashboard') {
            ?>

                <div class="row g-4">

                    <div class="col-md-3">

                        <div class="card card-dashboard bg-sarana">

                            <div class="card-body">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <h3>
                                            <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tabel_sarana")); ?>
                                        </h3>

                                        <p class="mb-0">
                                            Total Sarana
                                        </p>

                                    </div>

                                    <i class="bi bi-box-seam"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="card card-dashboard bg-ruangan">

                            <div class="card-body">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <h3>
                                            <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tabel_ruangan")); ?>
                                        </h3>

                                        <p class="mb-0">
                                            Total Ruangan
                                        </p>

                                    </div>

                                    <i class="bi bi-door-open"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="card card-dashboard bg-pinjam">

                            <div class="card-body">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <h3>
                                            <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tabel_peminjaman WHERE status='Dipinjam'")); ?>
                                        </h3>

                                        <p class="mb-0">
                                            Peminjaman Aktif
                                        </p>

                                    </div>

                                    <i class="bi bi-journal-arrow-up"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="card card-dashboard bg-rusak">

                            <div class="card-body">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <h3>
                                            <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tabel_sarana WHERE kondisi != 'Baik'")); ?>
                                        </h3>

                                        <p class="mb-0">
                                            Barang Rusak
                                        </p>

                                    </div>

                                    <i class="bi bi-tools"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card mt-4 shadow-sm border-0">

                    <div class="card-header bg-white">

                        <h5 class="mb-0">
                            Selamat Datang
                        </h5>

                    </div>

                    <div class="card-body">

                        <p class="mb-0">

                            Sistem Informasi Sarana & Prasarana Madrasah
                            digunakan untuk mengelola data sarana, prasarana,
                            transaksi peminjaman, mutasi, pemeliharaan,
                            hingga laporan inventaris.

                        </p>

                    </div>

                </div>

            <?php
            } else {

                include 'konten.php';
            }
            ?>

        </div>

    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
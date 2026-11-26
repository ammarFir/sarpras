<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
    SELECT
        bm.*,
        s.nama_barang,
        s.kode_barang,
        d.keterangan AS sumber_dana
    FROM tabel_barang_masuk bm
    LEFT JOIN tabel_sarana s ON bm.id_sarana = s.id_sarana
    LEFT JOIN tabel_sumber_dana d ON bm.id_sumber_dana = d.id_sumber_dana
    WHERE bm.id_barang_masuk='$id'
");

$d = mysqli_fetch_assoc($data);
?>

<style>
body{
    font-family: Arial, Helvetica, sans-serif;
}

/* ================= KOP SURAT ================= */
.kop-surat{
    display: flex;
    align-items: center;
    border-bottom: 3px solid #000;
    padding-bottom: 10px;
    margin-bottom: 15px;
}

.kop-surat img{
    width: 80px;
    height: 80px;
    margin-right: 15px;
}

.kop-text{
    text-align: center;
    flex: 1;
}

.kop-text h2{
    margin: 0;
    font-size: 18px;
}

.kop-text p{
    margin: 2px 0;
    font-size: 12px;
}

/* ================= HEADER LAPORAN ================= */
.laporan-header{
    text-align: center;
    margin: 15px 0;
}

.laporan-header h3{
    margin: 0;
    text-decoration: underline;
}

/* ================= INFO NOTA ================= */
.info-nota {
    margin-bottom: 20px;
    font-size: 14px;
    line-height: 1.6;
}

.info-nota table td {
    padding: 2px 10px 2px 0;
}

/* ================= TABLE ================= */
.table-laporan{
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.table-laporan th,
.table-laporan td{
    border: 1px solid #000;
    padding: 8px;
}

.table-laporan th{
    background: #eaeaea;
}

/* ================= TTD ================= */
.ttd{
    margin-top: 50px;
    width: 100%;
    display: flex;
    justify-content: space-between;
    text-align: center;
}

.ttd-box{
    width: 200px;
}

.ttd-box p{
    margin: 5px 0;
}

/* ================= PRINT ================= */
@media print{

    body *{
        visibility: hidden;
    }

    .laporan-container,
    .laporan-container *{
        visibility: visible;
    }

    .laporan-container{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
    }

    .btn-print{
        display: none !important;
    }

    @page{
        size: A4;
        margin: 15mm;
    }
}
</style>

<div class="container-fluid laporan-container">

    <div class="card mt-3">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            Nota Barang Masuk
            <button onclick="window.print()" class="btn btn-light btn-sm btn-print">
                Print Nota
            </button>
        </div>

        <div class="card-body">

            <!-- ================= KOP SURAT ================= -->
            <div class="kop-surat">

                <img src="../assets/logokemenagnew.png" alt="Logo Kemenag">

                <div class="kop-text">
                    <h2>MADRASAH TSANAWIYAH NEGERI 3 KOTA BANJARMASIN</h2>
                    <p>Jalan Bhakti No. 04 Rt.32 Pemurus Dalam Banjarmasin</p>
                    <p>Kode Pos : 70248</p>
                </div>

            </div>

            <!-- ================= JUDUL ================= -->
            <div class="laporan-header">
                <h3>NOTA BARANG MASUK</h3>
            </div>

            <!-- ================= INFO NOTA ================= -->
            <div class="info-nota">
                <table>
                    <tr>
                        <td><strong>No. Transaksi</strong></td>
                        <td>:</td>
                        <td><?= htmlspecialchars($d['no_transaksi']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Masuk</strong></td>
                        <td>:</td>
                        <td><?= date('d-m-Y', strtotime($d['tanggal_masuk'])); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Sumber Dana</strong></td>
                        <td>:</td>
                        <td><?= htmlspecialchars($d['sumber_dana'] ?? '-'); ?></td>
                    </tr>
                </table>
            </div>

            <!-- ================= TABLE BARANG ================= -->
            <table class="table-laporan">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><?= htmlspecialchars($d['kode_barang']); ?></td>
                        <td><?= htmlspecialchars($d['nama_barang']); ?></td>
                        <td><?= $d['jumlah_masuk']; ?> Unit</td>
                    </tr>
                </tbody>
            </table>

            <!-- ================= TANDA TANGAN ================= -->
            <div class="ttd">

                <div class="ttd-box">
                    <p>Mengetahui,</p>
                    <p><b>Kepala Madrasah</b></p>
                    <br><br><br>
                    <p><b>(__________________)</b></p>
                </div>

                <div class="ttd-box">
                    <p>Banjarmasin, <?= date('d-m-Y'); ?></p>
                    <p><b>Admin Sarpras</b></p>
                    <br><br><br>
                    <p><b>(__________________)</b></p>
                </div>

            </div>

        </div>

    </div>

</div>
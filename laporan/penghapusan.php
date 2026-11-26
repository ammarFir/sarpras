<?php
include __DIR__ . '/../config.php';

$data = mysqli_query($conn,"
    SELECT
        p.*,
        s.nama_barang,
        s.kode_barang
    FROM tabel_penghapusan p
    LEFT JOIN tabel_sarana s ON p.id_sarana = s.id_sarana
    ORDER BY p.tanggal_penghapusan DESC
");
?>

<style>
body { font-family: Arial, Helvetica, sans-serif; }
.kop-surat {
    display: flex; align-items: center;
    border-bottom: 3px solid #000;
    padding-bottom: 10px; margin-bottom: 15px;
}
.kop-surat img { width: 80px; height: 80px; margin-right: 15px; }
.kop-text { text-align: center; flex: 1; }
.kop-text h2 { margin: 0; font-size: 18px; }
.kop-text p { margin: 2px 0; font-size: 12px; }
.laporan-header { text-align: center; margin: 15px 0; }
.laporan-header h3 { margin: 0; text-decoration: underline; }
.table-laporan { width: 100%; border-collapse: collapse; font-size: 13px; margin-bottom: 30px; }
.table-laporan th, .table-laporan td { border: 1px solid #000; padding: 8px; }
.table-laporan th { background: #eaeaea; }
@media print {
    body * { visibility: hidden; }
    .laporan-container, .laporan-container * { visibility: visible; }
    .laporan-container { position: absolute; top: 0; left: 0; width: 100%; }
    .btn-print { display: none !important; }
    @page { size: A4; margin: 15mm; }
}
</style>

<div class="container-fluid laporan-container mt-4">

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            Rekap Penghapusan Aset
            <button onclick="window.print()" class="btn btn-light btn-sm btn-print">
                Print
            </button>
        </div>

        <div class="card-body">

            <!-- KOP SURAT -->
            <div class="kop-surat">
                <img src="../assets/logokemenagnew.png" alt="Logo Kemenag">
                <div class="kop-text">
                    <h2>MADRASAH TSANAWIYAH NEGERI 3 KOTA BANJARMASIN</h2>
                    <p>Jalan Bhakti No. 04 Rt.32 Pemurus Dalam Banjarmasin</p>
                    <p>Kode Pos : 70248</p>
                </div>
            </div>

            <!-- JUDUL -->
            <div class="laporan-header">
                <h3>REKAP PENGHAPUSAN ASET</h3>
                <p>Tanggal Cetak: <?= date('d-m-Y'); ?></p>
            </div>

            <!-- TABLE -->
            <table class="table-laporan">
                <thead>
                    <tr>
                        <th width="40">No</th>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Alasan</th>
                        <th>No. Berita Acara</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    while($d = mysqli_fetch_assoc($data)){ 
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= date('d-m-Y', strtotime($d['tanggal_penghapusan'])); ?></td>
                        <td><?= htmlspecialchars($d['kode_barang'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($d['nama_barang'] ?? '-'); ?></td>
                        <td><?= $d['jumlah']; ?></td>
                        <td><?= htmlspecialchars($d['alasan']); ?></td>
                        <td><?= htmlspecialchars($d['no_berita_acara'] ?? '-'); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(mysqli_num_rows($data) == 0){ ?>
                        <tr><td colspan="7" class="text-center">Belum ada data penghapusan.</td></tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- TANDA TANGAN -->
            <div style="margin-top: 50px; display: flex; justify-content: flex-end; text-align: center;">
                <div style="width: 200px;">
                    <p>Banjarmasin, <?= date('d-m-Y'); ?></p>
                    <p><b>Kepala Madrasah</b></p>
                    <br><br><br>
                    <p><b>(__________________)</b></p>
                </div>
            </div>

        </div>

    </div>

</div>
<?php
include __DIR__ . '/../config.php';

$tanah = mysqli_query($conn,"
    SELECT *
    FROM tabel_prasarana_tanah
    ORDER BY kode_tanah ASC
");

$gedung = mysqli_query($conn,"
    SELECT *
    FROM tabel_prasarana_gedung
    ORDER BY nama_gedung ASC
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
            Rekap Data Prasarana (Tanah & Gedung)
            <button onclick="window.print()" class="btn btn-light btn-sm btn-print">
                Print
            </button>
        </div>

        <div class="card-body">

            <!-- KOP SURAT -->
            <div class="kop-surat">
              <img src="/sarpras/assets/logokemenagnew.png" alt="Logo Kemenag">
                <div class="kop-text">
                    <h2>MADRASAH TSANAWIYAH NEGERI 3 KOTA BANJARMASIN</h2>
                    <p>Jalan Bhakti No. 04 Rt.32 Pemurus Dalam Banjarmasin</p>
                    <p>Kode Pos : 70248</p>
                </div>
            </div>

            <!-- JUDUL -->
            <div class="laporan-header">
                <h3>REKAP DATA PRASARANA</h3>
                <p>Tanggal Cetak: <?= date('d-m-Y'); ?></p>
            </div>

            <!-- TABEL TANAH -->
            <h4 style="font-size: 14px; margin-bottom: 10px;">A. Data Tanah</h4>
            <table class="table-laporan">
                <thead>
                    <tr>
                        <th width="40">No</th>
                        <th>Kode Tanah</th>
                        <th>Luas (m²)</th>
                        <th>Status Kepemilikan</th>
                        <th>No. Sertifikat</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    while($t = mysqli_fetch_assoc($tanah)){ 
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($t['kode_tanah']); ?></td>
                        <td><?= number_format($t['luas'], 2, ',', '.'); ?></td>
                        <td><?= htmlspecialchars($t['status_kepemilikan'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($t['nomor_sertifikat'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($t['keterangan'] ?? '-'); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(mysqli_num_rows($tanah) == 0){ ?>
                        <tr><td colspan="6" class="text-center">Belum ada data tanah.</td></tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- TABEL GEDUNG -->
            <h4 style="font-size: 14px; margin-bottom: 10px;">B. Data Gedung</h4>
            <table class="table-laporan">
                <thead>
                    <tr>
                        <th width="40">No</th>
                        <th>Kode Gedung</th>
                        <th>Nama Gedung</th>
                        <th>Luas Bangunan (m²)</th>
                        <th>Tahun Dibangun</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    while($g = mysqli_fetch_assoc($gedung)){ 
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($g['kode_gedung']); ?></td>
                        <td><?= htmlspecialchars($g['nama_gedung']); ?></td>
                        <td><?= $g['luas_bangunan'] ? number_format($g['luas_bangunan'], 2, ',', '.') : '-'; ?></td>
                        <td><?= htmlspecialchars($g['tahun_dibangun'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($g['kondisi']); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(mysqli_num_rows($gedung) == 0){ ?>
                        <tr><td colspan="6" class="text-center">Belum ada data gedung.</td></tr>
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
<?php
include __DIR__ . '/../config.php';

$data = mysqli_query($conn,"
    SELECT
        pm.*,
        s.nama_barang AS nama_sarana,
        g.nama_gedung
    FROM tabel_pemeliharaan pm
    LEFT JOIN tabel_sarana s ON pm.id_sarana = s.id_sarana
    LEFT JOIN tabel_prasarana_gedung g ON pm.id_gedung = g.id_gedung
    ORDER BY pm.id_pemeliharaan DESC
");
?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3 class="mb-0">
            Pemeliharaan / Perbaikan
        </h3>

        <a href="halaman.php?menu=pemeliharaan_tambah"
           class="btn btn-success btn-sm">

            Tambah Pemeliharaan

        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body table-responsive">

            <table id="tabelPemeliharaan"
                   class="table table-bordered table-striped table-hover align-middle">

                <thead class="table-success">

                    <tr>
                        <th width="50">No</th>
                        <th>Tanggal</th>
                        <th>Aset (Barang / Gedung)</th>
                        <th>Deskripsi Kerusakan</th>
                        <th>Biaya</th>
                        <th>Status</th>
                        <th width="170">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    <?php
                    $no = 1;

                    while($d = mysqli_fetch_assoc($data)){

                        $nama_aset = $d['nama_sarana'];
                        if($d['nama_gedung']){
                            $nama_aset = "Gedung: " . $d['nama_gedung'];
                        }
                    ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td><?= date('d-m-Y', strtotime($d['tanggal_perbaikan'])); ?></td>

                        <td><?= htmlspecialchars($nama_aset ?? '-'); ?></td>

                        <td><?= htmlspecialchars($d['deskripsi_kerusakan'] ?? '-'); ?></td>

                        <td>Rp <?= number_format($d['biaya'] ?? 0, 0, ',', '.'); ?></td>

                        <td>

                            <?php if($d['status'] == 'Proses'){ ?>
                                <span class="badge bg-warning text-dark">Proses</span>
                            <?php }elseif($d['status'] == 'Selesai'){ ?>
                                <span class="badge bg-success">Selesai</span>
                            <?php }else{ ?>
                                <span class="badge bg-danger">Gagal</span>
                            <?php } ?>

                        </td>

                        <td>

                            <a href="halaman.php?menu=pemeliharaan_edit&id=<?= $d['id_pemeliharaan']; ?>"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <a href="halaman.php?menu=pemeliharaan_delete&id=<?= $d['id_pemeliharaan']; ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus data ini?')">

                                Hapus

                            </a>

                        </td>

                    </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- DATATABLES CSS -->
<link rel="stylesheet"
href="assets/datatable/css/dataTables.bootstrap5.min.css">

<!-- JQUERY -->
<script src="assets/datatable/jquery-3.7.1.min.js"></script>

<!-- DATATABLES JS -->
<script src="assets/datatable/jquery.dataTables.min.js"></script>

<script src="assets/datatable/dataTables.bootstrap5.min.js"></script>

<script>

$(document).ready(function(){

    $('#tabelPemeliharaan').DataTable({

        responsive: true,
        autoWidth: false,
        language: {

            search: "Cari :",
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Data tidak ditemukan",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {

                first: "Awal",
                last: "Akhir",
                next: "›",
                previous: "‹"

            }

        }

    });

});

</script>
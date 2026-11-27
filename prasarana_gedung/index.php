<?php
include __DIR__ . '/../config.php';

$data = mysqli_query($conn,"
    SELECT *
    FROM tabel_prasarana_gedung
    ORDER BY id_gedung DESC
");
?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3 class="mb-0">
            Data Gedung
        </h3>

        <a href="halaman.php?menu=prasarana_gedung_tambah"
           class="btn btn-success btn-sm">

            Tambah Gedung

        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body table-responsive">

            <table id="tabelGedung"
                   class="table table-bordered table-striped table-hover align-middle">

                <thead class="table-success">

                    <tr>
                        <th width="60">No</th>
                        <th>Kode Gedung</th>
                        <th>Nama Gedung</th>
                        <th>Luas (m²)</th>
                        <th>Tahun Dibangun</th>
                        <th>Kondisi</th>
                        <th width="200">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    <?php
                    $no = 1;

                    while($d = mysqli_fetch_assoc($data)){
                    ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td><?= htmlspecialchars($d['kode_gedung']); ?></td>

                        <td><?= htmlspecialchars($d['nama_gedung']); ?></td>

                        <td>
                            <?= $d['luas_bangunan'] ? number_format($d['luas_bangunan'], 2, ',', '.') : '-'; ?>
                        </td>

                        <td><?= htmlspecialchars($d['tahun_dibangun'] ?? '-'); ?></td>

                        <td><?= htmlspecialchars($d['kondisi']); ?></td>

                        <td>

                            <a href="halaman.php?menu=prasarana_gedung_edit&id=<?= $d['id_gedung']; ?>"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <a href="halaman.php?menu=prasarana_gedung_delete&id=<?= $d['id_gedung']; ?>"
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

    $('#tabelGedung').DataTable({

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
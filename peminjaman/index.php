<?php
include __DIR__ . '/../config.php';

$data = mysqli_query($conn,"
    SELECT
        p.*,
        s.nama_barang,
        s.kode_barang
    FROM tabel_peminjaman p
    LEFT JOIN tabel_sarana s ON p.id_sarana = s.id_sarana
    ORDER BY p.id_peminjaman DESC
");
?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3 class="mb-0">
            Peminjaman Barang
        </h3>

        <a href="halaman.php?menu=peminjaman_tambah"
           class="btn btn-success btn-sm">

            Tambah Peminjaman

        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body table-responsive">

            <table id="tabelPeminjaman"
                   class="table table-bordered table-striped table-hover align-middle">

                <thead class="table-success">

                    <tr>
                        <th width="50">No</th>
                        <th>Kode Pinjam</th>
                        <th>Peminjam</th>
                        <th>Barang</th>
                        <th>Tgl Pinjam</th>
                        <th>Rencana Kembali</th>
                        <th>Status</th>
                        <th width="250">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    <?php
                    $no = 1;

                    while($d = mysqli_fetch_assoc($data)){
                    ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td><?= htmlspecialchars($d['kode_peminjaman']); ?></td>

                        <td><?= htmlspecialchars($d['nama_peminjam']); ?></td>

                        <td>
                            <?= htmlspecialchars($d['kode_barang'] ?? '-'); ?> <br>
                            <small class="text-muted"><?= htmlspecialchars($d['nama_barang'] ?? '-'); ?></small>
                        </td>

                        <td><?= date('d-m-Y', strtotime($d['tanggal_pinjam'])); ?></td>

                        <td><?= date('d-m-Y', strtotime($d['rencana_kembali'])); ?></td>

                        <td>

                            <?php if($d['status'] == 'Dipinjam'){ ?>
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            <?php }elseif($d['status'] == 'Dikembalikan'){ ?>
                                <span class="badge bg-success">Dikembalikan</span>
                            <?php }else{ ?>
                                <span class="badge bg-danger">Terlambat</span>
                            <?php } ?>

                        </td>

                        <td>

                            <?php if($d['status'] == 'Dipinjam'){ ?>
                                <a href="halaman.php?menu=peminjaman_kembali&id=<?= $d['id_peminjaman']; ?>"
                                   class="btn btn-primary btn-sm text-white">

                                    Kembalikan

                                </a>
                            <?php } ?>

                            <a href="halaman.php?menu=peminjaman_edit&id=<?= $d['id_peminjaman']; ?>"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <a href="halaman.php?menu=peminjaman_delete&id=<?= $d['id_peminjaman']; ?>"
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

    $('#tabelPeminjaman').DataTable({

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
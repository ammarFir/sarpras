<?php
include __DIR__ . '/../config.php';

$data = mysqli_query($conn,"
    SELECT
        s.*,
        k.nama_kategori,
        r.nama_ruangan,
        d.keterangan AS sumber_dana,
        t.nama_satuan
    FROM tabel_sarana s
    LEFT JOIN tabel_kategori k ON s.id_kategori = k.id_kategori
    LEFT JOIN tabel_ruangan r ON s.id_ruangan = r.id_ruangan
    LEFT JOIN tabel_sumber_dana d ON s.id_sumber_dana = d.id_sumber_dana
    LEFT JOIN tabel_satuan t ON s.id_satuan = t.id_satuan
    ORDER BY s.id_sarana DESC
");
?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3 class="mb-0">
            Data Sarana
        </h3>

        <a href="halaman.php?menu=sarana_tambah"
           class="btn btn-success btn-sm">

            Tambah Sarana

        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body table-responsive">

            <table id="tabelSarana"
                   class="table table-bordered table-striped table-hover align-middle">

                <thead class="table-success">

                    <tr>
                        <th width="50">No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Ruangan</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                        <th width="170">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    <?php
                    $no = 1;

                    while($d = mysqli_fetch_assoc($data)){
                    ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td><?= htmlspecialchars($d['kode_barang']); ?></td>

                        <td><?= htmlspecialchars($d['nama_barang']); ?></td>

                        <td><?= htmlspecialchars($d['nama_kategori'] ?? '-'); ?></td>

                        <td><?= htmlspecialchars($d['nama_ruangan'] ?? '-'); ?></td>

                        <td>
                            <?= $d['jumlah']; ?>
                            <?= htmlspecialchars($d['nama_satuan'] ?? ''); ?>
                        </td>

                        <td>

                            <?php if($d['kondisi'] == 'Baik'){ ?>

                                <span class="badge bg-success">Baik</span>

                            <?php }elseif($d['kondisi'] == 'Rusak Ringan'){ ?>

                                <span class="badge bg-warning text-dark">Rusak Ringan</span>

                            <?php }else{ ?>

                                <span class="badge bg-danger">Rusak Berat</span>

                            <?php } ?>

                        </td>

                        <td>

                            <a href="halaman.php?menu=sarana_edit&id=<?= $d['id_sarana']; ?>"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <a href="halaman.php?menu=sarana_delete&id=<?= $d['id_sarana']; ?>"
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

    $('#tabelSarana').DataTable({

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
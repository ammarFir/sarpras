<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
    SELECT p.*, s.nama_barang 
    FROM tabel_peminjaman p
    JOIN tabel_sarana s ON p.id_sarana = s.id_sarana
    WHERE p.id_peminjaman='$id'
");

$d = mysqli_fetch_assoc($data);

if(isset($_POST['kembalikan'])){

    $tanggal_kembali  = mysqli_real_escape_string($conn, $_POST['tanggal_kembali']);
    $kondisi_kembali  = mysqli_real_escape_string($conn, $_POST['kondisi_kembali']);
    $status           = 'Dikembalikan';

    mysqli_query($conn,"
        UPDATE tabel_peminjaman
        SET
            tanggal_kembali='$tanggal_kembali',
            kondisi_kembali='$kondisi_kembali',
            status='$status'
        WHERE id_peminjaman='$id'
    ");

    echo "
    <script>
        alert('Barang berhasil dikembalikan');
        window.location='halaman.php?menu=peminjaman';
    </script>
    ";

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            Form Pengembalian Barang
        </div>

        <div class="card-body">

            <div class="alert alert-info">
                <strong>Info Peminjaman:</strong> <br>
                Peminjam: <?= htmlspecialchars($d['nama_peminjam']); ?> <br>
                Barang: <?= htmlspecialchars($d['nama_barang']); ?> (<?= $d['jumlah_pinjam']; ?> Unit) <br>
                Rencana Kembali: <?= date('d-m-Y', strtotime($d['rencana_kembali'])); ?>
            </div>

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Tanggal Kembali Aktual
                    </label>

                    <input type="date"
                           name="tanggal_kembali"
                           class="form-control"
                           value="<?= date('Y-m-d'); ?>"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Kondisi Barang Saat Dikembalikan
                    </label>

                    <select name="kondisi_kembali"
                            class="form-select"
                            required>

                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>

                    </select>

                </div>

                <button type="submit"
                        name="kembalikan"
                        class="btn btn-primary">

                    Konfirmasi Pengembalian

                </button>

                <a href="halaman.php?menu=peminjaman"
                   class="btn btn-secondary">

                    Batal

                </a>

            </form>

        </div>

    </div>

</div>
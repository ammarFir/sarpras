<?php
include __DIR__ . '/../config.php';

if(isset($_POST['simpan'])){

    $tanggal_perbaikan  = mysqli_real_escape_string($conn, $_POST['tanggal_perbaikan']);
    $jenis_aset         = $_POST['jenis_aset'];
    $id_sarana          = mysqli_real_escape_string($conn, $_POST['id_sarana']);
    $id_gedung          = mysqli_real_escape_string($conn, $_POST['id_gedung']);
    
    $deskripsi_kerusakan = mysqli_real_escape_string($conn, $_POST['deskripsi_kerusakan']);
    $tindakan_perbaikan  = mysqli_real_escape_string($conn, $_POST['tindakan_perbaikan']);
    $biaya               = (float) $_POST['biaya'];
    $status              = mysqli_real_escape_string($conn, $_POST['status']);

    // Simpan data (jika pilih sarana, id_gedung di-null-kan, dan sebaliknya)
    $id_sarana_db = ($jenis_aset == 'sarana') ? "'$id_sarana'" : "NULL";
    $id_gedung_db = ($jenis_aset == 'gedung') ? "'$id_gedung'" : "NULL";

    mysqli_query($conn,"
        INSERT INTO tabel_pemeliharaan(
            tanggal_perbaikan,
            id_sarana,
            id_gedung,
            deskripsi_kerusakan,
            tindakan_perbaikan,
            biaya,
            status
        ) VALUES (
            '$tanggal_perbaikan',
            $id_sarana_db,
            $id_gedung_db,
            '$deskripsi_kerusakan',
            '$tindakan_perbaikan',
            '$biaya',
            '$status'
        )
    ");

    echo "
    <script>
        alert('Data pemeliharaan berhasil disimpan');
        window.location='halaman.php?menu=pemeliharaan';
    </script>
    ";

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            Tambah Pemeliharaan / Perbaikan
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Perbaikan</label>
                        <input type="date" name="tanggal_perbaikan" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Jenis Aset yang Diperbaiki</label>
                        <select name="jenis_aset" id="jenis_aset" class="form-select" required>
                            <option value="sarana">Sarana (Barang)</option>
                            <option value="gedung">Prasarana (Gedung)</option>
                        </select>
                    </div>
                </div>

                <!-- Input Sarana -->
                <div class="mb-3" id="box_sarana">
                    <label class="form-label">Nama Barang (Sarana)</label>
                    <input type="text" name="id_sarana" class="form-control" placeholder="Ketik nama barang..." required>
                </div>

                <!-- Input Gedung (Hidden by default) -->
                <div class="mb-3 d-none" id="box_gedung">
                    <label class="form-label">Nama Gedung (Prasarana)</label>
                    <input type="text" name="id_gedung" class="form-control" placeholder="Ketik nama gedung...">
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Kerusakan</label>
                    <textarea name="deskripsi_kerusakan" class="form-control" rows="2" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tindakan Perbaikan</label>
                    <textarea name="tindakan_perbaikan" class="form-control" rows="2"></textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Biaya Perbaikan (Rp)</label>
                        <input type="number" name="biaya" class="form-control" step="0.01" value="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status Pengerjaan</label>
                        <input type="text" name="status" class="form-control" placeholder="Contoh: Proses / Selesai" required>
                    </div>
                </div>

                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                <a href="halaman.php?menu=pemeliharaan" class="btn btn-secondary">Kembali</a>

            </form>

        </div>

    </div>

</div>

<script>
document.getElementById('jenis_aset').addEventListener('change', function() {
    var val = this.value;
    var boxSarana = document.getElementById('box_sarana');
    var boxGedung = document.getElementById('box_gedung');
    
    if(val === 'sarana'){
        boxSarana.classList.remove('d-none');
        boxGedung.classList.add('d-none');
        document.querySelector('[name="id_sarana"]').setAttribute('required', 'required');
        document.querySelector('[name="id_gedung"]').removeAttribute('required');
    } else {
        boxSarana.classList.add('d-none');
        boxGedung.classList.remove('d-none');
        document.querySelector('[name="id_sarana"]').removeAttribute('required');
        document.querySelector('[name="id_gedung"]').setAttribute('required', 'required');
    }
});
// Trigger on load
document.getElementById('jenis_aset').dispatchEvent(new Event('change'));
</script>
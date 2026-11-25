<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
    SELECT *
    FROM tabel_pemeliharaan
    WHERE id_pemeliharaan='$id'
");

$d = mysqli_fetch_assoc($data);
$jenis_aset_skrg = ($d['id_gedung'] != NULL) ? 'gedung' : 'sarana';

if(isset($_POST['update'])){

    $tanggal_perbaikan  = mysqli_real_escape_string($conn, $_POST['tanggal_perbaikan']);
    $jenis_aset         = $_POST['jenis_aset'];
    $id_sarana          = ($jenis_aset == 'sarana') ? (int)$_POST['id_sarana'] : 'NULL';
    $id_gedung          = ($jenis_aset == 'gedung') ? (int)$_POST['id_gedung'] : 'NULL';
    
    $deskripsi_kerusakan = mysqli_real_escape_string($conn, $_POST['deskripsi_kerusakan']);
    $tindakan_perbaikan  = mysqli_real_escape_string($conn, $_POST['tindakan_perbaikan']);
    $biaya               = (float) $_POST['biaya'];
    $status              = mysqli_real_escape_string($conn, $_POST['status']);

    $id_sarana_query = ($id_sarana === 'NULL') ? "NULL" : "'$id_sarana'";
    $id_gedung_query = ($id_gedung === 'NULL') ? "NULL" : "'$id_gedung'";

    mysqli_query($conn,"
        UPDATE tabel_pemeliharaan
        SET
            tanggal_perbaikan='$tanggal_perbaikan',
            id_sarana=$id_sarana_query,
            id_gedung=$id_gedung_query,
            deskripsi_kerusakan='$deskripsi_kerusakan',
            tindakan_perbaikan='$tindakan_perbaikan',
            biaya='$biaya',
            status='$status'
        WHERE id_pemeliharaan='$id'
    ");

    echo "
    <script>
        alert('Data pemeliharaan berhasil diupdate');
        window.location='halaman.php?menu=pemeliharaan';
    </script>
    ";

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Edit Pemeliharaan / Perbaikan
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Perbaikan</label>
                        <input type="date" name="tanggal_perbaikan" class="form-control" value="<?= $d['tanggal_perbaikan']; ?>" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Jenis Aset yang Diperbaiki</label>
                        <select name="jenis_aset" id="jenis_aset" class="form-select" required>
                            <option value="sarana" <?= ($jenis_aset_skrg == 'sarana') ? 'selected' : ''; ?>>Sarana (Barang)</option>
                            <option value="gedung" <?= ($jenis_aset_skrg == 'gedung') ? 'selected' : ''; ?>>Prasarana (Gedung)</option>
                        </select>
                    </div>
                </div>

                <!-- Dropdown Sarana -->
                <div class="mb-3 <?= ($jenis_aset_skrg == 'gedung') ? 'd-none' : ''; ?>" id="box_sarana">
                    <label class="form-label">Pilih Barang (Sarana)</label>
                    <select name="id_sarana" class="form-select">
                        <option value="">-- Pilih Barang --</option>
                        <?php
                        $sarana = mysqli_query($conn,"SELECT id_sarana, kode_barang, nama_barang FROM tabel_sarana ORDER BY nama_barang ASC");
                        while($s = mysqli_fetch_assoc($sarana)){
                        ?>
                        <option value="<?= $s['id_sarana']; ?>" <?= ($d['id_sarana'] == $s['id_sarana']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($s['kode_barang'] . ' - ' . $s['nama_barang']); ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Dropdown Gedung -->
                <div class="mb-3 <?= ($jenis_aset_skrg == 'sarana') ? 'd-none' : ''; ?>" id="box_gedung">
                    <label class="form-label">Pilih Gedung (Prasarana)</label>
                    <select name="id_gedung" class="form-select">
                        <option value="">-- Pilih Gedung --</option>
                        <?php
                        $gedung = mysqli_query($conn,"SELECT id_gedung, kode_gedung, nama_gedung FROM tabel_prasarana_gedung ORDER BY nama_gedung ASC");
                        while($g = mysqli_fetch_assoc($gedung)){
                        ?>
                        <option value="<?= $g['id_gedung']; ?>" <?= ($d['id_gedung'] == $g['id_gedung']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($g['kode_gedung'] . ' - ' . $g['nama_gedung']); ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Kerusakan</label>
                    <textarea name="deskripsi_kerusakan" class="form-control" rows="2" required><?= htmlspecialchars($d['deskripsi_kerusakan'] ?? ''); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tindakan Perbaikan</label>
                    <textarea name="tindakan_perbaikan" class="form-control" rows="2"><?= htmlspecialchars($d['tindakan_perbaikan'] ?? ''); ?></textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Biaya Perbaikan (Rp)</label>
                        <input type="number" name="biaya" class="form-control" step="0.01" value="<?= $d['biaya'] ?? 0; ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status Pengerjaan</label>
                        <select name="status" class="form-select" required>
                            <option value="Proses" <?= ($d['status'] == 'Proses') ? 'selected' : ''; ?>>Proses</option>
                            <option value="Selesai" <?= ($d['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                            <option value="Gagal" <?= ($d['status'] == 'Gagal') ? 'selected' : ''; ?>>Gagal</option>
                        </select>
                    </div>
                </div>

                <button type="submit" name="update" class="btn btn-warning">Update</button>
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
    } else {
        boxSarana.classList.add('d-none');
        boxGedung.classList.remove('d-none');
    }
});
</script>
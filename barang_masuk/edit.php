<?php
include __DIR__ . '/../config.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
    SELECT *
    FROM tabel_barang_masuk
    WHERE id_barang_masuk='$id'
");

$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $no_transaksi   = mysqli_real_escape_string($conn, $_POST['no_transaksi']);
    $tanggal_masuk  = mysqli_real_escape_string($conn, $_POST['tanggal_masuk']);
    $id_sarana      = (int) $_POST['id_sarana'];
    $jumlah_masuk   = (int) $_POST['jumlah_masuk'];
    $id_sumber_dana = (int) $_POST['id_sumber_dana'];
    $bukti_nota     = $d['bukti_nota']; // simpan nota lama by default

    // Jika ada upload nota baru
    if(isset($_FILES['bukti_nota']) && $_FILES['bukti_nota']['error'] == 0){
        $ext = pathinfo($_FILES['bukti_nota']['name'], PATHINFO_EXTENSION);
        $bukti_nota_baru = "NOTA_" . time() . "." . $ext;
        
        if(move_uploaded_file($_FILES['bukti_nota']['tmp_name'], __DIR__ . "/../assets/uploads/" . $bukti_nota_baru)){
            // Hapus file lama jika ada
            if($bukti_nota && file_exists(__DIR__ . "/../assets/uploads/" . $bukti_nota)){
                unlink(__DIR__ . "/../assets/uploads/" . $bukti_nota);
            }
            $bukti_nota = $bukti_nota_baru;
        }
    }

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_barang_masuk
        WHERE no_transaksi='$no_transaksi'
        AND id_barang_masuk != '$id'
    ");

    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>
            alert('No. Transaksi sudah digunakan');
            window.history.back();
        </script>
        ";

    }else{

        mysqli_query($conn,"
            UPDATE tabel_barang_masuk
            SET
                no_transaksi='$no_transaksi',
                tanggal_masuk='$tanggal_masuk',
                id_sarana='$id_sarana',
                jumlah_masuk='$jumlah_masuk',
                id_sumber_dana='$id_sumber_dana',
                bukti_nota='$bukti_nota'
            WHERE id_barang_masuk='$id'
        ");

        echo "
        <script>
            alert('Barang masuk berhasil diupdate');
            window.location='halaman.php?menu=barang_masuk';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            Edit Barang Masuk
        </div>

        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

                <div class="row">

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                No. Transaksi
                            </label>

                            <input type="text"
                                   name="no_transaksi"
                                   value="<?= htmlspecialchars($d['no_transaksi']); ?>"
                                   class="form-control"
                                   required>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">
                                Tanggal Masuk
                            </label>

                            <input type="date"
                                   name="tanggal_masuk"
                                   value="<?= $d['tanggal_masuk']; ?>"
                                   class="form-control"
                                   required>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="mb-3">

                            <label class="form-label">
                                Pilih Barang (Sarana)
                            </label>

                            <select name="id_sarana"
                                    class="form-select"
                                    required>

                                <?php
                                $sarana = mysqli_query($conn,"
                                    SELECT id_sarana, kode_barang, nama_barang
                                    FROM tabel_sarana
                                    ORDER BY nama_barang ASC
                                ");

                                while($s = mysqli_fetch_assoc($sarana)){
                                ?>

                                <option value="<?= $s['id_sarana']; ?>"
                                    <?= ($d['id_sarana'] == $s['id_sarana']) ? 'selected' : ''; ?>>

                                    <?= htmlspecialchars($s['kode_barang'] . ' - ' . $s['nama_barang']); ?>

                                </option>

                                <?php } ?>

                            </select>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">

                        <div class="mb-3">

                            <label class="form-label">
                                Jumlah Masuk
                            </label>

                            <input type="number"
                                   name="jumlah_masuk"
                                   value="<?= $d['jumlah_masuk']; ?>"
                                   class="form-control"
                                   min="1"
                                   required>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="mb-3">

                            <label class="form-label">
                                Sumber Dana
                            </label>

                            <select name="id_sumber_dana"
                                    class="form-select"
                                    required>

                                <?php
                                $dana = mysqli_query($conn,"
                                    SELECT *
                                    FROM tabel_sumber_dana
                                    ORDER BY keterangan ASC
                                ");

                                while($dn = mysqli_fetch_assoc($dana)){
                                ?>

                                <option value="<?= $dn['id_sumber_dana']; ?>"
                                    <?= ($d['id_sumber_dana'] == $dn['id_sumber_dana']) ? 'selected' : ''; ?>>

                                    <?= htmlspecialchars($dn['keterangan']); ?>

                                </option>

                                <?php } ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="mb-3">

                            <label class="form-label">
                                Bukti Nota (Opsional)
                            </label>

                            <input type="file"
                                   name="bukti_nota"
                                   class="form-control"
                                   accept="image/*,application/pdf">

                            <?php if($d['bukti_nota']){ ?>
                                <small class="text-muted d-block mt-1">
                                    Nota saat ini: <a href="assets/uploads/<?= $d['bukti_nota']; ?>" target="_blank">Lihat File</a>. (Biarkan kosong jika tidak ingin mengubah)
                                </small>
                            <?php } ?>

                        </div>

                    </div>

                </div>

                <button type="submit"
                        name="update"
                        class="btn btn-warning">

                    Update

                </button>

                <a href="halaman.php?menu=barang_masuk"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>
<?php
include __DIR__ . '/../config.php';

if(isset($_POST['simpan'])){

    $no_transaksi   = mysqli_real_escape_string($conn, $_POST['no_transaksi']);
    $tanggal_masuk  = mysqli_real_escape_string($conn, $_POST['tanggal_masuk']);
    $id_sarana      = (int) $_POST['id_sarana'];
    $jumlah_masuk   = (int) $_POST['jumlah_masuk'];
    $id_sumber_dana = (int) $_POST['id_sumber_dana'];

    // Proses Upload Bukti Nota
    $bukti_nota = '';
    if(isset($_FILES['bukti_nota']) && $_FILES['bukti_nota']['error'] == 0){
        $ext = pathinfo($_FILES['bukti_nota']['name'], PATHINFO_EXTENSION);
        $bukti_nota = "NOTA_" . time() . "." . $ext;
                move_uploaded_file($_FILES['bukti_nota']['tmp_name'], __DIR__ . "/../assets/uploads/" . $bukti_nota);
    }

    $cek = mysqli_query($conn,"
        SELECT *
        FROM tabel_barang_masuk
        WHERE no_transaksi='$no_transaksi'
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
            INSERT INTO tabel_barang_masuk(
                no_transaksi,
                tanggal_masuk,
                id_sarana,
                jumlah_masuk,
                id_sumber_dana,
                bukti_nota
            ) VALUES (
                '$no_transaksi',
                '$tanggal_masuk',
                '$id_sarana',
                '$jumlah_masuk',
                '$id_sumber_dana',
                '$bukti_nota'
            )
        ");

        echo "
        <script>
            alert('Barang masuk berhasil disimpan');
            window.location='halaman.php?menu=barang_masuk';
        </script>
        ";

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            Tambah Barang Masuk
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
                                   class="form-control"
                                   placeholder="Contoh: BM-20231124-001"
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
                                   class="form-control"
                                   value="<?= date('Y-m-d'); ?>"
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

                                <option value="">
                                    -- Pilih Barang --
                                </option>

                                <?php
                                $sarana = mysqli_query($conn,"
                                    SELECT id_sarana, kode_barang, nama_barang
                                    FROM tabel_sarana
                                    ORDER BY nama_barang ASC
                                ");

                                while($s = mysqli_fetch_assoc($sarana)){
                                ?>

                                <option value="<?= $s['id_sarana']; ?>">
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

                                <option value="">
                                    -- Pilih Sumber Dana --
                                </option>

                                <?php
                                $dana = mysqli_query($conn,"
                                    SELECT *
                                    FROM tabel_sumber_dana
                                    ORDER BY keterangan ASC
                                ");

                                while($d = mysqli_fetch_assoc($dana)){
                                ?>

                                <option value="<?= $d['id_sumber_dana']; ?>">
                                    <?= htmlspecialchars($d['keterangan']); ?>
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

                        </div>

                    </div>

                </div>

                <button type="submit"
                        name="simpan"
                        class="btn btn-success">

                    Simpan

                </button>

                <a href="halaman.php?menu=barang_masuk"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>
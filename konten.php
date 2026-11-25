<?php

switch ($menu) {

    // MASTER DATA
case 'user':
        include 'user/index.php';
        break;

        case 'user_tambah':
        include 'user/tambah.php';
        break;

    case 'user_edit':
        include 'user/edit.php';
        break;

    case 'user_delete':
        include 'user/delete.php';
        break;


        //kategori
case 'kategori':
        include 'kategori/index.php';
        break;

    case 'kategori_tambah':
        include 'kategori/tambah.php';
        break;

    case 'kategori_edit':
        include 'kategori/edit.php';
        break;

    case 'kategori_delete':
        include 'kategori/delete.php';
        break;

        //ruangan
case 'ruangan':
        include 'ruangan/index.php';
        break;

            case 'ruangan_tambah':
        include 'ruangan/tambah.php';
        break;

    case 'ruangan_edit':
        include 'ruangan/edit.php';
        break;

    case 'ruangan_delete':
        include 'ruangan/delete.php';
        break;


        //sumber dana
case 'sumber_dana':
        include 'sumber_dana/index.php';
        break;

        case 'sumber_dana_tambah':
        include 'sumber_dana/tambah.php';
        break;

    case 'sumber_dana_edit':
        include 'sumber_dana/edit.php';
        break;

    case 'sumber_dana_delete':
        include 'sumber_dana/delete.php';
        break;
    

        //satuan
case 'satuan':
        include 'satuan/index.php';
        break;

            case 'satuan_tambah':
        include 'satuan/tambah.php';
        break;

    case 'satuan_edit':
        include 'satuan/edit.php';
        break;

    case 'satuan_delete':
        include 'satuan/delete.php';
        break;

    // DATA ASET
case 'sarana':
        include 'sarana/index.php';
        break;

    case 'sarana_tambah':
        include 'sarana/tambah.php';
        break;

    case 'sarana_edit':
        include 'sarana/edit.php';
        break;

    case 'sarana_delete':
        include 'sarana/delete.php';
        break;


        //prasarana tanah
    case 'prasarana_tanah':
        include 'prasarana_tanah/index.php';
        break;

            case 'prasarana_tanah_tambah':
        include 'prasarana_tanah/tambah.php';
        break;

    case 'prasarana_tanah_edit':
        include 'prasarana_tanah/edit.php';
        break;

    case 'prasarana_tanah_delete':
        include 'prasarana_tanah/delete.php';
        break;


        //prasarana gedung
    case 'prasarana_gedung':
        include 'prasarana_gedung/index.php';
        break;


            case 'prasarana_gedung_tambah':
        include 'prasarana_gedung/tambah.php';
        break;

    case 'prasarana_gedung_edit':
        include 'prasarana_gedung/edit.php';
        break;

    case 'prasarana_gedung_delete':
        include 'prasarana_gedung/delete.php';
        break;

    // TRANSAKSI
    case 'barang_masuk':
        include 'barang_masuk/index.php';
        break;

            case 'barang_masuk_tambah':
        include 'barang_masuk/tambah.php';
        break;

    case 'barang_masuk_edit':
        include 'barang_masuk/edit.php';
        break;

    case 'barang_masuk_delete':
        include 'barang_masuk/delete.php';
        break;


        //mutasi
    case 'mutasi':
        include 'mutasi/index.php';
        break;

            case 'mutasi_tambah':
        include 'mutasi/tambah.php';
        break;

    case 'mutasi_edit':
        include 'mutasi/edit.php';
        break;

    case 'mutasi_delete':
        include 'mutasi/delete.php';
        break;


        //peminjaman
    case 'peminjaman':
        include 'peminjaman/index.php';
        break;
    case 'peminjaman_tambah':
        include 'peminjaman/tambah.php';
        break;

    case 'peminjaman_edit':
        include 'peminjaman/edit.php';
        break;

    case 'peminjaman_kembali':
        include 'peminjaman/kembali.php';
        break;

    case 'peminjaman_delete':
        include 'peminjaman/delete.php';
        break;

        //pemeliharaan
    case 'pemeliharaan':
        include 'pemeliharaan/index.php';
        break;

            case 'pemeliharaan_tambah':
        include 'pemeliharaan/tambah.php';
        break;

    case 'pemeliharaan_edit':
        include 'pemeliharaan/edit.php';
        break;

    case 'pemeliharaan_delete':
        include 'pemeliharaan/delete.php';
        break;


        //pngehapusan
    case 'penghapusan':
        include 'penghapusan/index.php';
        break;
            case 'penghapusan_tambah':
        include 'penghapusan/tambah.php';
        break;

    case 'penghapusan_edit':
        include 'penghapusan/edit.php';
        break;

    case 'penghapusan_delete':
        include 'penghapusan/delete.php';
        break;




    // LAPORAN
    case 'lap_sarana':
        include 'laporan/sarana.php';
        break;

    case 'lap_prasarana':
        include 'laporan/prasarana.php';
        break;

    case 'lap_peminjaman':
        include 'laporan/peminjaman.php';
        break;

    case 'lap_mutasi':
        include 'laporan/mutasi.php';
        break;

    case 'lap_pemeliharaan':
        include 'laporan/pemeliharaan.php';
        break;

    case 'lap_penghapusan':
        include 'laporan/penghapusan.php';
        break;

    default:
        echo "<div class='alert alert-warning'>Menu tidak ditemukan.</div>";
}
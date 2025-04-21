<?php
include('koneksi.php');
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Proses form jika dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $deskripsi_barang = mysqli_real_escape_string($conn, $_POST['deskripsi_barang']);
    $harga_barang = floatval($_POST['harga_barang']);
    $persentase_diskon = isset($_POST['persentase_diskon']) ? floatval($_POST['persentase_diskon']) : 0;

    $potongan_diskon = $harga_barang * ($persentase_diskon / 100);
    $harga_setelah_diskon = $harga_barang - $potongan_diskon;

    $gambar_barang = '';
    if (isset($_FILES['gambar_barang']) && $_FILES['gambar_barang']['error'] == 0) {
        $gambar_barang = basename($_FILES['gambar_barang']['name']);
        $target_dir = "gambar/";
        $target_file = $target_dir . $gambar_barang;

        if (!move_uploaded_file($_FILES['gambar_barang']['tmp_name'], $target_file)) {
            die("Error uploading image.");
        }
    }

    $query_diskon = "INSERT INTO tb_diskon (barang_diskon, diskon, harga_setelah_diskon)
                     VALUES ('$nama_barang', '$persentase_diskon', '$harga_setelah_diskon')";

    if (mysqli_query($conn, $query_diskon)) {
        $id_diskon = mysqli_insert_id($conn);

        $query_produk = "INSERT INTO tb_barang (nama_barang, harga_barang, gambar_barang, deskripsi_barang, id_diskon)
                         VALUES ('$nama_barang', '$harga_barang', '$gambar_barang', '$deskripsi_barang', '$id_diskon')";

        if (mysqli_query($conn, $query_produk)) {
            echo "<script>alert('Produk berhasil ditambahkan.');window.location='dashboard.php';</script>";
            exit();
        } else {
            die("Error adding product: " . mysqli_error($conn));
        }
    } else {
        die("Error adding discount: " . mysqli_error($conn));
    }
}
?>

<!-- Tampilan Form Tambah Produk -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
</head>
<body>
    <h2>Form Tambah Produk</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="nama_barang">Nama Barang:</label><br>
        <input type="text" name="nama_barang" required><br><br>

        <label for="deskripsi_barang">Deskripsi:</label><br>
        <textarea name="deskripsi_barang" rows="4" required></textarea><br><br>

        <label for="harga_barang">Harga Barang:</label><br>
        <input type="number" name="harga_barang" required><br><br>

        <label for="persentase_diskon">Diskon (%):</label><br>
        <input type="number" name="persentase_diskon" min="0" max="100"><br><br>

        <label for="gambar_barang">Gambar Barang:</label><br>
        <input type="file" name="gambar_barang" accept="image/*" required><br><br>

        <button type="submit">Simpan Produk</button>
    </form>
</body>
</html>
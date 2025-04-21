<?php
session_start();
include('koneksi.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (empty($_SESSION['cart'])) {
    echo "<p>⚠️ Keranjang belanja masih kosong.</p>";
    echo "<a href='home.php'>Kembali ke Belanja</a>";
    exit;
}

$username = $_SESSION['username'];
$tanggal = date("Y-m-d H:i:s");

// Simpan semua item dari keranjang ke tabel pesanan
foreach ($_SESSION['cart'] as $item) {
    $barang_id = $item['id'];
    $nama_barang = mysqli_real_escape_string($conn, $item['name']);
    $harga_satuan = $item['price'];
    $jumlah = $item['quantity'];
    $total_harga = $harga_satuan * $jumlah;

    $sql = "INSERT INTO tb_pesanan (username, barang_id, nama_barang, harga_satuan, jumlah, total_harga, tanggal) 
            VALUES ('$username', '$barang_id', '$nama_barang', '$harga_satuan', '$jumlah', '$total_harga', '$tanggal')";
    
    mysqli_query($conn, $sql);
}

// Kosongkan keranjang setelah checkout
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Selesai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            text-align: center;
            padding: 50px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            display: inline-block;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="success">
    <h2>✅ Checkout Berhasil!</h2>
    <p>Pesanan Anda sudah disimpan.</p>
</div>

<a href="home.php">Kembali ke Halaman Utama</a>

</body>
</html>

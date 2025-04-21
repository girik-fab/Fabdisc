<?php
session_start();
include('koneksi.php');

// Pastikan user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username=$_SESSION['username'];
$id_pelanggan = $_SESSION['id_pelanggan']; // Ambil ID pelanggan dari session

// Ambil riwayat pesanan
$query = "SELECT * FROM tb_pesanan WHERE username = '$username' ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil
if (!$result) {
    die('Error dalam query: ' . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Riwayat Pesanan</h2>
        <a href="home.php"><-Kembali</a>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Total Harga</th>
                        <th>Tanggal Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['id_pesanan']; ?></td>
                            <td>Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                            <td><?php echo $row['tanggal']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Anda belum memiliki riwayat pesanan.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
session_start();
include('koneksi.php');

// Cek apakah admin sudah login
if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Query untuk mengambil riwayat pesanan
$query = "SELECT *
          FROM tb_pesanan p
          ORDER BY p.tanggal DESC";

// Eksekusi query
$result = mysqli_query($conn, $query);

// Cek apakah query berhasil dijalankan
if (!$result) {
    die("Error in query: " . mysqli_error($conn));
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Riwayat Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f5f7;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .container {
            width: 95%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        /* Tombol Navigasi */
        .navbar {
            display: flex;
            justify-content: flex-start;
            gap: 20px;
            margin-bottom: 20px;
        }
        .navbar a {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }
        .navbar a:hover {
            background-color: #0056b3;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #007bff;
            color: white;
        }
        tr:hover {
            background: #f1f1f1;
        }
        .action-buttons a {
            padding: 6px 12px;
            margin: 0 3px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 13px;
        }
        .action-buttons .view {
            background: #28a745;
        }
        .action-buttons .view:hover {
            background: #218838;
        }
        .logout {
            display: inline-block;
            background: #6c757d;
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 6px;
            margin-top: 20px;
        }
        .logout:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>

<!-- Tombol Navigasi -->
<div class="navbar">
    <a href="dashboard.php">Data Produk</a>
    <a href="riwayat_pesanan_admin.php">Riwayat Pesanan</a>
    <a href="logout.php" >Logout</a>
</div>

<div class="container">
    <h1>Riwayat Pesanan</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pesanan</th>
                <th>Nama Pelanggan</th>
                <th>Total Harga</th>
                <th>Tanggal Pesanan</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['id_pesanan']; ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td>Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='7'>Tidak ada riwayat pesanan.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>

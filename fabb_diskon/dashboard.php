<?php
session_start();
include('koneksi.php');

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Data Produk</title>
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
        a.add-button {
            display: inline-block;
            background: #007bff;
            color: #fff;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
            transition: 0.3s;
        }
        a.add-button:hover {
            background: #0056b3;
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
        .product-img {
            width: 100px;
            border-radius: 8px;
            object-fit: cover;
        }
        .action-buttons a {
            padding: 6px 12px;
            margin: 0 3px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 13px;
        }
        .action-buttons .edit {
            background: #28a745;
        }
        .action-buttons .delete {
            background: #dc3545;
        }
        .action-buttons .edit:hover {
            background: #218838;
        }
        .action-buttons .delete:hover {
            background: #c82333;
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

    </style>
</head>
<body>
<div class="navbar">
    <a href="dashboard.php">Data Produk</a>
    <a href="riwayat_pesanan_admin.php">Riwayat Pesanan</a>
    <a href="logout.php" >Logout</a>
</div>

<div class="container">
    <h1>Data Produk</h1>
    <a href="addbarang.php" class="add-button">+ Tambah Produk</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Diskon</th>
                <th>Harga Setelah Diskon</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT b.*, d.harga_setelah_diskon, d.diskon
        FROM tb_barang b
        JOIN tb_diskon d ON b.id_diskon = d.id_diskon
        ORDER BY b.id_barang DESC";

        $result = mysqli_query($conn, $query);

        $no = 1;
        while($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                <td><?php echo substr(htmlspecialchars($row['deskripsi_barang']), 0, 30); ?>...</td>
                <td>Rp <?php echo number_format($row['harga_barang'], 0, ',', '.'); ?></td>
                <td><?php echo htmlspecialchars($row['diskon']); ?>%</td>
                <td>Rp <?php echo number_format($row['harga_setelah_diskon'], 0, ',', '.'); ?></td>
                <td>
                    <img src="gambar/<?php echo htmlspecialchars($row['gambar_barang']); ?>" class="product-img" alt="Produk">
                </td>
                <td class="action-buttons">
                    <a href="editproduk.php?id=<?php echo $row['id_barang']; ?>" class="edit">Edit</a>
                    <a href="proses-hapus.php?id=<?php echo $row['id_barang']; ?>" class="delete" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

</div>

</body>
</html>

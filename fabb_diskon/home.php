<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('koneksi.php');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Penjualan Produk</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        header h1 {
            margin: 0;
            font-size: 2.2rem;
        }
        .cart {
            margin-top: 10px;
        }
        .product-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            transition: transform 0.2s, box-shadow 0.2s;
            background: white;
        }
        .product-card img {
            max-height: 160px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        }
        .card-body {
            padding: 15px;
        }
        .card-title {
            font-size: 1rem;
            margin-bottom: 8px;
            color: #333;
        }
        .original-price {
            text-decoration: line-through;
            color: #dc3545;
            font-size: 0.85rem;
            margin: 0;
        }
        .discounted-price {
            font-weight: bold;
            color: #28a745;
            margin: 5px 0;
        }
        .text-muted {
            font-size: 0.8rem;
        }
        .btn-action {
            margin: 5px 0 2px;
            width: 100%;
        }
        footer {
            background-color: #fff;
            text-align: center;
            padding: 12px 0;
            border-top: 1px solid #eee;
            margin-top: 30px;
            color: #555;
        }
    </style>
</head>
<body>

<header>
    <h1>ONLINE SHOP</h1>
    <div class="cart">
        <a href="riwayat_pesanan.php" class="btn btn-light me-2">Riwayat Pesanan</a>
        <a href="cart.php" class="btn btn-light me-2">🛒 Lihat Keranjang</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</header>

<div class="container">
    <div class="row justify-content-start g-3">
        <?php
        $query = "SELECT b.*, d.harga_setelah_diskon, d.diskon FROM tb_barang b JOIN tb_diskon d ON b.id_diskon = d.id_diskon;";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                    <div class="card product-card h-100">
                        <img src="gambar/<?php echo htmlspecialchars($row['gambar_barang']); ?>" class="card-img-top" alt="Produk">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['nama_barang']); ?></h5>
                            <p class="original-price">Rp <?php echo number_format($row['harga_barang'], 0, ',', '.'); ?></p>
                            <p class="discounted-price">Rp <?php echo number_format($row['harga_setelah_diskon'], 0, ',', '.'); ?></p>
                            <p class="text-muted">Diskon: <?php echo htmlspecialchars($row['diskon']); ?>%</p>
                            <p class="text-muted"> <?php echo htmlspecialchars($row['deskripsi_barang']); ?></p>
                            <a href="cart.php?add=1&id=<?php echo $row['id_barang']; ?>&name=<?php echo urlencode($row['nama_barang']); ?>&price=<?php echo $row['harga_setelah_diskon']; ?>" 
   class="btn btn-primary mt-2">+ Keranjang</a>

                           </div>
                    </div>
                </div>
        <?php }
        } else {
            echo "<p class='text-center'>Belum ada produk yang tersedia.</p>";
        }
        ?>
    </div>
</div>

<footer>
    <p>&copy; Made by Fabnsyhh</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

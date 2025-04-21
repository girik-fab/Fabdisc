<?php
session_start();

// Fungsi untuk menambahkan item ke dalam keranjang
function addToCart($productId, $productName, $productPrice, $quantity) {
    $item = [
        'id' => $productId,
        'name' => $productName,
        'price' => $productPrice,
        'quantity' => $quantity,
    ];

    // Cek apakah item sudah ada di keranjang
    if (isset($_SESSION['cart'][$productId])) {
        // Jika sudah ada, update jumlahnya
        $_SESSION['cart'][$productId]['quantity'] += $quantity;
    } else {
        // Jika belum ada, tambahkan item baru ke keranjang
        $_SESSION['cart'][$productId] = $item;
    }
}

// Fungsi untuk menghapus item dari keranjang
function removeFromCart($productId) {
    unset($_SESSION['cart'][$productId]);
}

// Fungsi untuk menghitung total harga keranjang
function getTotalPrice() {
    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }
    return $totalPrice;
}

// Fungsi untuk menampilkan keranjang
function displayCart() {
    if (empty($_SESSION['cart'])) {
        echo "<p>Keranjang belanja Anda kosong.</p>";
    } else {
        echo "<table class='cart-table'>
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>";

        foreach ($_SESSION['cart'] as $item) {
            $totalItemPrice = $item['price'] * $item['quantity'];
            echo "<tr>
                    <td>{$item['name']}</td>
                    <td>Rp {$item['price']}</td>
                    <td>{$item['quantity']}</td>
                    <td>Rp {$totalItemPrice}</td>
                    <td><a class='remove-link' href='cart.php?remove={$item['id']}'>Hapus</a></td>
                  </tr>";
        }

        echo "</tbody>
            </table>";
        echo "<div class='total'>
                <h3>Total: Rp " . getTotalPrice() . "</h3>
            </div>";
    }
}

// Menambahkan item ke keranjang
if (isset($_GET['add'])) {
    $productId = $_GET['id'];
    $productName = $_GET['name'];
    $productPrice = $_GET['price'];
    $quantity = 1; // Jumlah default

    addToCart($productId, $productName, $productPrice, $quantity);
}

// Menghapus item dari keranjang
if (isset($_GET['remove'])) {
    $productId = $_GET['remove'];
    removeFromCart($productId);
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color:rgb(76, 152, 175);
            color: white;
            padding: 20px;
            text-align: center;
            margin: 0;
        }

        .cart-table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-table th, .cart-table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .cart-table th {
            background-color:rgb(76, 160, 175);
            color: white;
        }

        .cart-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .cart-table tr:hover {
            background-color: #ddd;
        }

        .remove-link {
            color: red;
            text-decoration: none;
        }

        .remove-link:hover {
            text-decoration: underline;
        }

        .total {
            text-align: right;
            font-size: 20px;
            margin: 20px 0;
            padding-right: 50px;
        }

        a {
            text-decoration: none;
            color: #4CAF50;
            font-size: 18px;
            display: inline-block;
            margin: 20px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Keranjang Belanja Anda</h1>
    <?php displayCart(); ?>
    <?php if (!empty($_SESSION['cart'])): ?>
    <div style="text-align:center; margin: 20px;">
        <a href="checkout.php" 
           style="
               background-color:rgb(40, 167, 51);
               color: white;
               padding: 12px 25px;
               text-decoration: none;
               border-radius: 5px;
               font-size: 16px;
               display: inline-block;">
           🛒 Checkout Sekarang
        </a>
    </div>
<?php endif; ?>

    <br>
    <a href="home.php">Kembali ke Belanja</a>
</body>
</html>

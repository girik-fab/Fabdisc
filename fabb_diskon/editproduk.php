<?php
include 'koneksi.php';
session_start();

// Cek apakah ada ID yang dikirim via URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Amankan dari SQL Injection

    $query = "SELECT 
                b.*, 
                d.harga_setelah_diskon, 
                d.diskon, 
                d.id_diskon 
              FROM tb_barang b
              JOIN tb_diskon d ON b.id_diskon = d.id_diskon
              WHERE b.id_barang = $id";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        die("❌ Data tidak ditemukan untuk ID: $id");
    }
} else {
    die("❌ ID tidak ditemukan di URL.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f9fc;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        form {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        section.base div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
        }
        textarea {
            resize: vertical;
        }
        img {
            display: block;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        small {
            display: block;
            margin-top: 5px;
            color: #999;
        }
        button {
            background: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <center>
        <h1>Edit Produk <?php echo htmlspecialchars($data['nama_barang']); ?></h1>
    </center>
    <form method="POST" action="proses-edit.php" enctype="multipart/form-data">
        <section class="base">
            <!-- Hidden fields untuk ID -->
            <input type="hidden" name="id" value="<?php echo $data['id_barang']; ?>">
            <input type="hidden" name="id_diskon" value="<?php echo $data['id_diskon']; ?>">

            <div>
                <label>Nama Produk</label>
                <input type="text" name="nama_barang" value="<?php echo htmlspecialchars($data['nama_barang']); ?>" required />
            </div>
            <div>
                <label>Deskripsi</label>
                <textarea name="deskripsi_barang" rows="3"><?php echo htmlspecialchars($data['deskripsi_barang']); ?></textarea>
            </div>
            <div>
                <label>Harga Barang</label>
                <input type="number" name="harga_barang" value="<?php echo $data['harga_barang']; ?>" required />
            </div>
            <div>
                <label>Gambar Produk Saat Ini</label><br>
                <img src="gambar/<?php echo $data['gambar_barang']; ?>" width="120" style="margin-bottom: 10px;"><br>
                <input type="file" name="gambar_barang" />
                <small style="color: red;">* Abaikan jika tidak ingin mengubah gambar</small>
            </div>
            <div>
                <label>Persentase Diskon (%)</label>
                <input type="number" name="persentase_diskon" min="0" max="100" value="<?php echo $data['diskon']; ?>" />
            </div>
            <div>
                <button type="submit">Simpan Perubahan</button>
            </div>
        </section>
    </form>
</body>
</html>

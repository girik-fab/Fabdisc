<?php
  include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
?>
<!DOCTYPE html>
<html>
<head>
  <title>CRUD Produk dengan Gambar - Gilacoding</title>
  <style type="text/css">
    * {
      font-family: "Trebuchet MS", sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: #f4f6f9;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .form-container {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      width: 400px;
    }

    .form-container h1 {
      text-align: center;
      text-transform: uppercase;
      color: #333;
      margin-bottom: 25px;
    }

    .form-container label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      color: #555;
    }

    .form-container input[type="text"],
    .form-container input[type="number"],
    .form-container input[type="file"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
      transition: border 0.3s ease;
    }

    .form-container input[type="text"]:focus,
    .form-container input[type="number"]:focus {
      border-color: #336B6B;
      outline: none;
    }

    .form-container button {
      width: 100%;
      padding: 12px;
      background-color: #336B6B;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      transition: background-color 0.3s ease;
    }

    .form-container button:hover {
      background-color: #224B4B;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h1>Tambah Produk</h1>
    <form method="POST" action="proses-tambah.php" enctype="multipart/form-data">
      <div>
        <label>Nama Produk</label>
        <input type="text" name="nama_barang" autofocus required />
      </div>
      <div>
        <label>Deskripsi</label>
        <input type="text" name="deskripsi_barang" />
      </div>
      <div>
        <label>Harga Barang</label>
        <input type="text" name="harga_barang" required />
      </div>
      <div>
        <label>Gambar Produk</label>
        <input type="file" name="gambar_barang" required />
      </div>
      <div>
        <label for="persentase_diskon">Persentase Diskon (%)</label>
        <input type="number" name="persentase_diskon" id="persentase_diskon" min="0" max="100" />
      </div>
      <div>
        <button type="submit">Simpan Produk</button>
      </div>
    </form>
  </div>

</body>
</html>

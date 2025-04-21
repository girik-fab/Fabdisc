<?php
session_start();

  include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include

// Check if the user is logged in, if not then redirect them to the login page
if (empty($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>ADMIN</title>
    <style type="text/css">
      * {
        font-family: "Trebuchet MS";
      }
      h1 {
        text-transform: uppercase;
        color: black;
        margin-left: 255px;
      }
    table {
      border: solid 1px #DDEEEE;
      border-collapse: collapse;
      border-spacing: 0;
      width: 70%;
      margin: 10px auto 10px auto;
    }
    table thead th {
        background-color: #DDEFEF;
        border: solid 1px #DDEEEE;
        color: #336B6B;
        padding: 10px;
        text-align: left;
        text-shadow: 1px 1px 1px #fff;
        text-decoration: none;
    }
    table tbody td {
        border: solid 1px #DDEEEE;
        color: #333;
        padding: 10px;
        text-shadow: 1px 1px 1px #fff;
    }
    a {
          background-color: black;
          color: #fff;
          padding: 10px;
          text-decoration: none;
          font-size: 12px;
    }
    </style>
  </head>
  <body>
    <h1>Data Produk</h1>
    <a href="addbarang.php" style="
          margin-left: 255px;
    ">+ &nbsp; Tambah Produk</a>
    <br/>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Produk</th>
          <th>Dekripsi</th>
          <th>Harga</th>
          <th>Diskon</th>
          <th>Harga Setelah Diskon</th>
          <th>Gambar</th>
        </tr>
    </thead>
    <tbody>

      <?php
      // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
      $query = "SELECT b.*, d.harga_setelah_diskon, d.diskon
FROM tb_barang b
JOIN tb_diskon d ON b.id_diskon = d.id_diskon;";
            $result = mysqli_query($koneksi, $query);

      //mengecek apakah ada error ketika menjalankan query
      if(!$result){
        die ("Query Error: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
      }

      //buat perulangan untuk element tabel dari data mahasiswa
      $no = 1; //variabel untuk membuat nomor urut
      // hasil query akan disimpan dalam variabel $data dalam bentuk array
      // kemudian dicetak dengan perulangan while
      while($row = mysqli_fetch_assoc($result))
      {
      ?>
       <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['nama_barang']; ?></td>
          <td><?php echo substr($row['deskripsi_barang'], 0, 20); ?>...</td>
          <td>Rp <?php echo number_format($row['harga_barang'],0,',','.'); ?></td>
          <td><?php echo htmlspecialchars($row['diskon']); ?>%</td>
          <td>Rp <?php echo number_format($row['harga_setelah_diskon'], 0, ',', '.'); ?></td>
          <td style="text-align: center;"><img src="gambar/<?php echo $row['gambar_barang']; ?>" style="width:120px;"></td>
          <td>
              <a href="editproduk.php?id=<?php echo $row['id_barang']; ?>">Edit</a> |
              <a href="proses-hapus.php?id=<?php echo $row['id_barang']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
          </td>
      </tr>
         
      <?php
        $no++; //untuk nomor urut terus bertambah 1
      }
      ?>
    </tbody>
    </table>
    <br>
        <a href="logout.php" style="margin-left: 255PX;">Logout</a>

  </body>
</html>

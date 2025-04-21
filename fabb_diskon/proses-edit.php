<?php
// Memanggil file conn.php untuk melakukan conn database
include 'koneksi.php';

// Membuat variabel untuk menampung data dari form
$id = $_POST['id'];
$id_diskon = $_POST['id_diskon'];
$nama_produk = $_POST['nama_barang'];
$deskripsi_barang = $_POST['deskripsi_barang'];
$harga_barang = $_POST['harga_barang'];
$persentase_diskon = isset($_POST['persentase_diskon']) ? $_POST['persentase_diskon'] : 0;
$potongan_diskon = $harga_barang * ($persentase_diskon / 100);
$harga_setelah_diskon = $harga_barang - $potongan_diskon;
$gambar_barang = $_FILES['gambar_barang']['name'];

// Cek apakah gambar produk diubah atau tidak
if ($gambar_barang != "") {
    // Ekstensi file yang diperbolehkan
    $ekstensi_diperbolehkan = array('png', 'jpg');
    $x = explode('.', $gambar_barang); // Memisahkan nama file dengan ekstensi
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_barang']['tmp_name'];
    $nama_gambar_baru = $gambar_barang; // Nama gambar baru

    // Cek apakah ekstensi file gambar diperbolehkan
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        // Pindahkan file gambar ke folder gambar
        move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru);

        $query = "UPDATE tb_barang SET nama_barang = '$nama_produk', deskripsi_barang = '$deskripsi_barang', harga_barang = '$harga_barang', gambar_barang = '$gambar_barang' WHERE id_barang = '$id'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
        }
    } else {
        // Jika ekstensi file tidak diperbolehkan
        echo "<script>alert('Ekstensi gambar yang diperbolehkan hanya jpg atau png.');window.location='edit_produk.php?id=$id';</script>";
    }
} else {
    // Jika gambar tidak diubah, jalankan query update tanpa gambar
    $query = "UPDATE tb_barang SET nama_barang = '$nama_produk', deskripsi_barang = '$deskripsi_barang', harga_barang = '$harga_barang' WHERE id_barang = '$id'";
    $result = mysqli_query($conn, $query);

}

// Update diskon produk jika ada perubahan
$query_diskon = "UPDATE tb_diskon SET diskon = '$persentase_diskon', harga_setelah_diskon = '$harga_setelah_diskon' WHERE id_diskon = '$id_diskon'";

if (mysqli_query($conn, $query_diskon)) {
    echo "<script>alert('Data berhasil diubah.');window.location='dashboard.php';</script>";
} else {
    die("Query gagal dijalankan untuk update diskon: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
}
?>

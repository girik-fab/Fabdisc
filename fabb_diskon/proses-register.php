    <?php
    session_start();
    include 'koneksi.php'; // pastikan koneksi pakai variabel $conn

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];


        // Validasi: Cek jika password dan konfirmasi tidak sama
        if ($password !== $confirm_password) {
            echo "<script>alert('Konfirmasi password tidak cocok.');window.history.back();</script>";
            exit();
        }

        // Cek apakah username sudah digunakan
        $cek = mysqli_query($conn, "SELECT * FROM usser WHERE username = '$username'");
        if (mysqli_num_rows($cek) > 0) {
            echo "<script>alert('Username sudah digunakan.');window.history.back();</script>";
            exit();
        }

        // Simpan ke database (default role: user)
        $insert = mysqli_query($conn, "INSERT INTO usser (username, password, role) VALUES ('$username', '$confirm_password', 'user')");

        if ($insert) {
            echo "<script>alert('Registrasi berhasil! Silakan login.');window.location='login.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat registrasi.');window.history.back();</script>";
        }
    }
    ?>

<?php
session_start();
include 'koneksi.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Gunakan prepared statement
    $stmt = $conn->prepare("SELECT * FROM usser WHERE username = ?");
    if (!$stmt) {
        die("Query error: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek user
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($password == $user['password']) {
            $_SESSION['username'] = $username;
            $_SESSION['id_pelanggan'] = $user['id'];

            if ($user['role'] == 'admin') {
                header("Location: dashboard.php");
                exit();
            } else {
                header("Location: home.php");
                exit();
            }
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Login gagal. Cek username dan password.";
    }
}
?>

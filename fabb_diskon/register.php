<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="form-box active">
      <h2>Registrasi</h2>
      <form action="proses-register.php" method="POST">
        <label for="username_reg">Username:</label>
        <input type="text" id="username_reg" name="username" required>

        <label for="password_reg">Password:</label>
        <input type="password" id="password_reg" name="password" required>

        <label for="confirm_password">Konfirmasi Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type="submit" name="register">Daftar</button>
      </form>
      <div class="toggle-link">
        Sudah punya akun? <a href="login.php">Login di sini</a>
      </div>
    </div>
  </div>
</body>
</html>

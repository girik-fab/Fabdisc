<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="form-box active">
      <h2>Login</h2>
      <form action="proses-login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="login">Login</button>
      </form>
      <div class="toggle-link">
        Belum punya akun? <a href="register.php">Daftar di sini</a>
      </div>
    </div>
  </div>
</body>
</html>

<?php
include 'config.php';
session_start();

if (isset($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password  = $_POST['password'];


  $result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");

  // Cek username
  if (mysqli_num_rows($result) === 1) {
    // Cek password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {

      // Set Session
      $_SESSION['login'] = true;


      header("Location: admin/index.php");
      exit;
    }
  }

  $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>

<body>

  <?php include './templete/header.php'; ?>
  <div class="login">
    <h1>Login</h1>
    <?php if (isset($error)) : ?>
      <p style="color:red;">Password dosent match</p>
    <?php endif; ?>
    <form action="" method='POST'>

      <input type="text" id="username" name="username" required autocomplete="off" placeholder="Username"><br><br>


      <input type="password" id='password' name="password" autocomplete="off" placeholder="Password"><br><br>

      <button type="submit" name="login" class="btn-login">Login</button>

      <input type="checkbox" name="rememberme" id="rememberme">
      <label for="rememberme" class="remember-me">Remember Me</label>

    </form>
    <p> belaum punya akun?<a href="daftar.php">Daftar</a></p>
  </div>
  <?php include './templete/footer.php'; ?>
</body>

</html>
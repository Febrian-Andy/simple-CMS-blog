<?php
include 'config.php';
if (isset($_POST['signup'])) {

  if (signup($_POST) > 0) {
    echo "<script>
            alert('user baru berhasil ditambahkan');
          </script>";
    header("Location: index.php");
  } else {
    echo mysqli_error($db);
  }
}
?>

<?php include './templete/header.php'; ?>



<div class="login">
  <h1> Signup</h1>

  <form action="" method='POST'>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required autocomplete="off"><br><br>



    <label for="password">Password:</label>
    <input type="password" id='password' name="password" autocomplete="off" minlength="8"><br><br>

    <label for="password2">Confirm password:</label>
    <input type="password" id='password2' name="password2" autocomplete="off" minlength="8"><br><br>

    <button type="submit" name="signup">Daftar</button>
  </form>
</div>

<?php include './templete/footer.php'; ?>
<?php include('../config/constants.php'); ?>

<html>

<head>
  <title>Login - Food Order System</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

  <div class="login">
    <h3>Login</h3>

    <?php
    session_start();
    if (isset($_SESSION['login'])) {
      echo $_SESSION['login'];
      unset($_SESSION['login']);
    }

    if (isset($_SESSION['no-login-message'])) {
      echo $_SESSION['no-login-message'];
      unset($_SESSION['no-login-message']);
    }
    ?>

    <!-- Login Form Starts HEre -->
    <form action="" method="POST">
      <div>
        <label for="username">
          Username:
        </label>
        <input id="username" type="text" name="username" placeholder="Enter Username">
      </div>
      <div>
        <label for="password">
          Password:
        </label>
        <input id="password" type="password" name="password" placeholder="Enter Password">
      </div>

      <input type="submit" name="submit" value="Login" class="btn btn-primary">
    </form>

  </div>

</body>

</html>

<?php

if (isset($_POST['submit'])) {

  $username = mysqli_real_escape_string($conn, $_POST['username']);

  $raw_password = md5($_POST['password']);
  $password = mysqli_real_escape_string($conn, $raw_password);

  $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";

  $res = mysqli_query($conn, $sql);

  $count = mysqli_num_rows($res);

  if ($count == 1) {
    $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
    // to use it in other pages and to logout using it
    $_SESSION['user'] = $username;
    header('location: ../admin/');
  } else {
    $_SESSION['login'] = "<div class='error'>Username or Password did not match.</div>";
    header('location:./login.php');
  }
}

?>
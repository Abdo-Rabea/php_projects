<?php
include "../models/Dbh.php";
include "../models/UserModel.php";
include "../controllers/UserController.php";
if (isset($_POST)) {
  ['email' => $email, 'pwd' => $pwd] = $_POST;
  $userCont = new UserController('', $email, $pwd, ''); // temp.
  $userCont->login();

  // you are here so everything is fine as you don't throw any error (change the header)
  header("Location: ../index.php");
  exit();
}

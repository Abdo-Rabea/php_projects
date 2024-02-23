<?php
include "../models/Dbh.php";
include "../models/UserModel.php";
include "../controllers/UserController.php";
if (isset($_POST)) {
  // destructuring
  ['username' => $username, 'email' => $email, 'pwd' => $pwd, 'confpwd' => $confpwd] = $_POST;

  // register user
  $userCont = new UserController($username, $email, $pwd, $confpwd);
  $userCont->register();

  //redirect if all is fine
  header("Location: ../views/user/login.php");
  exit();
}

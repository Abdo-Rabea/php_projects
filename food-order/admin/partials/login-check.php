<?php

//AUthorization - Access COntrol
session_start();
if (!isset($_SESSION['user'])) {

  $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
  header('location: http://localhost/php_projects/food-order/admin/login.php');
}

<?php
include('../config/constants.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) {
  $id = $_GET['id'];
  $image_name = $_GET['image_name'];

  // delete uploaded image
  if ($image_name != "") {
    $path = "../images/food/" . $image_name;
    $remove = unlink($path);
    if ($remove == false) {
      $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
      header('location:./manage-food.php');
      die();
    }
  }

  $sql = "DELETE FROM food WHERE id=$id";
  include("../config/constants.php");
  $res = mysqli_query($conn, $sql);

  if ($res == true)
    $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
  else
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
} else {
  $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
}
header('location:./manage-food.php');
exit();

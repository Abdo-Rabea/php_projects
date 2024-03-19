<?php
if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $sql = "DELETE FROM admin WHERE id=$id";

  include('../config/constants.php');
  $res = mysqli_query($conn, $sql);

  session_start();
  if ($res == true)
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
  else
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin.</div>";

  header('location: ./manage-admin.php');
}

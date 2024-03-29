<?php


if (isset($_GET['id']) and isset($_GET['image_name'])) {
  $id = $_GET['id'];
  $image_name = $_GET['image_name'];

  // remove image.jpg
  if ($image_name != "") {
    $path = "../images/category/" . $image_name;
    $remove = unlink($path);

    // can't remove stored image
    if ($remove == false) {
      $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
      header('location:./manage-category.php');
      exit();
    }
  }

  // remove category from db
  $sql = "DELETE FROM category WHERE id=$id";
  include('../config/constants.php');
  $res = mysqli_query($conn, $sql);
  if ($res == true)
    $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
  else
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
}
header('location:./manage-category.php');
exit();

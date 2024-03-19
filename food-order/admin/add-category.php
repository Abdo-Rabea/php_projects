<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Category</h1>
    <?php

    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }

    if (isset($_SESSION['upload'])) {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }

    ?>


    <form action="" method="POST" enctype="multipart/form-data">
      <div>
        <label>Title: </label>
        <input type="text" name="title" placeholder="Category Title">
      </div>

      <div>
        <label>Select Image: </label>
        <input type="file" name="image">
      </div>

      <div>
        <label for="">Featured</label>
        <input type="radio" name="featured" value="Yes"> Yes
        <input type="radio" name="featured" value="No"> No
      </div>
      <div>
        <label>Active: </label>
        <input type="radio" name="active" value="Yes"> Yes
        <input type="radio" name="active" value="No"> No
      </div>

      <input type="submit" name="submit" value="Add Category" class="btn btn-secondary">
    </form>

    <?php


    if (isset($_POST['submit'])) {

      ['title' => $title, 'featured' => $featured, 'active' => $active] = $_POST;

      if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {
          $ext = end(explode('.', $image_name));

          $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;
          $source_path = $_FILES['image']['tmp_name'];

          $destination_path = "../images/category/" . $image_name;
          $upload = move_uploaded_file($source_path, $destination_path);
          if ($upload == false) {
            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
            header('location: ./add-category.php');
            exit();
          }
        }
      } else {
        $image_name = "";
      }

      // sql prepare
      $sql = "INSERT INTO category SET title='$title', image_name='$image_name', featured='$featured', active='$active'";

      include_once("../config/constants.php");
      $res = mysqli_query($conn, $sql);

      if ($res == true) {
        $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
      } else {
        $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
      }
      header('location:./manage-category.php');
    }

    ?>

  </div>
</div>

<?php include('partials/footer.php'); ?>
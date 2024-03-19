<?php include('partials/menu.php'); ?>

<?php
if (!isset($_GET['id']))
  header('location: ./manage-food.php');

$id = $_GET['id'];
$sql2 = "SELECT * FROM food WHERE id=$id";
include("../config/constants.php");
$res2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($res2);
['title' => $title, 'description' => $description, 'price' => $price, 'image_name' => $current_image, 'category_id' => $current_category, 'featured' => $featured, 'active' => $active] = $row2;
?>


<div class="main-content">
  <div class="wrapper">
    <h3>Update Food</h3>
    <form action="" method="POST" enctype="multipart/form-data" style="height: 400px;">
      <div>
        <label>Title: </label>
        <input type="text" name="title" value="<?= $title; ?>">
      </div>

      <div>
        <label>Description: </label>
        <textarea name="description" cols="30" rows="5"><?= $description; ?></textarea>
      </div>

      <div>
        <label>Price: </label>
        <input type="number" name="price" value="<?= $price; ?>">
      </div>

      <div>
        <label>Current Image: </label>
        <?php
        if ($current_image == "") {
          echo "<div class='error'>Image not Available.</div>";
        } else {
        ?>
          <img src="../images/food/<?= $current_image; ?>" width="150px">
        <?php
        }
        ?>
      </div>

      <div>
        <label>Select New Image: </label>
        <input type="file" name="image">
      </div>

      <div>
        <label>Category: </label>
        <select name="category">

          <?php
          $sql = "SELECT * FROM category WHERE active='Yes'";

          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
          if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
              $category_title = $row['title'];
              $category_id = $row['id'];
          ?>
              <option <?php if ($current_category == $category_id) {
                        echo "selected";
                      } ?> value="<?= $category_id; ?>"><?= $category_title; ?></option>
          <?php
            }
          } else {
            echo "<option value='0'>Category Not Available.</option>";
          }

          ?>
        </select>
      </div>

      <div>
        <label>Featured: </label>
        <input <?php if ($featured == "Yes") {
                  echo "checked";
                } ?> type="radio" name="featured" value="Yes"> Yes
        <input <?php if ($featured == "No") {
                  echo "checked";
                } ?> type="radio" name="featured" value="No"> No
      </div>

      <div>
        <label>Active: </label>
        <input <?php if ($active == "Yes") {
                  echo "checked";
                } ?> type="radio" name="active" value="Yes"> Yes
        <input <?php if ($active == "No") {
                  echo "checked";
                } ?> type="radio" name="active" value="No"> No
      </div>

      <input type="hidden" name="id" value="<?= $id; ?>">
      <input type="hidden" name="current_image" value="<?= $current_image; ?>">
      <input type="submit" name="submit" value="Update Food" class="btn btn-secondary">
    </form>

    <?php

    if (isset($_POST['submit'])) {

      $id = $_POST['id'];
      $title = $_POST['title'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $current_image = $_POST['current_image'];
      $category = $_POST['category'];
      $featured = $_POST['featured'];
      $active = $_POST['active'];

      if (isset($_FILES['image']['name'])) {

        $image_name = $_FILES['image']['name'];
        if ($image_name != "") {

          $ext = end(explode('.', $image_name));
          $image_name = "Food-Name-" . rand(0000, 9999) . '.' . $ext;
          $src_path = $_FILES['image']['tmp_name'];
          $dest_path = "../images/food/" . $image_name;
          $upload = move_uploaded_file($src_path, $dest_path);


          if ($upload == false) {
            $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
            header('location:./manage-food.php');
            exit();
          }

          if ($current_image != "") {
            $remove_path = "../images/food/" . $current_image;
            $remove = unlink($remove_path);
            if ($remove == false) {
              $_SESSION['remove-failed'] = "<div class='error'>Faile to remove current image.</div>";
              header('location:./manage-food.php');
              die();
            }
          }
        } else {
          $image_name = $current_image;
        }
      } else {
        $image_name = $current_image;
      }

      // here every thing is ok so update the db
      $sql3 = "UPDATE food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

      $res3 = mysqli_query($conn, $sql3);
      if ($res3 == true)
        $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
      else
        $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
      header('location:./manage-food.php');
    }
    ?>
  </div>
</div>

<?php include('partials/footer.php'); ?>
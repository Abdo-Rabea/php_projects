<?php include('./partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h3>Add Food</h3>
    <?php
    if (isset($_SESSION['upload'])) {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }
    ?>

    <form action="" method="POST" enctype="multipart/form-data" style="height: 300px;">

      <div>
        <label>Title: </label>
        <input type="text" name="title" placeholder="Title of the Food">
      </div>

      <div>
        <label>Description: </label>
        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
      </div>

      <div>
        <label>Price: </label>
        <input type="number" name="price">
      </div>

      <div>
        <label>Select Image: </label>
        <input type="file" name="image">
      </div>

      <div>
        <label>Category: </label>
        <select name="category">

          <?php
          $sql = "SELECT * FROM category WHERE active='Yes'";
          include("../config/constants.php");
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
          if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
              $id = $row['id'];
              $title = $row['title'];
          ?>
              <option value="<?= $id; ?>"><?= $title; ?></option>
            <?php
            }
          } else {
            //there are no categories
            ?>
            <option value="0">No Category Found</option>
          <?php
          }
          ?>
        </select>

      </div>

      <div>
        <label>Featured: </label>
        <input type="radio" name="featured" value="Yes"> Yes
        <input type="radio" name="featured" value="No"> No
      </div>

      <div>
        <label>Active: </label>
        <input type="radio" name="active" value="Yes"> Yes
        <input type="radio" name="active" value="No"> No
      </div>

      <input type="submit" name="submit" value="Add Food" class="btn btn-secondary">
    </form>
    <?php

    if (isset($_POST['submit'])) {
      $title = $_POST['title'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $category = $_POST['category'];
      $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
      $active = isset($_POST['active']) ? $_POST['active'] : "No";

      if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {
          // uploading image
          $ext = end(explode('.', $image_name));
          $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext;
          $src = $_FILES['image']['tmp_name'];
          $dst = "../images/food/" . $image_name;
          $upload = move_uploaded_file($src, $dst);

          if ($upload == false) {
            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
            header('location: ./add-food.php');
            exit();
          }
        }
      } else {
        $image_name = "";
      }

      $sql2 = "INSERT INTO food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

      $res2 = mysqli_query($conn, $sql2);

      if ($res2 == true)
        $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
      else
        $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
      header('location:./manage-food.php');
    }
    ?>
  </div>
</div>

<?php include('./partials/footer.php'); ?>
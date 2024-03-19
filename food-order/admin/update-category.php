<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Category</h1>

    <?php
    if (isset($_GET['id'])) {

      $id = $_GET['id'];
      $sql = "SELECT * FROM category WHERE id=$id";

      include("../config/constants.php");
      $res = mysqli_query($conn, $sql);

      $count = mysqli_num_rows($res);

      if ($count == 1) {
        //Get all the data 
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
      } else {
        // no category found
        $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
        header('location:./manage-category.php');
      }
    } else {
      // no get method
      header('location:./manage-category.php');
    }

    ?>

    <form action="" method="POST" enctype="multipart/form-data">

      <div>
        <label>Title: </label>
        <input type="text" name="title" value="<?php echo $title; ?>">
      </div>

      <div>
        <label>Current Image: </label>
        <?php
        if ($current_image != "") {
        ?>
          <img src="../images/category/<?= $current_image; ?>" width="50px">
        <?php
        } else {
          echo "<div class='error'>Image Not Added.</div>";
        }
        ?>
      </div>

      <div>
        <label>New Image: </label>
        <input type="file" name="image">
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

      <div>
        <input type="hidden" name="current_image" value="<?= $current_image; ?>">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="submit" name="submit" value="Update Category" class="btn btn-secondary">
      </div>


    </form>

    <?php

    if (isset($_POST['submit'])) {

      $id = $_POST['id'];
      $title = $_POST['title'];
      $current_image = $_POST['current_image'];
      $featured = $_POST['featured'];
      $active = $_POST['active'];

      // is the image selected
      if (isset($_FILES['image']['name'])) {

        $image_name = $_FILES['image']['name'];
        // if there is image
        if ($image_name != "") {
          // there is image uploaded so get the extention 
          $ext = end(explode('.', $image_name));

          //Rename the Image
          $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext; // e.g. Food_Category_834.jpg

          // upload the image to server
          $source_path = $_FILES['image']['tmp_name'];
          $destination_path = "../images/category/" . $image_name;
          $upload = move_uploaded_file($source_path, $destination_path);

          // check if the image is not uploaded
          if ($upload == false) {
            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
            header('location:./manage-category.php');
            exit();
          }

          // every thing is ok so remove the old image
          if ($current_image != "") {
            $remove_path = "../images/category/" . $current_image;
            $remove = unlink($remove_path);

            // if the image is not removed
            if ($remove == false) {
              //Failed to remove image
              $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
              header('location:./manage-category.php');
              exit();
            }
          }
        } else {
          $image_name = $current_image;
        }
      } else {
        $image_name = $current_image;
      }

      // every thing is good so you just to put the data in db
      $sql2 = "UPDATE category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id=$id
                ";

      $res2 = mysqli_query($conn, $sql2);
      if ($res2 == true) {
        $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
        header('location:./manage-category.php');
      } else {

        $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
        header('location:./manage-category.php');
      }
    }

    ?>

  </div>
</div>

<?php include('partials/footer.php'); ?>
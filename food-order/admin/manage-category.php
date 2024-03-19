<?php include "./partials/menu.php" ?>

<div class="main-content">
  <div class="wrapper">
    <h3>
      Manage Category
    </h3>
    <?php

    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }

    if (isset($_SESSION['remove'])) {
      echo $_SESSION['remove'];
      unset($_SESSION['remove']);
    }

    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }

    if (isset($_SESSION['no-category-found'])) {
      echo $_SESSION['no-category-found'];
      unset($_SESSION['no-category-found']);
    }

    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }

    if (isset($_SESSION['upload'])) {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }

    if (isset($_SESSION['failed-remove'])) {
      echo $_SESSION['failed-remove'];
      unset($_SESSION['failed-remove']);
    }

    ?>
    <a href="./add-category.php" class="btn btn-primary">Add Category</a>
    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>

      <?php
      $sql = "SELECT * FROM category";

      include("../config/constants.php");
      $res = mysqli_query($conn, $sql);

      $count = mysqli_num_rows($res);
      $sn = 1;
      if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
          $id = $row['id'];
          $title = $row['title'];
          $image_name = $row['image_name'];
          $featured = $row['featured'];
          $active = $row['active'];

      ?>

          <tr>
            <td><?= $sn++; ?>. </td>
            <td><?= $title; ?></td>
            <td>

              <?php
              if ($image_name != "") {
              ?>
                <img src="../images/category/<?= $image_name; ?>" width="100px">
              <?php
              } else {
                echo "<div class='error'>Image not Added.</div>";
              }
              ?>
            </td>
            <td><?= $featured; ?></td>
            <td><?= $active; ?></td>
            <td>
              <a href="./update-category.php?id=<?= $id; ?>" class="btn btn-secondary">Update Category</a>
              <!-- pass the name of image to remove it -->
              <a href="./delete-category.php?id=<?= $id; ?>&image_name=<?= $image_name; ?>" class="btn btn-danger">Delete Category</a>
            </td>
          </tr>

        <?php

        }
      } else {
        // there is no categories
        ?>
        <tr>
          <td colspan="6">
            <div class="error">No Category Added.</div>
          </td>
        </tr>
      <?php
      }
      ?>
    </table>
  </div>
</div>
<?php include "./partials/footer.php" ?>
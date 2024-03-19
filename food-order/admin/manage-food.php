<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h3>Manage Food</h3>

    <a href="./add-food.php" class="btn btn-primary">Add Food</a>
    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }

    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }

    if (isset($_SESSION['upload'])) {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }

    if (isset($_SESSION['unauthorize'])) {
      echo $_SESSION['unauthorize'];
      unset($_SESSION['unauthorize']);
    }

    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }

    ?>

    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>

      <?php
      $sql = "SELECT * FROM food";
      include("../config/constants.php");
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);
      $sn = 1;

      if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
          $id = $row['id'];
          $title = $row['title'];
          $price = $row['price'];
          $image_name = $row['image_name'];
          $featured = $row['featured'];
          $active = $row['active'];
      ?>

          <tr>
            <td><?php echo $sn++; ?>. </td>
            <td><?php echo $title; ?></td>
            <td>$<?php echo $price; ?></td>
            <td>
              <?php
              if ($image_name == "") {
                echo "<div class='error'>Image not Added.</div>";
              } else {
              ?>
                <img src="../images/food/<?= $image_name; ?>" width="100px">
              <?php
              }
              ?>
            </td>
            <td><?php echo $featured; ?></td>
            <td><?php echo $active; ?></td>
            <td>
              <a href="./update-food.php?id=<?= $id; ?>" class="btn btn-secondary">Update Food</a>
              <a href="./delete-food.php?id=<?= $id; ?>&image_name=<?= $image_name; ?>" class="btn btn-danger">Delete Food</a>
            </td>
          </tr>

      <?php
        }
      } else {
        //Food not Added in Database
        echo "<tr> <td colspan='7' class='error'> Food not Added Yet. </td> </tr>";
      }

      ?>


    </table>
  </div>

</div>

<?php include('partials/footer.php'); ?>
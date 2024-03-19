<?php include "./partials/menu.php";
?>

<div class="main-content">
  <div class="wrapper">
    <h3>
      Manage Admin
    </h3>
    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add']; //Displaying Session Message
      unset($_SESSION['add']); //REmoving Session Message
    }

    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }

    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }

    if (isset($_SESSION['user-not-found'])) {
      echo $_SESSION['user-not-found'];
      unset($_SESSION['user-not-found']);
    }

    if (isset($_SESSION['pwd-not-match'])) {
      echo $_SESSION['pwd-not-match'];
      unset($_SESSION['pwd-not-match']);
    }

    if (isset($_SESSION['change-pwd'])) {
      echo $_SESSION['change-pwd'];
      unset($_SESSION['change-pwd']);
    }

    ?>
    <a href="add-admin.php" class="btn btn-primary">Add Admin</a>
    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Full Name</th>
        <th>userName</th>
        <th>Actions</th>
      </tr>

      <?php
      //Query to Get all Admin
      $sql = "SELECT * FROM admin";
      //Execute the Query
      require_once("../config/constants.php");

      $res = mysqli_query($conn, $sql);

      if ($res == TRUE) {
        $sn = 1;
        while ($rows = mysqli_fetch_assoc($res)) {

          $id = $rows['id'];
          $full_name = $rows['full_name'];
          $username = $rows['username'];
      ?>

          <tr>
            <td><?= $sn++; ?>. </td>
            <td><?= $full_name; ?></td>
            <td><?= $username; ?></td>
            <td>
              <a href="./update-password.php?id=<?= $id ?>" class="btn btn-primary">Change Password</a>
              <a href="./update-admin.php?id=<?= $id ?>" class="btn btn-secondary">Update Admin</a>
              <a href="./delete-admin.php?id=<?= $id ?>" class="btn btn-danger">Delete Admin</a>
            </td>
          </tr>

      <?php

        }
      }

      ?>



    </table>
  </div>
</div>
<?php include "./partials/footer.php" ?>
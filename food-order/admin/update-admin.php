<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h3>Update Admin</h3>
    <?php
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql = "SELECT * FROM admin WHERE id=$id";
      require_once("../config/constants.php");
      $res = mysqli_query($conn, $sql);

      if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
          $row = mysqli_fetch_assoc($res);
          $full_name = $row['full_name'];
          $username = $row['username'];
        } else {
          //Redirect to Manage Admin PAge
          header('location: ./manage-admin.php');
        }
      }
    }
    ?>


    <form action="" method="POST">
      <div>
        <label for="full_name">Full Name: </label>
        <input type="text" name="full_name" value="<?= $full_name; ?>">
      </div>

      <div>
        <label for="username">username:</label>
        <input type="text" name="username" value="<?= $username; ?>">
      </div>

      <input type="hidden" name="id" value="<?= $id; ?>">
      <input type="submit" name="submit" value="Update Admin" class="btn btn-secondary">

    </form>
  </div>
</div>

<?php

if (isset($_POST['submit'])) {
  $id = $_POST['id'];
  $full_name = $_POST['full_name'];
  $username = $_POST['username'];

  $sql = "UPDATE admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id='$id'
        ";

  $res = mysqli_query($conn, $sql);

  session_start();
  if ($res == true)
    $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
  else
    $_SESSION['update'] = "<div class='error'>Failed to Delete Admin.</div>";
  // redirect to manage admin
  header('location:./manage-admin.php');
}

?>


<?php include('partials/footer.php'); ?>
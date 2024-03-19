<?php include "./partials/menu.php";
if (isset($_GET['id'])) {
  $id = $_GET['id'];
}
?>
<div class="main-content">
  <div class="wrapper">
    <h3>
      Update password
    </h3>
    <form action="#" method="POST">
      <div>
        <label for="current_password">current password</label>
        <input id="current_password" type="password" name="current_password" placeholder="Current Password">
      </div>
      <div>

        <label for="new_password">new password</label>
        <input id="new_password" type="password" name="new_password" placeholder="New Password">
      </div>
      <div>
        <label for="confirm_password">confirm password</label>
        <input id="confirm_password" type="password" name="confirm_password" placeholder="Confirm Password">
      </div>
      <input type="hidden" name="id" value="<?= $id; ?>">
      <input type="submit" name="submit" value="Change Password" class="btn btn-secondary">

    </form>
  </div>
</div>
<?php

if (isset($_POST['submit'])) {

  $id = $_POST['id'];
  $current_password = md5($_POST['current_password']);
  $new_password = md5($_POST['new_password']);
  $confirm_password = md5($_POST['confirm_password']);

  $sql = "SELECT * FROM `admin` where `id` = '$id' and `password` = '$current_password'";
  require_once("../config/constants.php");
  $res = mysqli_query($conn, $sql);
  session_start();
  if ($res == true) {
    //CHeck whether data is available or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {

      if ($new_password == $confirm_password) {
        $sql2 = "UPDATE admin SET 
                                password='$new_password' 
                                where id=$id
                            ";

        $res2 = mysqli_query($conn, $sql2);

        //CHeck whether the query exeuted or not

        if ($res2 == true) {

          $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
        } else {

          $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
        }
      } else {
        $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not match. </div>";
      }
    } else {
      $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
    }
  }
  header('location:./manage-admin.php');
}

?>

<?php include "./partials/footer.php" ?>
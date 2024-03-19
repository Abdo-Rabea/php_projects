<?php
if (isset($_POST["submit"])) {
  // get data from form
  ['full_name' => $fullName, 'username' => $username, 'pwd' => $password] = $_POST;
  $password = md5($password);
  // sql query
  $sql = "INSERT INTO `admin`(`full_name`, `username`, `password`) VALUES ('$fullName','$username','$password')";

  // connect to query
  require_once("../config/constants.php");
  $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if ($res === true) {
    header("Location: ./manage-admin.php");
  } else {
    echo ("<div style='color: red'>faild to add admin</div>");
  }
}
?>
<?php include_once("./partials/menu.php") ?>
<div class="main-content">
  <div class="wrapper">
    <h3>
      Add Admin
    </h3>
    <form action="#" method="POST">
      <div>
        <label for="full-name">full name</label>
        <input type="text" id="full-name" name="full_name">
      </div>
      <div>

        <label for="username">username</label>
        <input type="text" id="username" name="username">
      </div>
      <div>
        <label for="password">pasword</label>
        <input type="password" id="password" name="pwd">
      </div>
      <input type="submit" name="submit" value="add" class="btn btn-primary">

    </form>
  </div>
</div>

<?php include_once("./partials/footer.php") ?>
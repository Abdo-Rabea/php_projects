<?php
// this file is inside include so pure php
include './autoloader.inc.php'; // it is just grab all sign up files (classes) here
if (isset($_POST['submit'])) {
    // grabbing the data
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    print_r($_POST);

    // instantiate sign up contrl.class
    $singup = new LoginContr($uid, $pwd);

    // validate and error handler and login user
    $singup->loginUser();

    // redirect to the front page
    // header("Location: ../index.php");
}

<?php
// this file is inside include so pure php
include './autoloader.inc.php'; // it is just grab all sign up files (classes) here
if (isset($_POST['submit'])) {
    // grabbing the data

    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwdrepeat = $_POST['pwdrepeat'];
    $email = $_POST['email'];
    // print_r($_POST);

    // instantiate sign up contrl.class
    $singup = new SignupContr($uid, $pwd, $pwdrepeat, $email);

    // validate and error handler and singup user
    $singup->signupUser();

    // redirect to the front page
    header("Location: ../index.php");
}

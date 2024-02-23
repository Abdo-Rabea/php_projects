<?php
// i don't have a way to get users from dashboard.inc.php ... think ...
include "./models/Dbh.php";
include "./models/UserModel.php";
include "./controllers/UserController.php";
$userCont = new UserController('', '', '', ''); // solve this issue dode
$users = $userCont->getallUsers();

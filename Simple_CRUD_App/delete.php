<?php
require "./users/users.php";
// I can use the header

// validate id exists
if (!isset($_GET["id"])) {
    include "./partial/not_found.php";
    exit;
}

deleteUser($_GET["id"]);
header('Location: index.php');
exit;

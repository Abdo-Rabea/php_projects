<?php
// connect to db
$conn = mysqli_connect("localhost", "root", "");
$db_select = mysqli_select_db($conn, "food-order") or die(mysqli_error($conn));

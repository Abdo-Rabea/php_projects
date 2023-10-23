<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_SESSION['uid'] ?></title>
</head>

<body>
    <div>
        <h1>Your are human <?= $_SESSION['uid'] ?></h1>
    </div>
</body>

</html>
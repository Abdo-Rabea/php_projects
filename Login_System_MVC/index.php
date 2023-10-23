<?php
session_start();
?>
<!-- there will be no copy paste in this project -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/master.css">
</head>

<body>
    <div class="navbar">
        <span class="logo">Abdo</span>
        <?php
        if (isset($_SESSION['uid'])) : ?>
            <span><?= $_SESSION['uid'] ?></span>
            <a href="./includes/logout.inc.php">Logout</a>
        <?php else : ?>
            <a href="">login</a>
        <?php endif ?>
    </div>
    <div class="login">
        <div class="container">
            <div class="forms">
                <div class="login-signup">
                    <h3>Sign up</h3>
                    <form action="includes/signup.inc.php" method="POST" novalidate>
                        <input type="text" name="uid" placeholder="Username">
                        <input type="password" name="pwd" placeholder="Password">
                        <input type="password" name="pwdrepeat" placeholder="Repeat Password">
                        <input type="email" name="email" placeholder="Email">
                        <input type="submit" name="submit" value="Sign up">
                    </form>
                </div>
                <div class="login-login">
                    <h3>login</h3>
                    <form action="includes/login.inc.php" method="POST">
                        <input type="text" name="uid" placeholder="Username">
                        <input type="password" name="pwd" placeholder="Password">
                        <input type="submit" name="submit" value="login">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php

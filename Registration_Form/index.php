<?php
define('REQUIRED_FIELD_ERROR', "This feald is required");
$formData = ['username' => '', 'email' => '', 'password' => '', 'password_confirm' => '', 'cv_url' => ''];
// your code is better than just $error=[] and check for isset()
$error = ['username' => '', 'email' => '', 'password' => '', 'password_confirm' => '', 'cv_url' => ''];
$isvalid = true;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // secure data and trim
    foreach ($formData as $name => $value)
        $formData[$name] = secure_data($_POST[$name]);

    // validate from empty string
    if (!$formData['username']) {
        $error['username'] = REQUIRED_FIELD_ERROR;
        $isvalid = false;
    } elseif (strlen($formData['username']) < 6 || strlen($formData['username']) > 16) {
        $error['username'] = 'username must be between range';
        $isvalid = false;
    }

    if (!$formData['email']) {
        $error['email'] = REQUIRED_FIELD_ERROR;
        $isvalid = false;
    } elseif (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'enter a valid email';
        $isvalid = false;
    }

    if (!$formData['password']) {
        $error['password'] = REQUIRED_FIELD_ERROR;
        $isvalid = false;
    }
    if (!$formData['password_confirm']) {
        $error['password_confirm'] = REQUIRED_FIELD_ERROR;
        $isvalid = false;
    }
    // validate match passwords
    if ($formData['password'] && $formData['password_confirm'] && strcmp($formData['password'], $formData['password_confirm']) !== 0) {
        $error['password_confirm'] = 'this must match password';
        $isvalid = false;
    }
    if ($formData['cv_url'] && !filter_var($formData['cv_url'], FILTER_VALIDATE_URL)) {
        $error['cv_url'] = 'input a vlid link';
        $isvalid = false;
    }
    if ($isvalid) {
        // save into db
        header('Location: save.php');
        exit;
    }
}


function secure_data($fieldValue)
{
    return htmlspecialchars(trim(stripslashes($fieldValue ?? '')));
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body style="padding: 50px;">

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" novalidate>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control <?= $error['username'] ? 'is-invalid' : '' ?>" name="username" value="<?= $formData['username'] ?>">
                    <!-- no need to check because bootstrap handle it in css .is-invalid~invalid-feedback {display:block} -->
                    <!-- and by default all .invalid-feedback is display none -->
                    <div class="invalid-feedback">
                        <?= $error['username'] ?>
                    </div>
                    <small class="form-text text-muted">Min: 6 and max 16 characters</small>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control <?= $error['email'] ? 'is-invalid' : '' ?>" name="email" value="<?= $formData['email'] ?>">
                    <div class="invalid-feedback">
                        <?= $error['email'] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control <?= $error['password'] ? 'is-invalid' : '' ?>" name="password" value="<?= $formData['password'] ?>">
                    <div class="invalid-feedback">
                        <?= $error['password'] ?>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Repeat Password</label>
                    <input type="password" class="form-control <?= $error['password_confirm'] ? 'is-invalid' : '' ?>" name="password_confirm" value="<?= $formData['password_confirm'] ?>">
                    <div class="invalid-feedback">
                        <?= $error['password_confirm'] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class=" form-group">
            <div class="form-group">
                <label>Your CV link</label>
                <input type="text" class="form-control <?= $error['cv_url'] ? 'is-invalid' : '' ?>" name="cv_url" placeholder="https://www.example.com/my-cv" value="<?= $formData["cv_url"] ?>" />
                <div class=" invalid-feedback">
                    <?= $error['cv_url'] ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Register</button>
        </div>
    </form>

</body>

</html>
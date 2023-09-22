<?php
require "./users/users.php";

// check name , username (>5 <20), email, phone
$error = [
    "name" => "",
    "username" => "",
    "email" => "",
    "phone" => "",
];
$user = [
    "name" => "",
    "username" => "",
    "email" => "",
    "phone" => "",
    "website" => ""
];
$isvalid = true;
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // validate
    // to not delete the values from form
    $user = array_merge($user, $_POST);
    $error = validateUser($user, $isvalid);
    if ($isvalid) {
        $id = createId();
        $data = ["id" => $id];
        $data = array_merge($data, $user);
        // upload image
        // add id and save this user in the json
        if (isset($_FILES['image']) && $_FILES['image']["name"] != "") {
            $extension = uploadImage($_FILES['image'], $id);
            $data = array_merge($data, ["extension" => $extension]);
        }

        createUser($data);
        header('Location: index.php');
        exit;
    }
}

include "./partial/header.php";
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Create new user</h3>
        </div>
        <?php include_once("./form.php") ?>
    </div>
</div>

<?php include "./partial/footer.php" ?>
<?php
require "./users/users.php";
// I can use the header
if (!isset($_GET["id"])) {
    include "./partial/not_found.php";
    exit;
}
$user = getUsersById($_GET["id"]);
if (!$user) {
    include "./partial/not_found.php";
    exit;
}
$error = [
    "name" => "",
    "username" => "",
    "email" => "",
    "phone" => "",
];
$isvalid = true;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $data = $_POST;
    $user = array_merge($user, $_POST);
    $error = validateUser($user, $isvalid);
    if ($isvalid) {
        // upload image
        if (isset($_FILES['image']) && $_FILES['image']["name"] != "") {
            $extension = uploadImage($_FILES['image'], $user['id']);
            $data = array_merge($data, ["extension" => $extension]);
        }
        // save the new data in the json
        updateUser($data, $user['id']);

        // // redirect to home page
        header('Location: index.php');
        exit;
    }
}

include "./partial/header.php";
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Update user: <span><?= $user["name"] ?></span></h3>
        </div>
        <?php include_once("./form.php") ?>
    </div>
</div>


<?php include "./partial/footer.php" ?>
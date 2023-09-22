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
include "./partial/header.php";

?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>View user: <span><?= $user["name"] ?></span></h3>
        </div>
        <div class="buttons">
            <a href="update.php?id=<?= $user["id"] ?>" class="button update">Update</a>
            <a href="delete.php?id=<?= $user["id"] ?>" class="button delete">Delete</a>
        </div>
        <table>
            <tbody>
                <tr>
                    <th>Name:</th>
                    <td><?= $user["name"] ?></td>
                </tr>
                <tr>
                    <th>Username:</th>
                    <td><?= $user["username"] ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?= $user["email"] ?></td>
                </tr>
                <tr>
                    <th>Phone:</th>
                    <td><?= $user["phone"] ?></td>
                </tr>
                <tr>
                    <th>Website:</th>
                    <td><a href="http://<?= $user["website"] ?>" target="_blank"><?= $user["website"] ?></a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<?php include "./partial/footer.php" ?>
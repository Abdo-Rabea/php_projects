<?php
clearstatcache();
require "users/users.php"; // why does this run function (not sense for me)
$users = getUsers();
// $users = getUsers();
// print_r($users);

include "./partial/header.php";
?>
<div class="container">
    <a href="create.php" class="button create">Create new user</a>

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($users)) :
                foreach ($users as $user) : ?>
                    <tr>
                        <td>
                            <?php if (isset($user['extension'])) : ?>
                                <img src=<?= "./users/images/$user[id].$user[extension]" ?> alt="image" style="width:80px">
                            <?php endif ?>
                        </td>
                        <td><?php echo $user["name"] ?></td>
                        <td><?php echo $user["username"] ?></td>
                        <td><?php echo $user["email"] ?></td>
                        <td><?php echo $user["phone"] ?></td>
                        <td><a href="http://<?= $user["website"] ?>" target="_blank"><?= $user["website"] ?></a></td>
                        <td><a href="view.php?id=<?= $user["id"] ?>" class="button view">View</a>
                            <a href="update.php?id=<?= $user["id"] ?>" class="button update">Update</a>
                            <a href="delete.php?id=<?= $user["id"] ?>" class="button delete">Delete</a>
                        </td>
                    </tr>
            <?php endforeach;
            endif; ?>
        </tbody>
    </table>

</div>
<?php include "./partial/footer.php" ?>
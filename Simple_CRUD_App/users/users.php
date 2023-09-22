<?php
// return array of all users
function getUsers()
{
    $users = json_decode(file_get_contents(__DIR__ . "/users.json"), true);
    return $users;
}
function getUsersById($id)
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user["id"] == $id)
            return $user;
    }
    return null;
}
// create id for new user
function createId(): int
{
    $users = getUsers();
    // count throw exception for null
    if (!isset($users) || count($users) == 0)
        return 1;
    return end($users)['id'] + 1;
}
// create new user in the json file
function createUser($data)
{
    $users = getUsers();
    $users[] = $data;
    writeUsers($users);
}

function updateUser($data, $id)
{

    $users = getUsers();
    foreach ($users as $i => $user) {
        if ($user["id"] == $id) {
            $users[$i] = array_merge($user, $data);
        }
    }
    writeUsers($users);
}
function writeUsers(array $users)
{
    $users = json_encode($users, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . "/users.json", $users);
}

/**
 * uploat Image
 * @return extension of the image
 */
function uploadImage($file, $userId): string
{
    // get extension of image
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    // save image as id.extension
    move_uploaded_file($file['tmp_name'], __DIR__ . "/images/" . $userId . "." . $extension);
    // merge extension in the data
    return $extension;
}

// what about image
function deleteUser($id)
{
    $users = getUsers();
    foreach ($users as $i => $user) {
        // == as get send id as string
        if ($user['id'] == $id) {
            // delete image
            if (isset($user["extension"]))
                unlink(__DIR__ . "/images/" . $user["id"] . "." . $user["extension"]);
            // delete user from database
            //  will not reindex of the array and these indexes will be added to the json because they are not the defalut indexing   
            // to use unset 
            // unset($users[$i]);
            // $users = array_values($users);
            array_splice($users, $i, 1);
        }
    }
    writeUsers($users);
}

function validateUser($user, &$isvalid): array
{
    $error = [
        "name" => "",
        "username" => "",
        "email" => "",
        "phone" => "",
    ];
    if (!$user['name']) {
        $error['name'] = "the name is mandatory";
        $isvalid = false;
    }
    if (strlen($user['username']) < 6 || strlen($user['username']) >= 20) {
        $error['username'] = "username must be less greater than 5 and less than 20";
        $isvalid = false;
    }
    if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "enter a valid email";
        $isvalid = false;
    }
    if (!preg_match('/^[0-9]{11}+$/', $user['phone'])) {
        $error['phone'] = "enter a valid phone number";
        $isvalid = false;
    }
    return $error;
}

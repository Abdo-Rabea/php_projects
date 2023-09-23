<?php
print_r($_POST);
$todoName = $_POST['todo_name'];
// read
$todos = file_get_contents('todo.json');
$todos = json_decode($todos, true);

// update complete variable
$todos[$todoName]['completed'] = !$todos[$todoName]['completed'];

// write
file_put_contents('todo.json', json_encode($todos, JSON_PRETTY_PRINT));
header('Location: index.php');
exit;

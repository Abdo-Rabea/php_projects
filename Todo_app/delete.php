<?php

$todoName = $_POST['todo_name'];
// read
$todos = file_get_contents('todo.json');
$todos = json_decode($todos, true);

// delete
// unset deals with the thrown warning if $todoName is not in json
unset($todos[$todoName]);

// write
file_put_contents('todo.json', json_encode($todos, JSON_PRETTY_PRINT));
header('Location: index.php');
exit;

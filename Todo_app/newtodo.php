<?php

/*
json after decode
Array
(
    [Todo item 1] => Array
        (
            [completed] => 1
        )

    [Todo item 2] => Array
        (
            [completed] => 1
        )

)
*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $x ?? $y;= isset($x) ? $x : $y;
    // to validate against $_POST not defined if you don't use if($_SERVER)
    $todoName = $_POST['todo_name'];
    // remove boundary spaces
    $todoName = trim($todoName);
    if ($todoName) {
        $todos = [];
        if (file_exists('todo.json')) {
            // read and decode json file
            $todos = file_get_contents('todo.json');
            $todos = json_decode($todos, true);
        }
        $todos[$todoName] = ['completed' => false];
        // save todos in json
        file_put_contents('todo.json', json_encode($todos, JSON_PRETTY_PRINT));
    }
}

header('Location: index.php');
exit;

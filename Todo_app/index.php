<?php

$todos = [];
if (file_exists('todo.json')) {
    $todos = file_get_contents('todo.json');
    $todos = json_decode($todos, true);
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todo</title>
    <link rel="stylesheet" href="./css/master.css"> <!-- the link of style code-->
</head>

<body>
    <div class="container">
        <form action="newtodo.php" method="POST">

            <input type="text" name="todo_name" placeholder="Enter todo">
            <button>new Todo</button>
        </form>
        <?php foreach ($todos as $todoName => $todo) : ?>
            <div class="todo">
                <form action="change_status.php" method="POST" style="display: inline-block;">
                    <input type="hidden" name="todo_name" value="<?= $todoName ?>">
                    <input type="checkbox" id="<?= $todoName ?>" <?= $todo['completed'] ? 'checked' : '' ?>>
                    <label for="<?= $todoName ?>"><?= $todoName ?></label>
                </form>
                <form action="delete.php" method="POST" style="display: inline-block;">
                    <button name="todo_name" value="<?= $todoName ?>">delete</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        const checkboxs = document.querySelectorAll("input[type=checkbox]");
        checkboxs.forEach(e => {
            console.log(e);
            e.onclick = function() {
                this.parentNode.submit();
            };
        })
    </script>
</body>

</html>
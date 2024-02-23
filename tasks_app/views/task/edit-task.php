<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../index.php");
  exit();
}
if (!isset($_GET)) {
  header("Location: ../user/user.php");
  exit();
}
$username = $_SESSION['username'];
$taskid = $_GET['task_id'];

// get task
include "../../models/Dbh.php";
include "../../models/TaskModel.php";
include "../../controllers/TaskController.php";
// it is normal to get fields again from db because in the user page you don't display all the fields of the task
$taskContr = new TaskController();
$task = $taskContr->getTask($taskid);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>edit task</title>
</head>

<body>
  <nav>
    <ul style="list-style: none; padding: 0">
      <li><a href="../user/user.php">User</a></li>
      <li><a href="../../includes/logout.inc.php">Logout</a></li>
    </ul>
  </nav>
  <h1><?= $username ?></h1>
  <form action="../../includes/edit-task.inc.php" method="post">
    <input type="text" name="task_title" placeholder="task title" value="<?= $task['task_title'] ?>">
    <input type="text" name="description" placeholder="description" value="<?= $task['description'] ?>">
    <input type="date" name="due_date" value="<?= $task['due_date'] ?>">
    <select name="status_id">
      <option value="1" <?= ($task['status_id'] === 1) ? 'selected' : ''; ?>>to do</option>
      <option value="2" <?= ($task['status_id'] === 2) ? 'selected' : ''; ?>>in progress</option>
      <option value="3" <?= ($task['status_id'] === 3) ? 'selected' : ''; ?>>completed</option>
    </select>
    <input type="hidden" name="task_id" value="<?= $taskid ?>">
    <button type="submit">edit task</button>
  </form>

</body>

</html>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../index.php");
  exit();
}

$username = $_SESSION['username'];
$userid = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <nav>
    <ul style="list-style: none; padding: 0">
      <li><a href="../user/user.php">User</a></li>
      <li><a href="../../includes/logout.inc.php">Logout</a></li>
    </ul>
  </nav>
  <h1><?= $username ?></h1>
  <form action="../../includes/add-task.inc.php" method="post">
    <input type="text" name="task_title" placeholder="task title">
    <input type="text" name="description" placeholder="description">
    <input type="date" name="due_date">
    <select name="status_id">
      <option value="1">to do</option>
      <option value="2">in progress</option>
      <option value="3">completed</option>
    </select>
    <input type="hidden" name="user_id" value="<?= $userid ?>">
    <button type="submit">add task</button>
  </form>

</body>

</html>
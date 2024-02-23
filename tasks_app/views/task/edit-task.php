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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <title>edit task</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="../user/user.php">User</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link"><?= $username ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../includes/logout.inc.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container mt-3">
    <h1>Edit Task</h1>
    <form action="../../includes/edit-task.inc.php" method="post" class="mt-3">
      <div class="mb-3">
        <label for="task_title" class="form-label">Task Title</label>
        <input type="text" name="task_title" class="form-control" placeholder="Task Title" value="<?= $task['task_title'] ?>" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" name="description" class="form-control" placeholder="Description" value="<?= $task['description'] ?>" required>
      </div>

      <div class="mb-3">
        <label for="due_date" class="form-label">Due Date</label>
        <input type="date" name="due_date" class="form-control" value="<?= $task['due_date'] ?>" required>
      </div>

      <div class="mb-3">
        <label for="status_id" class="form-label">Status</label>
        <select name="status_id" class="form-select" required>
          <option value="1" <?= ($task['status_id'] === 1) ? 'selected' : ''; ?>>To Do</option>
          <option value="2" <?= ($task['status_id'] === 2) ? 'selected' : ''; ?>>In Progress</option>
          <option value="3" <?= ($task['status_id'] === 3) ? 'selected' : ''; ?>>Completed</option>
        </select>
      </div>

      <input type="hidden" name="task_id" value="<?= $taskid ?>">
      <button type="submit" class="btn btn-primary">Edit Task</button>
    </form>
  </div>


</body>

</html>
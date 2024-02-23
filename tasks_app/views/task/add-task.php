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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <title>add task</title>
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

  <div class="container mt-3 col-md-6">
    <h1><?= $username ?></h1>
    <form action="../../includes/add-task.inc.php" method="post" class="mt-3 ">
      <div class="mb-3">
        <label for="task_title" class="form-label">Task Title</label>
        <input type="text" name="task_title" id="task_title" class="form-control" placeholder="Task Title" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" name="description" id="description" class="form-control" placeholder="Description" required>
      </div>

      <div class="mb-3">
        <label for="due_date" class="form-label">Due Date</label>
        <input type="date" name="due_date" id="due_date" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="status_id" class="form-label">Status</label>
        <select name="status_id" id="status_id" class="form-select" required>
          <option value="1">To Do</option>
          <option value="2">In Progress</option>
          <option value="3">Completed</option>
        </select>
      </div>

      <input type="hidden" name="user_id" value="<?= $userid ?>">
      <button type="submit" class="btn btn-primary">Add Task</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
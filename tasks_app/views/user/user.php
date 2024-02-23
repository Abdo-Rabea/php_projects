<?php session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../index.php");
  exit();
}
$username = $_SESSION['username'];
$userid = $_SESSION['user_id'];

include "../../models/Dbh.php";
include "../../models/TaskModel.php";
include "../../controllers/TaskController.php";
include "../../includes/user.inc.php"; // need userid and dreturn user tasks

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $username ?></title>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../../index.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../includes/logout.inc.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container mt-3">
    <h1><?= $username ?></h1>
    <a class="btn btn-primary" href="../task/add-task.php">Add Task</a>

    <div class="tasks">
      <h2>My Tasks</h2>
      <?php array_map(function ($task) { ?>
        <div class="task">
          <input type="checkbox" id="<?= $task['task_id'] ?>" <?= $task['status_id'] === 3 ? "checked" : '' ?>>
          <span><?= $task['task_title'] ?></span>
          <span><?= $task['description'] ?></span>
          <span><?= $task['due_date'] ?></span>

          <select class="form-select" name="status_id" aria-label="Select Status" taskId="<?= $task['task_id'] ?>">
            <option value="1" <?= ($task['status_id'] === 1) ? 'selected' : ''; ?>>To Do</option>
            <option value="2" <?= ($task['status_id'] === 2) ? 'selected' : ''; ?>>In Progress</option>
            <option value="3" <?= ($task['status_id'] === 3) ? 'selected' : ''; ?>>Completed</option>
          </select>

          <form action="../task/edit-task.php" method="GET">
            <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">
            <button type="submit" class="btn btn-warning">Edit</button>
          </form>

          <form action="../../includes/delete-task.inc.php" method="GET">
            <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      <?php }, $usertasks) ?>
    </div>
  </div>
  <script>
    // Function to handle the change event on the checkbox
    document.querySelectorAll("input[type='checkbox']").forEach(function(e) {
      e.addEventListener('change', function() {
        fetchChangeStatus(this.id, this.checked ? 3 : 1); // id here is the task id
      });
    })
    document.querySelectorAll(".select-status").forEach(function(e) {
      e.addEventListener('change', function() {
        fetchChangeStatus(this.getAttribute('taskId'), this.value);
      });
    })

    function fetchChangeStatus(taskId, statusId) {
      // Get checkbox status

      // Make a POST request using fetch
      fetch('../../includes/change-task-status.inc.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            task_id: taskId,
            status_id: statusId
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            // Reload the page if the response is successful
            location.reload();
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
  </script>
</body>

</html>
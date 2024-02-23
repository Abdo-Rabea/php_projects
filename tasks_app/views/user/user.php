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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <title><?= $username ?></title>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="../../index.php">Dashboard</a>
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
    <a class="btn btn-primary" href="../task/add-task.php">Add Task</a>

    <div class="tasks mt-3">
      <h2>My Tasks</h2>
      <div class="row">
        <?php array_map(function ($task) { ?>
          <div class="col-md-6">
            <div class="card mt-3 ">
              <div class="card-body">
                <h5 class="card-title"><?= $task['task_title'] ?></h5>
                <p class="card-text"><?= $task['description'] ?></p>
                <p class="card-text"><strong>Due Date:</strong> <?= $task['due_date'] ?></p>

                <div class="d-flex justify-content-between align-items-center">

                  <div class="d-flex">
                    <input class="form-check-input" type="checkbox" id="<?= $task['task_id'] ?>" <?= $task['status_id'] === 3 ? "checked" : '' ?>>
                    <div class="mx-2"></div>

                    <div class="status-dropdown">
                      <select class="form-select" name="status_id" aria-label="Select Status" taskId="<?= $task['task_id'] ?>">
                        <option value="1" <?= ($task['status_id'] === 1) ? 'selected' : ''; ?>>To Do</option>
                        <option value="2" <?= ($task['status_id'] === 2) ? 'selected' : ''; ?>>In Progress</option>
                        <option value="3" <?= ($task['status_id'] === 3) ? 'selected' : ''; ?>>Completed</option>
                      </select>
                    </div>
                  </div>

                  <div class="btn-group">
                    <form action="../task/edit-task.php" method="GET" class="ml-5">
                      <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">
                      <button type="submit" class="btn btn-secondary">Edit</button>
                    </form>
                    <div class="mx-1"></div>
                    <form action="../../includes/delete-task.inc.php" method="GET" class="ml-5">
                      <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                  </div>
                </div>

              </div>
            </div>
          </div>
        <?php }, $usertasks) ?>
      </div>
    </div>
  </div>
  <script>
    // Function to handle the change event on the checkbox
    document.querySelectorAll("input[type='checkbox']").forEach(function(e) {
      e.addEventListener('change', function() {
        fetchChangeStatus(this.id, this.checked ? 3 : 1); // id here is the task id
      });
    })
    document.querySelectorAll(".form-select").forEach(function(e) {
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
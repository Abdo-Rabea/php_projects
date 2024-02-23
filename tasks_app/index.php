<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ./views/user/login.php?");
  exit();
}
include "./includes/dashboard.inc.php" // here you got the getUsers logic
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <title>Dashboard</title>
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="./views/user/user.php">User</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <span class="nav-link"><?= $_SESSION['username'] ?></span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./includes/logout.inc.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <div class="container mt-5">
    <div class="row">
      <?php array_map(function ($user) { ?>
        <div class="card mb-3 text-center">
          <div class="card-body">
            <p class="card-title fs-3 fw-bold"><?= $user['username'] ?></p>
            <p class="card-title fs-7 "><?= $user['email'] ?></p>
            <div class="card-group">
              <div class="card mt-3">
                <div class="card-body">
                  <h3>Total tasks</h3>
                  <span><?= $user['total_count'] ?></span>
                </div>
              </div>
              <div class="card mt-3 ">
                <div class="card-body">
                  <h3>To Do</h3>
                  <span><?= $user['to_do_count'] ?></span>
                </div>
              </div>
              <div class="card mt-3 ">
                <div class="card-body">
                  <h3>In Progress</h3>
                  <span><?= $user['in_progress_count'] ?></span>
                </div>
              </div>
              <div class="card mt-3 ">
                <div class="card-body">
                  <h3>Completed</h3>
                  <span><?= $user['completed_count'] ?></span>
                </div>
              </div>
              <div class="card mt-3 ">
                <div class="card-body">
                  <h3>Deleted</h3>
                  <span><?= $user['deleted_task_count'] ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php }, $users) ?>
    </div>
  </div>

</body>

</html>
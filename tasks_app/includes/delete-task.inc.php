<?php
if (!isset($_GET)) {
  header("Location: ../views/user/user.php");
  exit();
}
$taskid = $_GET['task_id'];

// get task
include "../models/Dbh.php";
include "../models/TaskModel.php";
include "../controllers/TaskController.php";
// it is normal to get fields again from db because in the user page you don't display all the fields of the task
$taskContr = new TaskController();
$task = $taskContr->deleteTask($taskid);

header("Location: ../views/user/user.php");
exit();

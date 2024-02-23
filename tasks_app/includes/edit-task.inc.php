<?php
if (isset($_POST)) {

  include "../models/Dbh.php";
  include "../models/TaskModel.php";
  include "../controllers/TaskController.php";
  ['task_title' => $tasktitle, 'description' => $description, "due_date" => $duedate, "status_id" => $statusid, "task_id" => $taskid] = $_POST;
  $taskContr  = new TaskController();
  $usertasks = $taskContr->editTask($taskid, $tasktitle, $description, $duedate, $statusid);

  // you are here so everything is fine as you don't throw any error (change the header)
  header("Location: ../views/user/user.php");
  exit();
}

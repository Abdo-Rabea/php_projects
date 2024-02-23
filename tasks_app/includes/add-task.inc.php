<?php
if (isset($_POST)) {
  include "../models/Dbh.php";
  include "../models/TaskModel.php";
  include "../controllers/TaskController.php";
  ['user_id' => $userid, 'task_title' => $tasktitle, 'description' => $description, "due_date" => $duedate, "status_id" => $statusid] = $_POST;
  $taskContr  = new TaskController();
  $usertasks = $taskContr->addTask($userid, $tasktitle, $description, date('Y-m-d'), $duedate, $statusid);

  // you are here so everything is fine as you don't throw any error (change the header)
  header("Location: ../views/user/user.php");
  exit();
}

<?php
if (isset($_POST)) {
  include "../models/Dbh.php";
  include "../models/TaskModel.php";
  include "../controllers/TaskController.php";

  $jsonData = file_get_contents("php://input");
  $decodedData = json_decode($jsonData, true);

  // update task status
  $taskContr = new TaskController();
  $taskContr->changeTaskStatus($decodedData['task_id'], $decodedData['status_id']);

  $response = array('status' => 'success');
  echo json_encode($response);
}

<?php
class TaskController extends TaskModel
{

  public function getUserTasks($userid)
  {
    return $this->getUserTasksByID($userid);
  }

  public function getTask($taskid)
  {
    return $this->getTaskById($taskid);
  }

  public function addTask($userid, $tasktitle, $description, $createddate, $duedate, $statusid)
  {
    // you can add validation against empty fields and more
    $this->setTask((int)$userid, $tasktitle, $description, $createddate, $duedate, (int)$statusid);
  }

  public function editTask($taskid, $tasktitle, $description, $duedate, $statusid)
  {
    // you can validate agains empty fields also here
    $this->updateTask($taskid, $tasktitle, $description, $duedate, $statusid);
  }

  public function deleteTask($taskid)
  {
    $this->deleteTaskById($taskid);
  }
  public function changeTaskStatus($taskid, $statusid)
  {
    $this->updateTaskStatus($taskid, $statusid);
  }
}

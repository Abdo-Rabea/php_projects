<?php
// contoller 
class TaskModel extends Dbh
{
  protected function getUserTasksByID($userid)
  {
    $sql = "SELECT `task_id`,`task_title`, `description`, `created_date`, `due_date`, `status_id` FROM `task` WHERE user_id = ?;    ";
    $sth = $this->connect()->prepare($sql);
    if (!$sth->execute(array($userid))) { // true if succedd
      $sth = null;
      header("Location: ../views/user/user.php?error=dbFetchingTaskError");
      exit();
    }
    $userTasks = $sth->fetchAll(PDO::FETCH_ASSOC);
    $sth = null;
    return $userTasks;
  }

  protected function getTaskById($taskid)
  {
    $sql = "SELECT `task_title`, `description`, `due_date`, `status_id` FROM `task` WHERE `task_id` =?";
    $sth = $this->connect()->prepare($sql);
    if (!$sth->execute(array($taskid))) { // true if succedd
      $sth = null;
      header("Location: ../views/user/user.php?error=dbFetchingTaskError");
      exit();
    }
    $task = $sth->fetchAll(PDO::FETCH_ASSOC)[0];
    $sth = null;
    return $task;
  }

  protected function setTask($userid, $tasktitle, $description, $createddate, $duedate, $statusid)
  {
    $sql = "INSERT INTO `task`(`user_id`, `task_title`, `description`, `created_date`, `due_date`, `status_id`) VALUES (?, ?, ?, ?, ?, ?)";
    $sth = $this->connect()->prepare($sql);
    if (!$sth->execute(array($userid, $tasktitle, $description, $createddate, $duedate, $statusid))) { // true if succedd
      $sth = null;
      header("Location: ../views/user/user.php?error=faildToAddTask");
      exit();
    }
    $sth = null;
  }

  protected function updateTaskStatus($taskid, $statusid)
  {
    $sql = "UPDATE `task` SET `status_id`=? WHERE `task_id` = ?";
    $sth = $this->connect()->prepare($sql);
    if (!$sth->execute(array($statusid, $taskid))) { // true if succedd
      $sth = null;
      header("Location: ../views/user/user.php?error=updateStatusFaild");
      exit();
    }
    $sth = null;
  }

  protected function updateTask($taskid, $tasktitle, $description, $duedate, $statusid)
  {
    $sql = "UPDATE `task` SET `task_title`=?,`description`=?,`due_date`=?,`status_id`=? WHERE `task_id` = ?";
    $sth = $this->connect()->prepare($sql);
    if (!$sth->execute(array($tasktitle, $description, $duedate, $statusid, $taskid))) { // true if succedd
      $sth = null;
      header("Location: ../views/user/user.php?error=updateStatusFaild");
      exit();
    }
    $sth = null;
  }

  protected function deleteTaskById($taskid)
  {
    $sql = "DELETE FROM `task` WHERE `task_id`=?";
    $sth = $this->connect()->prepare($sql);
    if (!$sth->execute(array($taskid))) { // true if succedd
      $sth = null;
      header("Location: ../views/user/user.php?error=deleteTaskFaild");
      exit();
    }
    $sth = null;
  }
}

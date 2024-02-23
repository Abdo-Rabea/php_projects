<?php
// contoller 
class UserModel extends Dbh
{

  protected function emailAvailable($email)
  {
    $sql = "select email from user where email=?";
    // $sql = "select * from user";
    $sth = $this->connect()->prepare($sql);
    if (!$sth->execute(array($email))) {
      header("Location: any thing");
      exit();
    }
    $result = true;
    if ($sth->rowCount() > 0) // if there is any user with the email
      $result = false;
    return $result;
  }

  protected function setUser($username, $email, $pwd)
  {
    $sql = "INSERT INTO user (`username`, `email`, `password`) VALUES (?,?, ?)";
    $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT); // model only what knows about hashing and getting user
    $sth = $this->connect()->prepare($sql);
    if (!$sth->execute(array($username, $email, $hashedpwd))) { // true if succedd
      $sth = null;
      header("Location: ../views/user/register.php?error=dbInsertError");
      exit();
    }
    // every thing is good
    $sth = null;
  }


  protected function getUser($email, $pwd)
  {
    $sql = "select user_id, username, password from user where email=?";
    $sth = $this->connect()->prepare($sql);

    if (!$sth->execute(array($email))) { // true if success only
      $sth = null;
      header("Location: ../views/user/login.php?error=dbGetUserError");
      exit();
    }

    // if there is no user
    if ($sth->rowCount() == 0) {
      $sth = null;
      header("Location: ../views/user/login.php?error=emailNotFound");
      exit();
    }

    // password match
    $user = $sth->fetchAll(PDO::FETCH_ASSOC);
    if (!password_verify($pwd, $user[0]['password'])) {
      $sth = null;
      header("Location: ../views/user/login.php?error=wrongPassword");
      exit();
    }

    // everything is good
    session_start();
    $_SESSION['username'] = $user[0]['username'];
    $_SESSION['user_id'] = $user[0]['user_id'];
    $sth = null;
  }

  protected function getUsers()
  {
    $sql = "SELECT user.user_id, user.username, user.email,user.deleted_task_count, COUNT(CASE WHEN task.status_id >0 THEN 1 END) as total_count, COUNT(CASE WHEN task.status_id = 1 THEN 1 END) AS to_do_count, COUNT(CASE WHEN task.status_id = 2 THEN 1 END) AS in_progress_count, COUNT(CASE WHEN task.status_id = 3 THEN 1 END) AS completed_count FROM user LEFT JOIN task ON user.user_id = task.user_id GROUP BY user.user_id;";

    $sth = $this->connect()->prepare($sql);
    $sth->execute();
    $users = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $users;
    echo "<pre>";
    print_r($users);
    echo "</pre>";
  }
}

<?php
// will deal with database

class Signup extends Dbh
{
    // return true if the user name and email are availabe
    protected function checkUser($uid, $email)
    {
        $sth = $this->connect()->prepare('select user_id from users where user_uid = ? or user_email= ?');
        // will return true if it succeeds even if there is no recods
        if (!$sth->execute(array($uid, $email))) {
            $sth = null;
            header("Location: ../index.php?error=stmtfaild");
            exit();
        }
        $resultCheck = true;
        if ($sth->rowCount() > 0) // if there is any user with the same id or email
            $resultCheck = false;
        return $resultCheck;
        $sth = null; // to end statment 
    }

    protected function setUser($uid, $pwd, $email)
    {
        $sql = 'insert into users(user_uid, user_pwd, user_email) values(?,?,?);';
        $sth = $this->connect()->prepare($sql);
        $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);
        if (!$sth->execute(array($uid, $hashpwd, $email))) {
            $sth = null;
            header("Location: ../index.php?error=can'tinsertuser");
            exit();
        } else {
            echo "user added correctly";
        }
        $sth = null;
    }
}

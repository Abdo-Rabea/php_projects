<?php
// this class is only what knows hashing and the shape of the data
class Login extends Dbh
{
    /**
     * @return Pasword
     */
    protected function getUser($uid, $pwd)
    {
        $sql = "select user_uid, user_pwd from users where user_uid = ? or user_email = ?";
        $sth = $this->connect()->prepare($sql);
        // validate against error
        if (!$sth->execute(array($uid, $uid))) {
            $sth = null;
            header("Location: ../index.php?error=stmtfaild");
            exit();
        }
        // if user not fount
        if ($sth->rowCount() == 0) {
            $sth = null;
            header("Location: ../index.php?error=userNotFound");
            exit();
        }
        // verfy that password mathces
        $user = $sth->fetchAll(PDO::FETCH_ASSOC);
        if (!password_verify($pwd, $user[0]['user_pwd'])) {
            $sth = null;
            header("Location: ../index.php?error=wrongPassword");
            exit();
        }

        // every thig is fine
        session_start();
        $_SESSION['uid'] =  $user[0]['user_uid'];
        $sth = null;
        header("Location: ../page.php?username");
        exit();
    }
}

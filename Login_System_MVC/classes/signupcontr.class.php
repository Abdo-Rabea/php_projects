<?php
// get data from user and submit model = signup.class = use the connect method
// it is what deals with error and validation bacause is what get data from user validate and send it to the model
class SignupContr extends Signup
{
    private $uid;
    private $pwd;
    private $pwdrepeat;
    private $email;

    public function __construct($uid, $pwd, $pwdrepeat, $email)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdrepeat = $pwdrepeat;
        $this->email = $email;
        // $this->singupUser();
    }
    public function signupUser()
    {
        if ($this->emptyInput() === true) {
            // echo "empty input";
            header("Location: ../index.php?error=emptyinput");
            exit();
        }
        if ($this->invalidUid()) {
            // echo "invalidUid";
            header("Location: ../index.php?error=invalidUid");
            exit();
        }
        if ($this->invalidEmail()) {
            // echo "invalidEmail";
            header("Location: ../index.php?error=invalidEmail");
            exit();
        }
        if (!$this->pwdMatch()) {
            // echo "pwdMatchMissMatch";
            header("Location: ../index.php?error=pwdMatchMissMatch");
            exit();
        }
        if ($this->uidEmailTaken()) {
            // echo "uidEmailTaken";
            header("Location: ../index.php?error=uidEmailTaken");
            exit();
        }
        // here you can sing up the user ; so you will ask model to do that
        $this->setUser($this->uid, $this->pwd, $this->email);
    }
    private function emptyInput()
    {
        $result = false;
        if (empty($this->uid) || empty($this->pwd) || empty($this->pwdrepeat) || empty($this->email))
            $result = true;
        return $result;
    }
    private function invalidUid()
    {
        $result = false;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid))
            $result = true;
        return $result;
    }
    private function invalidEmail()
    {
        $result = false;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        }
        return $result;
    }
    private function pwdMatch()
    {
        $result = true;
        if ($this->pwd !== $this->pwdrepeat)
            $result = false;
        return $result;
    }
    // return true if taken
    private function uidEmailTaken()
    {
        $result = false;
        if (!$this->checkUser($this->uid, $this->email))
            $result = true;
        return $result;
    }
}

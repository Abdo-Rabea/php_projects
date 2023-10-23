<?php
// get data from user and submit model = login.class = use the connect method
// it is what deals with error and validation bacause is what get data from user validate and send it to the model
class LoginContr extends Login
{
    private $uid;
    private $pwd;
    private $pwdrepeat;
    private $email;

    public function __construct($uid, $pwd)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
        // $this->singupUser();
    }
    public function loginUser()
    {
        if ($this->emptyInput() === true) {
            // echo "empty input";
            header("Location: ../index.php?error=emptyinput");
            exit();
        }

        // return user and its password
        $this->getUser($this->uid, $this->pwd);
    }
    private function emptyInput()
    {
        $result = false;
        if (empty($this->uid) || empty($this->pwd))
            $result = true;
        return $result;
    }
}

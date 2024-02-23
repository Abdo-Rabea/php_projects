<?php
// in controller -> do all validation if it doesn't depend on the database
// if it depeneds on database ask the model to do this functionality for you

class UserController extends UserModel
{
  private $username, $email, $pwd, $pwdconf;

  public function __construct($username, $email, $pwd, $pwdconf)
  {
    $this->username = $username;
    $this->email = $email;
    $this->pwd = $pwd;
    $this->pwdconf = $pwdconf;
  }


  public function register()
  {
    if (!$this->emailAvailable($this->email)) {
      header("Location: ../views/user/register.php?error=emailTaken");
      exit();
    }
    /**  add some other validations
     * @validations
     */
    $this->setUser($this->username, $this->email, $this->pwd);
  }
  public function login()
  {
    // 1. validate against empty email and pwd
    // 2. validate agians pwd pattern and email pattern
    $this->getUser($this->email, $this->pwd);
  }
  public function getAllUsers()
  {
    return $this->getUsers();
  }
}

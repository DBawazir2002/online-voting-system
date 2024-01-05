<?php
include('login.class.php');
class LoginContr extends Login {
    private $mobile;
    private $pwd;
    private $role;

    public function __construct($mobile, $pwd, $role) {
            $this->mobile = $mobile;
            $this->pwd = $pwd;
            $this->role = $role;
    }

    public function loginUser() {
        $result = null;
        if($this->emptyInput() == false) 
        {
            $result = "<div class='alert alert-danger'>" . "الرجاء ملء الحقول أدناه" . "</div>";
            return $result;
        }

        $result = $this->getUser($this->mobile, $this->pwd, $this->role);
        return $result;
    }

    private function emptyInput() {
        $result = null;
        if (empty($this->mobile) || empty($this->pwd) || empty($this->role))
        {
            $result = false;
        }
        else 
        {
            $result = true;
        }
        return $result;
    }

}
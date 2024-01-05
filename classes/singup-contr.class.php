<?php
include "singup.class.php";
class SignupContr extends Singup {
    private $name;
    private $pwd;
    private $pwdRepeat;
    private $mobile;
    private $address;
    private $image;
    private $role;

    public function __construct($name ,$pwd ,$pwdRepeat ,$mobile, $address, $role, $image) {
            $this->name = $name;
            $this->pwd = $pwd;
            $this->pwdRepeat = $pwdRepeat;
            $this->mobile = $mobile;
            $this->address = $address;
            $this->role = $role;
            $this->image = $image;
    }

    public function singupUser() {
        $result = " ";
        if($this->emptyInput() == false) 
        {
            $result = "<div class='alert alert-danger'>" . "الرجاء ملء الحقول أدناه" . "</div>";
            return $result;
        }
        if($this->invalidimage() == false) 
        {
            $result = "<div class='alert alert-danger'>" . "الرجاء إختيار صورة مناسبة" . "</div>";
            return $result;
        }
        if($this->nameTakenCheck() == false) 
        {
            $result = "<div class='alert alert-danger'>" ."لقد تم اختيار هذا الاسم مسبقا ". "</div>";
            return $result;
        }
        if($this->pwdMatch() == false){
            $result = "<div class='alert alert-danger'>" . "كلمة السر ليست متطابقة" . "</div>";
            return $result;

        }
        if($this->mobileTakenCheck() == false){
            $result = "<div class='alert alert-danger'>" ."لقد تم اختيار هذا الرقم مسبقا ". "</div>";
            return $result;
        }

        $result = $this->setUser($this->name, $this->pwd, $this->mobile, $this->address, $this->role, $this->image);
        return $result;
    }

    private function emptyInput() {
        $result = false;
        if (empty($this->name) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->role) || empty($this->mobile) || empty($this->image) || empty($this->address))
        {
            return $result;
        }
        else 
        {
            $result = true;
        }
        return $result;
    }


    private function invalidimage(){
        $result = false;
        if(empty($this->image)){
            return $result;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function pwdMatch() {
        $result = null;
        if ($this->pwd !== $this->pwdRepeat)
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    private function nameTakenCheck() {
        $result = false;
        if (!$this->checkUser($this->name, $this->mobile))
        {
            return $result;
        }
        else
        {
            $result = true;
        }
        return $result;
    }
    private function mobileTakenCheck() {
        $result = false;
        if (!$this->checkMobile($this->name, $this->mobile))
        {
            return $result;
        }
        else
        {
            $result = true;
        }
        return $result;
    }
}
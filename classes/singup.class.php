<?php
include('connection.php');
class Singup extends Dbh {

    protected function setUser($name, $pwd, $mobile, $address, $role, $image) {
        $stmt = $this->connect()->prepare("insert into users (name, mobile, password, address, photo, status, votes, role) values('$name', '$mobile', '$pwd', '$address', '$image', 0, 0, '$role') ");
        $result = false;
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        if(!$stmt->execute()) {
            $stmt = null;
            return $result;
        }

        $stmt = null;
        $result = true;
        return $result;
    }

    protected function checkUser($name) {
        $stmt = $this->connect()->prepare("SELECT name FROM users WHERE name = '$name'");

        if(!$stmt->execute()) {
            return false;
        }

        $resultCheck = false;
        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        } 
        else {
            $resultCheck = true;
        }
        
        return $resultCheck;
    }

    protected function checkMobile($mobile){
        $stmt = $this->connect()->prepare("SELECT mobile FROM users WHERE mobile = '$mobile'");

        if(!$stmt->execute()) {
            return false;
        }

        $resultCheck = false;
        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        } 
        else {
            $resultCheck = true;
        }
        
        return $resultCheck;
    }

}
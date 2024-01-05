<?php
include('connection.php');
class Login extends Dbh {

    protected function getUser($mobile, $pwd, $role) {
        $result = null;
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE mobile = '$mobile' AND role = '$role'");

        if(!$stmt->execute()) {
            $stmt = null;
            $result = false;
            return $result;
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            $result = "<div class='alert alert-danger'>" ."لم يتم تسجيلك في النظام بعد !!". "</div>";
            return $result;
        }

        $pwdHashed = $stmt->fetch(PDO::FETCH_ASSOC); 

        if($pwdHashed['password'] != $pwd) {
            $stmt = null;
            $result = "<div class='alert alert-danger'>" ."كلمة المرور خاطئة". "</div>";
            return $result;
        }
        elseif($pwdHashed['password'] == $pwd) {
            $result = true;
        }

        return $result;
    }

}
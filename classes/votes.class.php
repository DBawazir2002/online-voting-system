<?php
session_start();
include('connection.php');

class Votes extends Dbh{

    private function updateVotes($total_votes, $id){
        $total_votes = 1 + $total_votes;
        $stmt = $this->connect()->prepare("UPDATE users SET votes='$total_votes' WHERE id='$id'");
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }


    private function getStatus($mobile){
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE mobile = '$mobile'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['status'];
    }

    private function updateStatusUser($mobile){
        $res = null;
        $res = $this->getStatus($mobile);
        if($res == 0){
            $stmt = $this->connect()->prepare("UPDATE users SET status=1 WHERE mobile='$mobile'");
            $stmt->execute();
        }
    }

    protected function getInfoGroups(){
        $stmt = $this->connect()->prepare("SELECT name, photo, votes, id FROM users WHERE role = 2");
        $stmt->execute();
        return $stmt;
    }

    protected function getInfoUser($mobile){
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE mobile='$mobile'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    protected function getAllVotes($votes, $mobile, $id){
        $total_votes = 0;
        $resu = false;
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE id='$id'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(isset($votes) && !is_bool($result)){
            $total_votes = $result['votes'];
            $resu = $this->updateVotes($total_votes, $id);
            $this->updateStatusUser($mobile);
        }
        return $resu;
    }


    
}
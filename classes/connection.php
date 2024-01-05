<?php

class Dbh {

    protected function connect() {
        try {
            $userName = "root";
            $password = "";
            $dbh = new PDO('mysql:host=localhost;dbname=onlineVotingSystem', $userName, $password);
            return $dbh;
        }
        catch (PDOException $th) {
            print "Error!: " . $th->getMessage . "<br />";
            die();
        }
    }

}
<?php

class Dbh {

    protected function connect() {
        try {
            $userName = "waziri";
            $password = "0000";
            $dbh = new PDO('mysql:host=localhost;dbname=onlinevotingsystem', $userName, $password);
            return $dbh;
        }
        catch (PDOException $th) {
            print "Error!: " . $th->getMessage . "<br />";
            die();
        }
    }

}
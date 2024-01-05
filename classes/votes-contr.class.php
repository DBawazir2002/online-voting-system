<?php
include "votes.class.php";

class VotesContr extends Votes{
    private $votes;
    private $mobile;

    public function __construct($mobile)
    {
        $this->mobile = $mobile;
    }

    public function votes($votes, $id){
        $result = false;
        $this->setVotes($votes);
        $result = $this->getAllVotes($this->votes, $this->mobile, $id);
        return ($result == true);
    }

    public function displayInfoUser(){
        $result = $this->getInfoUser($this->mobile);
        return $result;
    }

    public function displayInfoGroups(){
        $result = $this->getInfoGroups();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the value of votes
     */ 
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * Set the value of votes
     *
     * @return  self
     */ 
    public function setVotes($votes)
    {
        $this->votes = $votes;
    }

    /**
     * Get the value of mobile
     */ 
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set the value of mobile
     *
     * @return  self
     */ 
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }
}
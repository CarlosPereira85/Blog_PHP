<?php

class BlogItem {
    private $subject;
    private $body;
    private $show;
    private $createDate;
    private $countShowPage = 0;
    private $voting = 0;
    private $countVoting = 0;
    private $creator; // New property to store the creator's username

    public function __construct($subject, $body, $show = false, $creator) {
        $this->subject = $subject;
        $this->body = $body;
        $this->show = $show;
        $this->createDate = date('Y-m-d H:i:s');
        $this->creator = $creator; // Set the creator
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getBody() {
        return $this->body;
    }

    public function getShow() {
        return $this->show ? 'Ja' : 'Nein';
    }

    public function getCreateDate() {
        $timestamp = strtotime($this->createDate);
        if ($timestamp === false) {
            return 'Ungültiges Datum';
        }
        return date('d.m.Y H:i', $timestamp);
    }

    public function getCountShowPage() {
        return $this->countShowPage;
    }

    public function getVoting() {
        return $this->voting;
    }

    public function getCountVoting() {
        return $this->countVoting;
    }

    public function incrementShowCount() {
        $this->countShowPage++;
    }

    public function getCreator() {
        return $this->creator; // Get the creator
    }
    
    
    public function setVoting($voting) {
        $this->voting = $voting;
    }

    public function setCountVoting($countVoting) {
        $this->countVoting = $countVoting;
    }
}
?>

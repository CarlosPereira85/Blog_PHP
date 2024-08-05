<?php

class Blog {
    private $file;
    private $title;
    private $bloggerName = 'carlos';
    private $bloggerPWD = '123';
    private $items = array();
    private $maxSubjectLen = 10;

    public function __construct($file = 'daten/blog.txt', $title = 'Blog Project') {
        $this->file = $file;
        $this->title = $title;
        $this->load();
    }

    public function newItem($subject, $body, $show = false) {
        if (strlen($subject) > $this->maxSubjectLen) {
            return false;
        }

        $creator = $_SESSION['username'] ?? 'unknown';


        $this->items[] = new BlogItem($subject, $body, $show , $creator);
        $this->save();
        return true;
    }

    public function getItems() {
        return $this->items;
    }

    public function getItem($key) {
        return isset($this->items[$key]) ? $this->items[$key] : false;
    }

    public function isLogin() {
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'];
    }

    public function login($user, $pwd) {
        if ($user === $this->bloggerName && $pwd === $this->bloggerPWD) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user; // Store the username in session
            return true;
        }
        return false;
    }

    public function logout() {
       if ($this->isLogin()) unset($_SESSION['loggedin']);
    }

    public function save() {
        file_put_contents($this->file, serialize($this->items));
    }

    private function load() {
        if (file_exists($this->file)) {
            $this->items = unserialize(file_get_contents($this->file));
        }
    }

    public function getTitle() {
        return $this->title;
    }
   
    public function deleteItem($index) {
        if ($this->isLogin() && isset($this->items[$index]) && $this->items[$index]->getCreator() === $_SESSION['username']) {
            unset($this->items[$index]);
            $this->items = array_values($this->items); // Reindex array
            $this->save();
            return true;
        }
        return false;
    }
    public function setItems($items) {
        $this->items = $items;
    }

    public function canEditOrDelete($index) {
        // Check if the user is logged in and if the post exists
        return $this->isLogin() && isset($this->items[$index]) &&
            $this->items[$index]->getCreator() === $_SESSION['username'];
    }
    

    
}
?>

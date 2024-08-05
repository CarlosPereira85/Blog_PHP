<?php
include 'includes/init.inc.php';

session_start(); // Ensure session is started

$blog = new Blog();
$blog->logout(); // Log out the user

header('Location: blog.php');
exit();

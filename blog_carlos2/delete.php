<?php
include 'includes/init.inc.php';

session_start(); // Ensure session is started

$blog = new Blog();

if (!$blog->isLogin()) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($blog->canEditOrDelete($id)) {
        $blog->deleteItem($id);
        header('Location: blog.php');
        exit();
    } else {
        echo "You do not have permission to delete this post.";
        exit();
    }
} else {
    echo "ID nicht angegeben.";
    exit();
}
?>

<?php

require_once "../configs/app.php";

$id = $_GET['id'];

if (!filter_var($id, FILTER_VALIDATE_INT)) {
    $_SESSION['error'] = "Invalid Post Id !";
    header('location:index.php');
}

$post = $postController->show($id);

if (empty($post)) {
    $_SESSION['error'] = "There is no result!";
    header('location:index.php');
}

if (!is_null($post['image'])) {
    $imageController->delete($post['image']);
}

$postController->delete($id);

$_SESSION['success'] = "Deleted Successfully";

header('location:index.php');


?>

<?php 

session_start();

require_once __DIR__ . '/../Controllers/PostController.php';
require_once __DIR__ . '/../Controllers/ImageController.php';

use Controllers\PostController;
use Controllers\ImageController;

$postController = new PostController();
$imageController = new ImageController();

?>



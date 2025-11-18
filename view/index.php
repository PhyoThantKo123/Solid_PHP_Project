<?php

require_once __DIR__ . "/../configs/app.php";

$posts = $postController->getAllPosts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "./components/link.php" ?>
</head>
<body class="d-flex justify-content-center align-items-start">

    <div class="w-900 mt-5">

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success mb-3">
                <p class="mb-0"><?= $_SESSION['success'] ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger mb-3">
                <p class="mb-0"><?= $_SESSION['error'] ?></p>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-4">Post App</h2>
                    <a href="./create.php" class="btn btn-primary">Add New</a>
                </div>

                <table class="table table-striped table-light table-hover mb-0">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($posts)): ?>

                            <?php foreach($posts as $key=>$post): ?>
                                <tr class="fixed-row-height">
                                    <td class="align-middle"><?= $key += 1 ?></td>
                                    <td class="align-middle">
                                        <?php if($post['image']): ?>
                                            <img src="../assets/images/<?= $post['image'] ?>" class="img-size" />
                                        <?php else: ?>
                                            NULL
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle"><?= $post['title'] ?></td>
                                    <td class="align-middle"><?= $post['description'] ?></td>
                                    <td class="align-middle ">
                                        <div class="d-flex gap-2">
                                            <a href="./update.php?id=<?= $post['id'] ?>" class="nav-link text-primary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="" class="nav-link text-danger">
                                                <i class="fa-solid fa-trash"></i> 
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="5">
                                    <p class="text-center mb-0">There is no post!</p>
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>

                </table>

            </div>
        </div>

    </div>


</body>
</html>

<?php 

    session_destroy();

?>
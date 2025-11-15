<?php

require_once __DIR__ . "/../configs/app.php";

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
    
    <div class="card w-900 mt-5">
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
                    <tr>
                        <td>1</td>
                        <td>NULL</td>
                        <td>Hello World</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, molestias!</td>
                        <td class="d-flex gap-2">
                            <a href="" class="nav-link text-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="" class="nav-link text-danger">
                                <i class="fa-solid fa-trash"></i> 
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
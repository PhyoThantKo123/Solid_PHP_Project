<?php 

require_once __DIR__ . "/../configs/app.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $data = [
        'title' => $_POST['title'],
        'desc' => $_POST['description'],
    ];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $data['image'] = $_FILES['image'];
    }

    $result = $obj->insert($data);

    if ($result['success'] === true) {
        header('Location: index.php');
        exit;
    } else {
        var_dump($result);
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include __DIR__ ."/components/link.php" ?>
</head>
<body class="d-flex justify-content-center align-items-start">
    
    <div class="card w-500 mt-5">
        
        <div class="card-body">

            <h2 class="text-center mb-4">Create Post</h2>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title">Title<span class="text-danger">*</span> : <span class="text-danger"><?= isset($error['title']) ? $error['title'] : "" ?></span></label>
                    <input type="text" name="title" id="title" class="form-control" value="<?= isset($_POST['title']) ? $_POST['title'] : "" ?>" placeholder="Enter Title">
                </div>
                <div class="mb-3">
                    <label for="description">Description <span class="text-danger">*</span> : <span class="text-danger"><?= isset($error['desc']) ? $error['desc'] : "" ?></span></label>
                    <textarea name="description" id="description" class="form-control" rows="5"><?= isset($_POST['description']) ? $_POST['description'] : "" ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="image">Image: </label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="text-end">
                    <a href="./" class="btn btn-outline-secondary">Clear</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>

</body>
</html>
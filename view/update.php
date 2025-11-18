<?php 

require_once __DIR__ . "/../configs/app.php";


$id = $_GET['id'] ?? null;

if(!filter_var($id, FILTER_VALIDATE_INT)) {
    $_SESSION['error'] = "Invalid Post Id";
    header('location:index.php');
}


$post = $postController->show($id);

if(empty($post)) {
    $_SESSION['error'] = "There is no result for this ID";
    header('location:index.php');
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $data = [
        'id' => $post['id'],
        'old_image' => $post['image'],
        'title' => $_POST['title'],
        'desc' => $_POST['description'],
    ];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $data['image'] = $_FILES['image'];
    }

    $result = $postController->update($data);

    if ($result['status'] === true) {
        $_SESSION['success'] = "Updated successfully!";
        header('Location: index.php');
        exit;
    } else {
        $error = $result['error'];
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

            <h2 class="text-center mb-4">Update Post</h2>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . "?id=" . $post['id'] ?>" method="post" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label for="title">Title<span class="text-danger">*</span> : <span class="text-danger"><?= isset($error['title']) ? $error['title'] : "" ?></span></label>
                    <input type="text" name="title" id="title" class="form-control" value="<?= isset($_POST['title']) ? $_POST['title'] : $post['title'] ?>" placeholder="Enter Title">
                </div>

                <div class="mb-3">
                    <label for="description">Description<span class="text-danger">*</span> : <span class="text-danger"><?= isset($error['desc']) ? $error['desc'] : "" ?></span></label>
                    <textarea name="description" id="description" class="form-control" rows="5"><?= isset($_POST['description']) ? $_POST['description'] : $post['description'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="image">Image: 

                        <span class="text-danger">
                            <?php if(isset($error['image'])): ?>
                                <?= implode(", ", $error['image']) ?><br>
                            <?php endif; ?>
                        </span>

                    </label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <div class="text-end">
                    <a href="./" class="btn btn-outline-secondary">Black</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>

</body>
</html>
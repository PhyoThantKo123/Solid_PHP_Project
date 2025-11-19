<?php 

namespace Controllers;

require_once __DIR__ . "/../Contracts/Service/PostControllerInterface.php";
require_once __DIR__ . '/../Models/Post.php';


use Models\Post;
use Contracts\Service\PostControllerInterface;


class PostController implements PostControllerInterface
{
    private $post = null;
    private $imageController = null;
    public $error = [];

    public function __construct() 
    {
        $this->post = new Post();
        $this->imageController = new ImageController();
    }

    public function getAllPosts(): array 
    {
        return $this->post->getAll();
    }

    public function insert(Array $data): array
    {
        $title = $this->sanitize($data['title']) ?? "" ;
        $desc = $this->sanitize($data['desc'] ?? "");
        $image = "";

        $this->validateText($title,$desc);

        if (isset($data['image'])) {

            $resultOfImage = $this->imageController->upload($data['image'],$title);

            if(!$resultOfImage['status']) {
                $this->error['image'] = $resultOfImage['error'];
            } else {
                $image = $resultOfImage['file'];
            }

        }

        if (!empty($this->error)) {
            return [
                'success' => false,
                'error' => $this->error
            ];
        }

        $this->post->insert($title, $desc, $image);

        return [
            'success' => true,
        ];

    } 

    public function show(int $id): array 
    {
        return $this->post->show($id);
    }

    public function update(Array $data): array 
    {
        $id = $data['id'];
        $title = $this->sanitize($data['title']) ?? "";
        $desc = $this->sanitize($data['desc']) ?? "";
        $oldImage = $data['old_image'] ?? "";
        $image = "";

        $this->validateText($title,$desc);

        if(isset($data['image'])) {

            if(!empty($oldImage)) {
                $this->imageController->delete($oldImage);
            }

            $res = $this->imageController->upload($data['image'],$title);

            if(!$res['status']) {
                $this->error['image'] = $res['error'];
            } else {
                $image = $res['file'];
            }

        }

        if(!empty($this->error)) {
            return [
                'status' => false,
                'error' => $this->error
            ];
        }

        $this->post->update($id, $title, $desc, $image);

        return [
            'status' => true,
        ];

    }


    public function delete(int $id): void 
    {
        $this->post->delete($id);
    }


    public function sanitize(String $input): string 
    {
        return htmlspecialchars(stripcslashes(trim($input)));
    }

    public function validateText(string $title, string $desc): void 
    {
        if ($title == "") {
            $this->error['title'] = "Please fill the title field!";
        } else if (strlen($title) > 50) {
            $this->error['title'] = "Title must be at most 50!";
        }

        if($desc == "") {
            $this->error['desc'] = "Please fill the description field!";
        }
        
    }


}


?>
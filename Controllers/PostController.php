<?php 

namespace Controllers;

require_once __DIR__ . "/../Contracts/Service/PostControllerInterface.php";
require_once __DIR__ . '/../Models/Post.php';
require_once __DIR__ . '/ImageController.php';

use Models\Post;
use Contracts\Service\PostControllerInterface;
use Controllers\ImageController;

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
        $image = [];

        $this->validateText($title,$desc);

        if (isset($data['image'])) {

            $resultOfImage = $this->imageController->upload($data['image']);

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



        return [
            'success' => false,
            'title' => $title,
            'desc' => $desc,
            'image' => $image
        ];

    } 

    public function sanitize(String $input): string 
    {
        return htmlspecialchars(stripcslashes(trim($input)));
    }

    public function validateText($title, $desc) {
        if ($title == "") {
            $this->error['title'] = "Please fill the title field!";
        }

        if($desc == "") {
            $this->error['desc'] = "Please fill the description field!";
        }
    }


}


?>
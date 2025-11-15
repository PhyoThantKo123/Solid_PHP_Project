<?php 

namespace Controllers;

require_once __DIR__ . "/../Contracts/Service/PostControllerInterface.php";
require_once __DIR__ . '/../Models/Post.php';

use Models\Post;
use Contracts\Service\PostControllerInterface;

class PostController implements PostControllerInterface
{
    private $post = null;
    public $error = [];

    public function __construct() 
    {
        $this->post = new Post();
    }

    public function getAllPosts(): array 
    {
        return $this->post->getAll();
    }

    public function insert(Array $data): array
    {
        $title = $this->prepare($data['title']);
        $desc = $this->prepare($data['desc']);

        if ($title == "") {
            $this->error['title'] = "Please fill the title field!";
        }

        if($desc == "") {
            $this->error['desc'] = "Please fill the description field!";
        }

        if (empty($this->error)) {
            // create
            return true;
        }

        return $this->error;

    } 

    public function prepare(String $input): string 
    {
        $input = trim($input);
        $input = htmlspecialchars($input);
        $input = stripcslashes($input);
        return $input;
    }

}


?>
<?php

namespace Models;

require_once __DIR__ . '/Database.php'; 
require_once __DIR__ . '/../Contracts/Dao/PostInterface.php'; 

use Models\Database;
use Contracts\Dao\PostInterface;

class Post implements PostInterface
{
    private $conn = null;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll(): array {
        $sql = "SELECT * FROM posts";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert($post) {

        $sql = "INSERT INTO posts(title, description, image) VALUES (:title, :description, :image)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":title", $post['title']);
        $stmt->bindParam(":description", $post['description']);
        $stmt->bindParam(":image", $post['image']);

        $stmt->execute();

    }

}


?>
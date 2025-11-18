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

    public function getAll(): array 
    {
        $sql = "SELECT * FROM posts";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function show(int $id): array 
    {
        $sql = "SELECT * FROM posts WHERE id=:id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: [];

    }

    public function insert(string $title, string $desc, string $image): void
    {

        if (!empty($image)) {
            $sql = "INSERT INTO posts(title, description, image) VALUES (:title, :description, :image)";
        } else {
            $sql = "INSERT INTO posts(title, description) VALUES (:title, :description)";
        }   
        
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $desc);
        
        if (!empty($image)) {
            $stmt->bindParam(":image", $image);
        }

        $stmt->execute();

    }

    public function update(int $id, string $title, string $desc, string $image): void
    {

        if(!empty($image)) {            
            $sql = "UPDATE posts SET title=:title, description=:desc, image=:image WHERE id=:id";
        } else {
            $sql = "UPDATE posts SET title=:title, description=:desc WHERE id=:id";
        }

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":desc", $desc);

        if (!empty($image)) {
            echo $id . $title . $desc . $image . "<br/>";
            $stmt->bindParam(":image", $image);
        }

        $stmt->execute();

    }

}


?>
<?php 

namespace Contracts\Dao;

interface PostInterface {
    public function getAll(): array;
    public function insert(Array $post);
}



?>
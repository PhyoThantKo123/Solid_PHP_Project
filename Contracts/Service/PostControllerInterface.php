<?php 

namespace Contracts\Service;

interface PostControllerInterface {
    public function getAllPosts(): array;
    public function insert(Array $data): array;
    public function sanitize(String $input): string;
}


?>
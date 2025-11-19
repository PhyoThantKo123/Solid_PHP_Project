<?php 

namespace Contracts\Service;

interface PostControllerInterface {
    public function getAllPosts(): array;
    public function insert(Array $data): array;
    public function show(int $id): array;
    public function sanitize(String $input): string;
    public function validateText(string $title, string $desc): void;
    public function update(Array $data): array;
    public function delete(int $id): void;
}


?>
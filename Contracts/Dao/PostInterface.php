<?php 

namespace Contracts\Dao;

interface PostInterface {
    public function getAll(): array;
    public function insert(string $title, string $desc, string $image): void;
    public function show(int $id): array;
    public function update(int $id, string $title, string $desc, string $image): void;
}



?>
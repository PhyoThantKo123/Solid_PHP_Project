<?php

namespace Contracts\Service;

interface ImageControllerServiceInterface {
    public function upload(array $image, string $title): array;
    public function validateImage(string $type,int $size): bool;
    public function saveImage($tmp, $targetFile): void;
    public function delete($image): void;
}

?>
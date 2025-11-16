<?php

namespace Contracts\Service;

interface ImageControllerServiceInterface {
    public function upload(array $image): array;
    public function validateImage(string $type,int $size): bool;
    public function saveImage($tmp, $targetFile): void;
}

?>
<?php 

namespace Controllers;

require_once __DIR__ .  "/../Contracts/Service/ImageControllerServiceInterface.php";
use Contracts\Service\ImageControllerServiceInterface;

class ImageController implements ImageControllerServiceInterface 
{

    private $allowedExtension = ['jpg', 'png', 'jpeg'];
    private $uploadDir = __DIR__ . "/../assets/images/";
    public $error = [];
    private $limit = 1 * 1024 * 1024;

    public function upload($image): array
    {

        $fname = basename($image['name']);
        $tmpname = $image['tmp_name'];
        $type = strtolower(pathinfo($fname,PATHINFO_EXTENSION));
        $size = $image['size'];

        $targetFile = $this->uploadDir . $fname;

        if($this->validateImage($type, $size)) {
            $this->saveImage($tmpname, $targetFile);
        }


        if(!empty($this->error)) {
            return [
                'status' => false,
                'error' => $this->error
            ];
        }


        return [
            'status' => true,
            'file' => $targetFile
        ];

    }

    public function validateImage($type, $size): bool 
    {
        $status = true;

        if (!in_array($type, $this->allowedExtension) ) {
            $this->error['type'] = "file must be jpg, png or jpeg!";
            $status = false;
        } 
        
        if ($size > $this->limit) {
            $this->error['size'] = "Your file is too large!";
            $status = false;
        } 

        return $status;

    }


    public function saveImage($tmp, $targetFile): void 
    {

        if(!move_uploaded_file($tmp, $targetFile)) {
            $this->error['saving'] = "Can't Save Image";
        } 

    }
}



?>
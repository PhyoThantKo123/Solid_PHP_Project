<?php 

namespace Controllers;

require_once __DIR__ .  "/../Contracts/Service/ImageControllerServiceInterface.php";
use Contracts\Service\ImageControllerServiceInterface;

class ImageController implements ImageControllerServiceInterface 
{

    private $allowedExtension = ['jpg', 'png', 'jpeg'];
    public $error = [];
    private $limit = 1 * 1024 * 1024;
    private $uploadDir = __DIR__ . "/../assets/images/";

    public function upload($image, $title): array
    {

        $fname = basename($image['name']);
        $tmpname = $image['tmp_name'];
        $type = strtolower(pathinfo($fname,PATHINFO_EXTENSION));
        $size = $image['size'];
        $ftitle = str_replace(" ", "_", $title);

        $targetFileName = uniqid() . "_" . $ftitle . "." . $type;
        $targetFile = $this->uploadDir . $targetFileName;

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
            'file' => $targetFileName
        ];

    }

    public function validateImage($type, $size): bool 
    {
        $status = true;

        if (!in_array($type, $this->allowedExtension) ) {
            $this->error[] = "File must be jpg, png or jpeg!";
            $status = false;
        } 
        
        if ($size > $this->limit) {
            $this->error[] = "Your file is too large!";
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

    public function delete($image): void 
    {

        $targetFile = $this->uploadDir . $image;

        if(file_exists($targetFile)) {
            unlink($targetFile);
        }
        
    }
}



?>
<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $uploadDirectory = "img/uploads";

    function __construct()
    {
        $this->middleware('checkUserAuth')->except(array('login','activateAccount','setPassword'));
      //  $this->middleware('checkPermission')->except(array('login','activateAccount','setPassword'));
    }

    public function getUploadDirectory(){
        return $this->uploadDirectory;
    }

    public function uploadFile($currentDir){
        $date = date("YmdHis");
        $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileTmpName  = $_FILES['file']['tmp_name'];
        $fileType = $_FILES['file']['type'];
        $root = $_SERVER['DOCUMENT_ROOT'];
        $katalog = $root.'\\'."img\uploads".'\\'.$currentDir.'\\';

            $uploadPath = $root.'/'.$this->uploadDirectory.'/'.$currentDir.'/original-'.$date.$fileName;
            $sciezka = '/'.$this->uploadDirectory.'/'.$currentDir.'/original-'.$date.$fileName;
            $data = array(
                'nazwa' => $fileName,
                'sciezka'=> $sciezka,
            );

        if(!is_dir($katalog)){
            mkdir($katalog,0777);
        }
        if (move_uploaded_file($fileTmpName, $uploadPath)) {
            $fileService = app()->make('Files');
            $id = $fileService->insert($data);
            if($id){
                $sizes = app()->make('Size')->getSize();
                foreach($sizes as $s){
                    $newPath = $root.'/'.$this->uploadDirectory.'/'.$currentDir.'/'.$s->width.'x'.$s->height.'-'.$date.$fileName;
                    $this->resize($uploadPath,$newPath,$s->width,$s->height);
                }

                foreach($sizes as $s){
                    app()->make('ImageSizes')->insert(array('id_picture'=>$fileService->getFileBySciezka($sciezka)[0]->id,'id_size'=>$s->id));
                }
                return $fileService->getFileBySciezka($sciezka)[0]->id;
            } else{
                return 0;
            }
        } else {
            return 0;
        }

    }

    public function resize($picture,$newPath,$width,$height){

        if(!empty($picture)){
            $source_image = imagecreatefromjpeg($picture);
            $source_imagex = imagesx($source_image);
            $source_imagey = imagesy($source_image);

            $dest_imagex = $width;
            $ratio = $source_imagex/$dest_imagex;
            $dest_imagey = $source_imagey/$ratio;


            $image2 = imagecreatetruecolor($dest_imagex, $dest_imagey);
            imagecopyresampled($image2, $source_image, 0, 0, 0, 0,
                $dest_imagex, $dest_imagey, $source_imagex, $source_imagey);
            if($dest_imagey < $height){
                imagejpeg($image2, $newPath, 100);
                return $image2;
            } else{

                $image3 = imagecreatetruecolor($width, $height);

                imagecopyresampled($image3, $image2, 0, 0, 0, ($dest_imagey - $height)/2,
                    $width, $height, $width, $height);
                imagejpeg($image3, $newPath, 100);
                return $image3;
            }
        } else {
            return null;
        }
    }

    public function addPermissions(){

    }


}

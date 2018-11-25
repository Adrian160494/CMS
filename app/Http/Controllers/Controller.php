<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $uploadDirectory = "img/uploads";

    function __construct()
    {
        $this->middleware('checkUserAuth')->except('login');
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
        $uploadPath = $root.'/'.$this->uploadDirectory.'/'.$currentDir.'/'.$date.$fileName;
        $sciezka = '/'.$this->uploadDirectory.'/'.$currentDir.'/'.$date.$fileName;
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
                return $fileService->getFileBySciezka($sciezka)[0]->id;
            } else{
                return 0;
            }
        } else {
            return 0;
        }

    }


}

<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 26.01.2019
 * Time: 22:24
 */

$picture = $_SERVER['REQUEST_URI'];
$imageArray = explode('/show_image',$picture);
$picture_final = str_replace('/show_image','',$picture);
$array_image = explode('?',$picture);
$final_dim = array();
$image_path = 'http://'.$_SERVER['HTTP_HOST'].$picture_final;

if(!empty($array_image[1])){
    $dimensions = explode('&',$array_image[1]);
    if(!empty($dimensions)){
        foreach($dimensions as $d){
            $temp = explode('=',$d);
            if(!empty($temp)){
                array_push($final_dim,array($temp[0]=>$temp[1]));
            }
        }
    }
}

if(count($final_dim) == 2){
    $width = $_GET['width'];
    $height = $_GET['height'];
    $fit = 0;
}
if(count($final_dim) == 3){
    $width = $_GET['width'];
    $height = $_GET['height'];
    $fit = $_GET['fit'];
}
if(!empty($width) && !empty($height)){
    show_image($image_path,$width,$height,$fit,$imageArray);
} else {
    header("content-type: image/jpeg");

    echo file_get_contents('http://'.$_SERVER['HTTP_HOST'].$picture_final);

    die;
}


function show_image($picture, $width, $height,$fit, $imageArray) {
    $picture_info = getimagesize($picture);
    $root = $_SERVER['DOCUMENT_ROOT'];
    if($fit == 1){
        $path_to_file =$root.$imageArray[0]."/".$width.'x'.$height.'/fit'.explode('?',$imageArray[1])[0];
    } else{
        $path_to_file =$root.$imageArray[0]."/".$width.'x'.$height.explode('?',$imageArray[1])[0];
    }
    if(file_exists($path_to_file)){

        header("content-type: image/jpeg");
        echo file_get_contents($path_to_file);
        die;
    }
    if(!empty($picture_info)) {
        switch ($picture_info['mime']) {
            case "image/jpeg":
                $source_image = imagecreatefromjpeg($picture);
                break;
            case "image/png":
                $source_image = imagecreatefrompng($picture);

        }

        $source_imagex = imagesx($source_image);
        $source_imagey = imagesy($source_image);

        $dest_imagex = $width;
        $ratio = $source_imagex / $dest_imagex;
        $dest_imagey = $source_imagey / $ratio;

        if (!is_dir($root.$imageArray[0]."/".$width.'x'.$height)) {
            mkdir($root.$imageArray[0]."/".$width.'x'.$height, 0777);
        }

        if ($fit == 1) {
            $new_path =$root.$imageArray[0]."/".$width.'x'.$height.'/fit';

            if (!is_dir($new_path)) {
                mkdir($new_path, 0777);
            }
            $image2 = imagecreatetruecolor($dest_imagex, $dest_imagey);
            imagecopyresampled($image2, $source_image, 0, 0, 0, 0,
                $dest_imagex, $dest_imagey, $source_imagex, $source_imagey);
            $path_to_upload = $new_path.explode('?',$imageArray[1])[0];

            $image3 = imagecreatetruecolor($width, $height);

            imagecopyresampled($image3, $image2, 0, 0, 0, ($dest_imagey - $height) / 2,
                $width, $height, $width, $height);
            imagejpeg($image3, $path_to_upload, 100);
            header("content-type: image/jpeg");
            echo file_get_contents($path_to_upload);
            return $image3;

        } else {
            $new_path =$root.$imageArray[0]."/".$width.'x'.$height;
            if (!is_dir($new_path)) {
                mkdir($new_path, 0777);
            }
            $image2 = imagecreatetruecolor($dest_imagex, $dest_imagey);
            imagecopyresampled($image2, $source_image, 0, 0, 0, 0,
                $dest_imagex, $dest_imagey, $source_imagex, $source_imagey);
            $path_to_upload = $new_path.explode('?',$imageArray[1])[0];
            imagejpeg($image2, $path_to_upload, 100);
            header("content-type: image/jpeg");
            echo file_get_contents($path_to_upload);
            return $image2;

        }
    }
}
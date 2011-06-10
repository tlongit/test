<?php

session_start();
ob_start();
error_reporting(0);
include $_SERVER ['DOCUMENT_ROOT'] . "/init.php";
$attachs = $_FILES['Filedata'];
$mid = intval($_POST['mid']);

if ($mid) {
    $upload_dir = $_SERVER ['DOCUMENT_ROOT'] . '/uploads/images/' . $mid . '/' . date("Y") . '/' . date("m");

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $now = time();

    $thumbSize = Array('127-90');
    $arrPhotoNameExplode = explode('.', $attachs["name"]);
    $photoExtention = $arrPhotoNameExplode[(count($arrPhotoNameExplode) - 1)];

    $filename = rand(1, 999) . '-' . $now . '.' . strtolower($photoExtention);
    $filesize = $attachs["size"];
    $realFileName = $attachs["name"];
    $create_date = date('Y-m-d H:i:s');

    if (move_uploaded_file($attachs["tmp_name"], $upload_dir . "/" . $filename)) {
        for ($s = 0; $s < count($thumbSize); $s++) {// start create thumbnail
            $upload_dir_thumb = $upload_dir . '/thumb-' . $thumbSize[$s];
            if (!file_exists($upload_dir_thumb)) {
                mkdir($upload_dir_thumb, 0777, true);
            }
            $wh = explode('-', $thumbSize[$s]);
            $thumbnail_width = $wh[0];
            $thumbnail_heigh = $wh[1];

            if ($thumbSize[$s] == '127-90') {
                $thumb_image = str_replace($_SERVER ['DOCUMENT_ROOT'], '', $upload_dir_thumb) . '/' . $filename;
                $real_image = str_replace($_SERVER ['DOCUMENT_ROOT'], '', $upload_dir) . '/' . $filename;
                $sql = "INSERT INTO image (mid,image,real_image) VALUES ($mid,'$thumb_image','$real_image')";
                $db->query($sql);
            }
            include_once (LIBRARY_DIR . "phpThumb/ThumbLib.inc.php");
            $options = array('resizeUp' => true, 'jpegQuality' => 88);
            $thumb = PhpThumbFactory::create($upload_dir . "/" . $filename, $options);
            $thumb->adaptiveResize($thumbnail_width + 8, $thumbnail_heigh + 8);
            $thumb->cropFromCenter($thumbnail_width, $thumbnail_heigh);
            $thumb->save($upload_dir_thumb . '/' . $filename, 'jpg');
        }
    }
    echo $upload_dir . "/" . $filename;
}
?>
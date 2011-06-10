<?php

session_start();
ob_start();
error_reporting(0);
include $_SERVER ['DOCUMENT_ROOT'] . "/init.php";
$attachs = $_FILES['Filedata'];
$mid = intval($_POST['mid']);

if ($mid) {
    $upload_dir = $_SERVER ['DOCUMENT_ROOT'] . '/uploads/avatar/' . $mid;

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $now = time();

    $thumbWidth = 58;
    $thumbHeigh = 58;
    $arrPhotoNameExplode = explode('.', $attachs["name"]);
    $photoExtention = $arrPhotoNameExplode[(count($arrPhotoNameExplode) - 1)];
    
    $init_filename = rand(1, 999) . '-' . $now . '.' . strtolower($photoExtention);
    $avatar_file_prefix = "a-";
    $source_file = $init_filename;
    $filename = $avatar_file_prefix . $init_filename;
    
    if (move_uploaded_file($attachs["tmp_name"], $upload_dir . "/" . $source_file)) {
        
        include_once (LIBRARY_DIR . "phpThumb/ThumbLib.inc.php");
        $options = array('resizeUp' => true, 'jpegQuality' => 88);
        $thumb = PhpThumbFactory::create($upload_dir . "/" . $source_file, $options);
        $thumb->adaptiveResize($thumbWidth + 10, $thumbHeigh + 10);
        $thumb->cropFromCenter($thumbWidth, $thumbHeigh);
        $thumb->save($upload_dir . '/' . $filename, 'jpg');
        
        
        $sqlDelete = "SELECT * FROM member WHERE id=$mid";
        $arrDelete = $db->query_first($sqlDelete);
        if(file_exists($_SERVER ['DOCUMENT_ROOT'].$arrDelete['avatar'])){
            unlink($_SERVER ['DOCUMENT_ROOT'].$arrDelete['avatar']);
        }
        if(file_exists(str_replace($avatar_file_prefix, '', $_SERVER ['DOCUMENT_ROOT'].$arrDelete['avatar']))){
            unlink(str_replace($avatar_file_prefix, '', $_SERVER ['DOCUMENT_ROOT'].$arrDelete['avatar']));
        }
        $avatar = str_replace($_SERVER ['DOCUMENT_ROOT'], '', $upload_dir . '/' . $filename);
        $sql = "UPDATE member SET avatar='$avatar' WHERE id=$mid";
        $db->query($sql);
        echo $avatar;
    }
}
?>
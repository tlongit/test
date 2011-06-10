<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $targ_w = 58;
    $targ_h = 58;
    $jpeg_quality = 95;
    
    $avatar_file = trim($_POST['avatar']);
    $source_file = str_replace('a-', '', $avatar_file);
    $src = $_SERVER ['DOCUMENT_ROOT'] . $source_file;

    $img_r = imagecreatefromjpeg($src);
    $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

    imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $targ_w, $targ_h, $_POST['w'], $_POST['h']);

    header('Content-type: image/jpeg');
    imagejpeg($dst_r, null, $jpeg_quality);
    exit;
}
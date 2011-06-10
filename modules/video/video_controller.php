<?php

include_once MODEL_DIR . 'video.class.php';
$video = new video();

if (isset($params[1])) {
    $videoParams = $common->getParams($params[1]);
}

switch ($videoParams[0]) {
    case 'view':
        include INCLUDE_DIR . "header.php";
        include "views/video-detail.php";
        include INCLUDE_DIR . "footer.php";
        break;
    default:
        include INCLUDE_DIR . "header.php";
        include "views/video-html.php";
        include INCLUDE_DIR . "footer.php";
        break;
}
?>
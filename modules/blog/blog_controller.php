<?php

include_once MODEL_DIR . 'article.class.php';
$article = new article();
if (isset($params[1])) {
    $blogParams = $common->getParams($params[1]);;
}

switch ($blogParams[0]) {
    case 'view':
        include INCLUDE_DIR . "header.php";
        include "views/blog-detail.php";
        include INCLUDE_DIR . "footer.php";
        break;
    default:
        include INCLUDE_DIR . "header.php";
        include "views/blog-html.php";
        include INCLUDE_DIR . "footer.php";
        break;
}




?>
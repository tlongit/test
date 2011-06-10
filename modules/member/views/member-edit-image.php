<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
    <head>
        <title>Interactive Image Vamp up with jQuery, CSS3 and PHP</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Interactive Image Vamp up with jQuery, CSS3 and PHP" />
        <meta name="keywords" content="jquery, php, fancy, css3, rotation" />
        <link type="text/css" href="/css/image-editor/jquery.ui.theme.css" rel="stylesheet" />
        <link type="text/css" href="/css/image-editor/jquery.ui.core.css" rel="stylesheet" />
        <link type="text/css" href="/css/image-editor/jquery.ui.resizable.css" rel="stylesheet" />
        <link type="text/css" href="/css/image-editor/jquery.ui.slider.css" rel="stylesheet" />
        <link type="text/css" href="/css/image-editor/style.css" rel="stylesheet" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/js/jquery.leftScroolbar.js"></script>
        <script type="text/javascript" src="/js/json2.js"></script>

    </head>
    <body>
        <div id="content">
            <div id="background" class="background">
                <?php
                $imageDetail = $member->viewImage();
                ?>
                <img id="obj_0" src="<?php echo $imageDetail['arrRs']['real_image']; ?>" width="640"/>
            </div>
            <div id="tools">
            </div>
            <div id="objects">
                <?php
                $arrElements = $objImage->loadElements();
                $i = 0;
                foreach ($arrElements as $key => $value) {
                    $i++;
                    echo '<div class="obj_item"><img id="obj_' . $i . '" width="50" height="28" class="ui-widget-content" src="/uploads/editor/default/' . $value . '" alt="el"/></div>';
                }
                ?>
            </div>
            <a id="submit"><span></span></a>
            <form id="jsonform" action="merge.php" method="POST">
                <input id="jsondata" name="jsondata" type="hidden" value="" autocomplete="off"></input>
            </form>
        </div>
        <script src="/js/image-editor.js" type="text/javascript"></script>
    </body>
</html>
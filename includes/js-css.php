<link type="text/css" rel="stylesheet" href="/css/styles.css" />
<link type="text/css" href="/js/jquery-ui-1.8.13.custom/css/excite-bike/jquery-ui-1.8.13.custom.css" rel="stylesheet" />
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/droplist.js"></script>
<script type="text/javascript" src="/js/menu.js"></script>
<script type="text/javascript" src="/js/image_hover.js"></script>
<script type="text/javascript" src="/js/jquery-ui-1.8.13.custom/js/jquery-ui-1.8.13.custom.min.js"></script>

<?php
if ($_GET['action'] == 'taianhlen') {
    ?>
    <link type="text/css" rel="stylesheet" href="/js/uploadify/uploadify.css" />
    <script type="text/javascript" src="/js/uploadify/swfobject.js"></script>
    <script type="text/javascript" src="/js/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
    <?php
}
?>
<?php
if ($_GET['action'] == 'thongtincanhan') {
    ?>
    <link type="text/css" rel="stylesheet" href="/js/uploadify/uploadify.css" />
    <script type="text/javascript" src="/js/uploadify/swfobject.js"></script>
    <script type="text/javascript" src="/js/uploadify/jquery.uploadify.v2.1.4.min.js"></script>

    <script src="/js/jcrop/js/jquery.Jcrop.js"></script>
    <link rel="stylesheet" href="/js/jcrop/css/jquery.Jcrop.css" type="text/css" />

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&region=vn&language=vn"></script>
    <script type="text/javascript" src="/js/map.js"></script>
    <?php
}
?>
<?php
if ($_GET['action'] == 'anhcuatoi') {
    ?>
    <script type="text/javascript" src="/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    <?php
}
?>
<?php
if ($_GET['action'] == 'xemanh' || !isset($_GET['action'])) {
    ?>
    <script src="/js/prettyComments.js" type="text/javascript" charset="utf-8"></script>
    <?php
}
?>
<?php
if ($_GET['action'] == 'chinhsuaanh') {
    ?>
    <link type="text/css" href="/css/image-editor_bak/jquery.ui.theme.css" rel="stylesheet" />
    <link type="text/css" href="/css/image-editor_bak/jquery.ui.core.css" rel="stylesheet" />
    <link type="text/css" href="/css/image-editor_bak/jquery.ui.resizable.css" rel="stylesheet" />
    <link type="text/css" href="/css/image-editor_bak/jquery.ui.slider.css" rel="stylesheet" />
    <link type="text/css" href="/css/image-editor_bak/style.css" rel="stylesheet" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/jquery.leftScroolbar.js"></script>
    <script type="text/javascript" src="/js/json2.js"></script>
    <?php
}
?>

<!--[if lt IE 8]>
<style type="text/css">
li a {display:inline-block;}
li a {display:block;}
</style>
<![endif]-->

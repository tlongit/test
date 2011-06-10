<?php

include_once MODEL_DIR . 'member.class.php';
$member = new member();
switch ($param) {
    case 'thanh-vien':
        $action = trim($_GET['action']);
        switch ($action) {
            case 'guithu':
                if(!isset ($_SESSION['client']['id'])){
                    header("Location:" . DOMAIN);
                }
                include INCLUDE_DIR . "header.php";
                include "views/member-send.php";
                include INCLUDE_DIR . "footer.php";
                break;
            case 'hopthu':
                if(!isset ($_SESSION['client']['id'])){
                    header("Location:" . DOMAIN);
                }
                include INCLUDE_DIR . "header.php";
                include "views/member-inbox.php";
                include INCLUDE_DIR . "footer.php";
                break;
            case 'thudagui':
                if(!isset ($_SESSION['client']['id'])){
                    header("Location:" . DOMAIN);
                }
                include INCLUDE_DIR . "header.php";
                include "views/member-sent.php";
                include INCLUDE_DIR . "footer.php";
                break;
            case 'thongtincanhan':
                if(!isset ($_SESSION['client']['id'])){
                    header("Location:" . DOMAIN);
                }
                include_once MODEL_DIR . 'geographic.class.php';
                $geo = new geographic();
                include INCLUDE_DIR . "header.php";
                include "views/member-profile.php";
                include INCLUDE_DIR . "footer.php";
                break;
            case 'doimatkhau':
                if(!isset ($_SESSION['client']['id'])){
                    header("Location:" . DOMAIN);
                }
                include INCLUDE_DIR . "header.php";
                include "views/member-changepassword.php";
                include INCLUDE_DIR . "footer.php";
                break;
            case 'taianhlen':
                if(!isset ($_SESSION['client']['id'])){
                    header("Location:" . DOMAIN);
                }
                include INCLUDE_DIR . "header.php";
                include "views/member-upload-image.php";
                include INCLUDE_DIR . "footer.php";
                break;
            case 'anhcuatoi':
                if(!isset ($_GET['mid']) || intval($_GET['mid'])<1){
                    header("Location:" . DOMAIN); 
                }
                include INCLUDE_DIR . "header.php";
                include "views/member-my-image.php";
                include INCLUDE_DIR . "footer.php";
                break;
            case 'xemanh':
                if(!isset ($_GET['mid']) || intval($_GET['mid'])<1){
                    header("Location:" . DOMAIN); 
                }
                include INCLUDE_DIR . "header.php";
                include "views/member-view-image.php";
                include INCLUDE_DIR . "footer.php";
                break;
            case 'chinhsuaanh':
                if(!isset ($_SESSION['client']['id'])){
                    header("Location:" . DOMAIN);
                }
                include_once MODEL_DIR . 'image.class.php';
                $objImage = new image();
                //include INCLUDE_DIR . "header.php";
                include "views/member-edit-image.php";
                //include INCLUDE_DIR . "footer.php";
                break;
            case 'thoat':
                $member->logout();
                header("Location: /dang-nhap");
                break;
            default :
                if(!isset ($_GET['mid']) || intval($_GET['mid'])<1){
                    header("Location:" . DOMAIN); 
                }
              
                include_once MODEL_DIR . 'blog.class.php';
                include_once MODEL_DIR . 'date.class.php';
                $blog = new blog();
                $date_fomat = new dateFormatter();
                include INCLUDE_DIR . "header.php";
                include "views/member-home.php";
                include INCLUDE_DIR . "footer.php";
                break;
                break;
        }
        die;
        break;
    case 'dang-ky':
        include INCLUDE_DIR . "header.php";
        include "views/register-html.php";
        include INCLUDE_DIR . "footer.php";
        break;
    case 'dang-nhap':
        $member->login();
        include INCLUDE_DIR . "header.php";
        include "views/login-html.php";
        include INCLUDE_DIR . "footer.php";
        break;
    default :
        $member->login();
        include INCLUDE_DIR . "header.php";
        include "views/login-html.php";
        include INCLUDE_DIR . "footer.php";
        break;
}
?>
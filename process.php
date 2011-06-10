<?php

/*
 * Author: Quan Van Sinh
 * Email: qvsinh@yahoo.com
 */

session_start();
error_reporting(E_ALL | E_STRICT);
error_reporting(1);
include "init.php";

$action = $_REQUEST['action'];

switch ($action) {
    case 'load_more':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            include_once MODEL_DIR . 'member.class.php';
            include_once MODEL_DIR . 'blog.class.php';
            include_once MODEL_DIR . 'date.class.php';
            $member = new member();
            $blog = new blog();
            $date_fomat = new dateFormatter();

            $rsMore = $blog->listCommentFromLastId(1);
            if ($rsMore['rs']) {
                $html = "";
                while ($row = $db->fetch_array($rsMore['rs'])) {

                    $member_info = $member->getById(intval($row['mid']));
                    $listChildComment = FALSE;
                    $listChildComment = $blog->listChildComment($row['id']);

                    $html = '<li>';
                    $html = $html . '<div>';
                    $html = $html . '<div class="divBlogCommentMain">';
                    $html = $html . '<img src="' . $member_info['avatar'] . '" width="58" height="58"/>';
                    $html = $html . '<p>' . $row['content'] . '</p>';
                    $html = $html . '</div>';
                    $html = $html . '<div class="divBlogCommentOrther"><span><a href="javascript:;">Bình luận</a></span> <span>' . $date_fomat->diff(strtotime($row['create_date'])) . '</span></div>';
                    $html = $html . '</div>';

                    if (!$listChildComment['rs']) {
                        $html = $html . '<div class="divPostSubCommnet">';
                        $html = $html . '<textarea id="commentCon_' . $row['id'] . '" class="commentCon" onblur="if(this.value==\'\' || this.value==\'\'){this.value=\'Bạn muốn nói gì?\'}" onclick="if(this.value==\'Bạn muốn nói gì?\'){this.value=\'\'}" style="width: 555px;height: 31px;">Bạn muốn nói gì?</textarea>';
                        $html = $html . '<input type="button" onclick="submitChildComment(' . $row['id'] . ');" value="Hiển thị"/>';
                        $html = $html . '</div>';
                    }
                    $html = $html . '</div>';

                    if ($listChildComment['rs']) {
                        $html = $html . '<div id="divListSubComment_' . $row['id'] . '">';
                        while ($rowChild = $db->fetch_array($listChildComment['rs'])) {
                            $memberChildInfo = $member->getById(intval($rowChild['mid']));

                            $html = $html . '<div class="divSubBlogComment">';
                            $html = $html . '<div>';
                            $html = $html . '<p>';
                            $html = $html . '<img src="' . $memberChildInfo['avatar'] . '" width="38" height="38"/>';
                            $html = $html . $rowChild['content'];
                            $html = $html . '</p>';
                            $html = $html . '</div>';
                            $html = $html . '</div>';
                        }


                        $html = $html . '</div>';
                        $html = $html . '<div class="divPostSubCommnet">';
                        $html = $html . '<textarea id="commentCon_' . $row['id'] . '" class="commentCon" onblur="if(this.value==\'\' || this.value==\'\'){this.value=\'Bạn muốn nói gì?\'}" onclick="if(this.value==\'Bạn muốn nói gì?\'){this.value=\'\'}" style="width: 555px;height: 31px;">Bạn muốn nói gì?</textarea>';
                        $html = $html . '<input type="button" onclick="submitChildComment(' . $row['id'] . ');" value="Hiển thị"/>';
                        $html = $html . '</div>';
                    }
                    $html = $html . '</li>';
                    $ajax_last_id = $row['id'];
                }
                if ($html == '') {
                    echo json_encode(array('status' => 'end'));
                } else {
                    echo json_encode(array('status' => 'ok', 'last_id' => $ajax_last_id, 'html' => $html));
                }
            }
        }
        break;
    case 'blog_comment':
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['client']['id']) {//phai login thi moi comment duoc
            $comment = trim($_POST['comment']);
            $parent_id = intval($_POST['parent_id']);
            if (!empty($comment) && $comment != 'Bạn muốn nói gì?') {
                $data = array();
                if ($parent_id > 0) {
                    $data['parent_id'] = $parent_id;
                }
                $data['mid'] = $_SESSION['client']['id'];
                $data['geo_id'] = $_SESSION['client']['geo_id'];
                $data['content'] = $comment;
                $data['create_date'] = date('Y-m-d h:i:s');
                $db->exec_insert('blog', $data);
                $insert_id = $db->mysql_insert_id();
                echo json_encode(array('status' => 'ok', 'id' => $insert_id));
            }
        } else {
            echo json_encode(array('status' => 'not_login'));
        }
        break;
    case 'save_profile':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = trim($_POST['fullname']);
            $city = intval($_POST['city']);
            $district = intval($_POST['district']);
            $mapLatLon = trim($_POST['mapLatLon']);
            $mapAddress = trim($_POST['mapAddress']);
            if (empty($fullname)) {
                echo 'fullname_empty';
                die;
            }
            if ($district == 0) {
                echo 'error_district';
                die;
            }
            $mid = $_SESSION['client']['id'];
            $data = array();
            $data['fullname'] = $fullname;
            $data['geo_id'] = $district;
            $data['last_update'] = date('Y-m-d h:i:s');
            if (strlen($mapLatLon)) {
                $data['map_latlon'] = $mapLatLon;
            }
            if (strlen($mapAddress)) {
                $data['map_address'] = $mapAddress;
            }
            $db->exec_update('member', $data, " id=$mid ");
            echo "ok";
        }
        break;
    case 'member_edit_iamge':
        error_reporting(E_ALL);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            defined('DOCUMENT_ROOT') || define('DOCUMENT_ROOT', $_SERVER ['DOCUMENT_ROOT']);
            $res = json_decode(stripslashes($_POST['jsondata']), true);

            /* get data */
            $count_images = count($res['images']);
            /* the background image is the first one */
            $background = DOCUMENT_ROOT . $res['images'][0]['src'];

            $photo1 = imagecreatefromjpeg($background);
            $foto1W = imagesx($photo1);
            $foto1H = imagesy($photo1);
            $photoFrameW = $res['images'][0]['width'];
            $photoFrameH = $res['images'][0]['height'];
            $photoFrame = imagecreatetruecolor($photoFrameW, $photoFrameH);
            imagecopyresampled($photoFrame, $photo1, 0, 0, 0, 0, $photoFrameW, $photoFrameH, $foto1W, $foto1H);

            /* the other images */
            for ($i = 1; $i < $count_images; ++$i) {
                $insert = DOCUMENT_ROOT . $res['images'][$i]['src'];
                $photoFrame2Rotation = (180 - $res['images'][$i]['rotation']) + 180;

                $photo2 = imagecreatefrompng($insert);

                $foto2W = imagesx($photo2);
                $foto2H = imagesy($photo2);
                $photoFrame2W = $res['images'][$i]['width'];
                $photoFrame2H = $res['images'][$i]['height'];

                $photoFrame2TOP = $res['images'][$i]['top'];
                $photoFrame2LEFT = $res['images'][$i]['left'];

                $photoFrame2 = imagecreatetruecolor($photoFrame2W, $photoFrame2H);
                $trans_colour = imagecolorallocatealpha($photoFrame2, 0, 0, 0, 127);
                imagefill($photoFrame2, 0, 0, $trans_colour);

                imagecopyresampled($photoFrame2, $photo2, 0, 0, 0, 0, $photoFrame2W, $photoFrame2H, $foto2W, $foto2H);

                $photoFrame2 = imagerotate($photoFrame2, $photoFrame2Rotation, -1, 0);
                /* after rotating calculate the difference of new height/width with the one before */
                $extraTop = (imagesy($photoFrame2) - $photoFrame2H) / 2;
                $extraLeft = (imagesx($photoFrame2) - $photoFrame2W) / 2;

                imagecopy($photoFrame, $photoFrame2, $photoFrame2LEFT - $extraLeft, $photoFrame2TOP - $extraTop, 0, 0, imagesx($photoFrame2), imagesy($photoFrame2));
            }

            $thumbSize = Array('127-90');
            $upload_dir = dirname($background);
            $upload_dir_thumb = dirname($background) . '/thumb-' . $thumbSize[0];
            $filename = time() . '-' . basename($background);

            header('Content-type: image/jpeg');
            imagejpeg($photoFrame, $upload_dir . '/' . $filename, 100);
            imagedestroy($photoFrame);

            if (!file_exists($upload_dir_thumb)) {
                mkdir($upload_dir_thumb, 0777, true);
            }

            $wh = explode('-', $thumbSize[0]);
            $thumbnail_width = $wh[0];
            $thumbnail_heigh = $wh[1];

            if ($thumbSize[0] == '127-90') {
                $thumb_image = str_replace($_SERVER ['DOCUMENT_ROOT'], '', $upload_dir_thumb) . '/' . $filename;
                $real_image = str_replace($_SERVER ['DOCUMENT_ROOT'], '', $upload_dir) . '/' . $filename;
                $mid = $_SESSION['client']['id'];
                $sql = "INSERT INTO image (mid,image,real_image) VALUES ($mid,'$thumb_image','$real_image')";
                $db->query($sql);
                echo $image_id = $db->mysql_insert_id();
            }
            LIBRARY_DIR . "phpThumb/ThumbLib.inc.php";
            include_once (LIBRARY_DIR . "phpThumb/ThumbLib.inc.php");
            $options = array('resizeUp' => true, 'jpegQuality' => 88);
            $thumb = PhpThumbFactory::create($upload_dir . "/" . $filename, $options);
            $thumb->adaptiveResize($thumbnail_width + 8, $thumbnail_heigh + 8);
            $thumb->cropFromCenter($thumbnail_width, $thumbnail_heigh);
            $thumb->save($upload_dir_thumb . '/' . $filename, 'jpg');

            echo json_encode(array('status' => 'ok', 'image_id' => $image_id, 'image' => $real_image));
            exit();
        }
        break;
    case 'create_avatar':
        error_reporting(0);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $targ_w = 58;
            $targ_h = 58;
            $jpeg_quality = 95;
            $mid = $_SESSION['client']['id'];
            $sql = "SELECT avatar FROM member WHERE id=$mid";
            $rsAvatar = $db->query_first($sql);
            $avatar_file = trim($rsAvatar['avatar']);
            $source_file = str_replace('a-', '', $avatar_file);
            $src = $_SERVER ['DOCUMENT_ROOT'] . $source_file;

            $img_r = imagecreatefromjpeg($src);
            $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

            imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $targ_w, $targ_h, $_POST['w'], $_POST['h']);
            if (file_exists($_SERVER ['DOCUMENT_ROOT'] . $avatar_file)) {
                unlink($_SERVER ['DOCUMENT_ROOT'] . $avatar_file);
            }
            header('Content-type: image/jpeg');
            imagejpeg($dst_r, $_SERVER ['DOCUMENT_ROOT'] . $avatar_file, $jpeg_quality);
            imagedestroy($dst_r);
            echo $avatar_file;
            exit;
        }
        break;
    case 'get_district':
        include_once MODEL_DIR . 'geographic.class.php';
        $geo = new geographic();
        $id = intval($_POST['city_id']);
        $rs = $geo->getByParentId($id);
        $html = '<option value="0">Chọn quận/huyện của bạn...</option>';
        while ($row = $db->fetch_array($rs)) {
            $html .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }
        echo $html;
        break;
    case 'get_member_avatar':
        include_once MODEL_DIR . 'member.class.php';
        $member = new member();
        echo $member->getAvatar();
        break;
    case 'send_mail':
        include_once MODEL_DIR . 'member.class.php';
        $member = new member();
        echo $member->sendMail();
        break;
    case 'delete_image':
        include_once MODEL_DIR . 'member.class.php';
        $member = new member();
        $image_id = intval($_POST['image_id']);
        echo $member->deleteImage($image_id);
        break;
    case 'change_password':
        include_once MODEL_DIR . 'member.class.php';
        $member = new member();
        echo $member->changePassword();
        break;
    case 'image_comment':
        $comment = trim($_POST['comment']);
        $image_id = intval($_POST['image_id']);
        if (!intval($_SESSION['client']['id'])) {
            echo 'not_login';
            die;
        }
        if ($image_id) {
            if (empty($comment)) {
                echo 'comment_empty';
                die;
            }
            $create_date = date('Y-m-d h:i:s');
            $mid = $_SESSION['client']['id'];
            $data = array();
            $data['comment'] = $comment;
            $data['image_id'] = $image_id;
            $data['mid'] = intval($_SESSION['client']['id']);
            $data['fullname'] = $_SESSION['client']['fullname'];
            $data['create_date'] = $create_date;
            $db->exec_insert('image_comment', $data);
            echo 'ok';
        } else {
            echo 'die';
        }
        break;
    case 'register':
        include MODEL_DIR . 'validate.class.php';
        $validate = new validate();
        $fullname = trim($_POST['fullname']);
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $re_password = md5($_POST['re_password']);

        if (empty($fullname)) {
            echo 'fullname_empty';
            die;
        }
        if (!$validate->email($email)) {
            echo 'email_error';
            die;
        } else {
            $sqlCheck = "SELECT * FROM member WHERE email='$email'";
            $rsCheck = $db->query_first($sqlCheck);
            if ($rsCheck['id']) {
                echo 'email_exist';
                die;
            }
        }

        if (strlen($_POST['password']) < 6) {
            echo 'password_short';
            die;
        }
        if (empty($_POST['password'])) {
            echo 'password_empty';
            die;
        }
        if ($password != $re_password) {
            echo 'password_not_match';
            die;
        }

        $create_date = date('Y-m-d h:i:s');
        $data = array();
        $data['fullname'] = $fullname;
        $data['email'] = $email;
        $data['password'] = $password;
        $data['create_date'] = $create_date;
        $db->exec_insert('member', $data);
        echo 'ok';
        break;
}
?>
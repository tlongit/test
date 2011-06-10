<?php

/*
 * Author: Quan Van Sinh
 * Email : qvsinh@gmail.com
 * Mobile: 0972405165
 */

class member {

    function member() {
        
    }

    function login() {
        global $db;
        if (isset($_POST['email'])) {
            $email = trim($_POST['email']);
            $password = md5(trim($_POST['password']));
            $sql = "SELECT * FROM member WHERE 1 AND email='$email' AND password='$password' AND active=1";
            $rs = $db->query_first($sql);
            if ($rs['id']) {
                $_SESSION['client']['login'] = TRUE;
                $_SESSION['client'] = $rs;
                header("Location: /thanh-vien?mid=".$rs['id']);
            } else {
                return FALSE;
            }
        } else {
            $_SESSION['client']['login'] = FALSE;
            return FALSE;
        }
    }

    function logout() {
        unset($_SESSION['client']);
    }

    function checkLogin() {
        if ($_SESSION['client']['login']) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function changePassword() {
        global $db;
        if (isset($_POST['oldPassword'])) {
            $mid = $_SESSION['client']['id'];
            $oldPassword = md5($_POST['oldPassword']);
            $newPassword = md5($_POST['newPassword']);
            $rePassword = md5($_POST['rePassword']);

            $sqlCheck = "SELECT * FROM member WHERE id=$mid AND password='$oldPassword'";
            $arrCheck = $db->query_first($sqlCheck);
            if ($arrCheck['id']) {
                if ($newPassword != $rePassword) {
                    return 'password_not_match';
                } else {
                    $sqlUpdate = "UPDATE member SET password='$newPassword' WHERE id=$mid";
                    $db->query($sqlUpdate);
                    return 'ok';
                }
            } else {
                return 'old_password_not_match';
            }
        }
    }

    function deleteImage($id=0) {
        global $db;
        if ($id) {
            $mid = $_SESSION['client']['id'];
            $sql = "SELECT * FROM image WHERE id=$id AND mid=$mid";
            $arrCheck = $db->query_first($sql);
            if ($arrCheck['id']) {
                if (file_exists($_SERVER ['DOCUMENT_ROOT'] . $arrCheck['image'])) {
                    unlink($_SERVER ['DOCUMENT_ROOT'] . $arrCheck['image']);
                }
                if (file_exists($_SERVER ['DOCUMENT_ROOT'] . $arrCheck['real_image'])) {
                    unlink($_SERVER ['DOCUMENT_ROOT'] . $arrCheck['real_image']);
                }
                $db->query("DELETE FROM image WHERE id=$id AND mid=$mid");
                $db->query("DELETE FROM image_comment WHERE image_id=$id AND mid=$mid");
                return 'ok';
            } else {
                return 'die';
            }
        }
    }

    function sendMail() {
        global $db;
        if (isset($_POST['to'])) {
            include MODEL_DIR . 'validate.class.php';
            $validate = new validate();

            $idFrom = $_SESSION['client']['id'];
            $arrEmail = explode(',', trim($_POST['to']));
            $title = trim($_POST['title']);
            $message = trim($_POST['message']);
            $create_date = date('Y-m-d h:i:s');

            if (empty($_POST['to'])) {
                return 'to_empty';
                die;
            }
            if (empty($_POST['title'])) {
                return 'title_empty';
                die;
            }
            if (empty($_POST['message'])) {
                return 'message_empty';
                die;
            }
            foreach ($arrEmail as $key => $email) {
                if (!$validate->email($email)) {
                    return 'email_invalid';
                    die;
                }
            }
            $data = array();
            $data['id_from'] = $idFrom;
            $data['title'] = $title;
            $data['content'] = $message;
            $data['create_date'] = $create_date;
            if ($idFrom) {
                foreach ($arrEmail as $key => $email) {
                    $sqlCheckExist = "SELECT * FROM member WHERE email='$email'";
                    $arrCheck = $db->query_first($sqlCheckExist);
                    if ($arrCheck['id']) {//gui tin nhan cho nhung thanh vien da hoat dong tren he thong
                        $data['email'] = $email;
                        $db->exec_insert('message', $data);
                    }
                }
                return 'ok';
            }
        }
    }

    function mailInbox() {
        global $db;
        $email = $_SESSION['client']['email'];
        $sql = "SELECT * FROM message WHERE email='$email' ORDER BY create_date DESC";
        $rs = $db->query($sql);
        $arrInbox = array();
        while ($row = $db->fetch_array($rs)) {
            $arrInbox[$row['id']] = $row;
            $id_from = $row['id_from'];
            $sqlSender = "SELECT * FROM member WHERE 1 AND id='$id_from'";
            $rsSender = $db->query_first($sqlSender);
            $arrInbox[$row['id']]['sender'] = $rsSender;
        }
        return $arrInbox;
    }

    function mailSent() {
        global $db;
        $mid = $_SESSION['client']['id'];
        $sql = "SELECT * FROM message WHERE id_from='$mid' ORDER BY create_date DESC";
        $rs = $db->query($sql);
        $arrInbox = array();
        while ($row = $db->fetch_array($rs)) {
            $arrInbox[$row['id']] = $row;
            $emailSender = $row['email'];
            $sqlReceiver = "SELECT * FROM member WHERE 1 AND email='$emailSender'";
            $rsReceiver = $db->query_first($sqlReceiver);
            $arrInbox[$row['id']]['sender'] = $rsReceiver;
        }
        return $arrInbox;
    }

    function myImage($limit=5) {
        global $db;
        $mid = intval($_GET['mid']);
        if ($mid) {
            $page = intval($_GET['page']);

            if ($page < 1) {
                $page = 1;
            }

            $sql = "SELECT count(*) as numrows FROM image WHERE mid=$mid";
            $arrTotalRows = $db->query_first($sql);
            $totalPages = ceil($arrTotalRows['numrows'] / $limit);
            $start = (($page * $limit) - $limit);

            $sql = "SELECT * FROM image WHERE mid=$mid LIMIT $start,$limit";
            $rs = $db->query($sql);
            return array('rs' => $rs, 'page' => $page, 'totalPage' => $totalPages);
        } else {
            return false;
        }
    }

    function viewImage() {
        global $db;
        $mid = intval($_GET['mid']);
        $image_id = intval($_GET['image_id']);

        $sql = "SELECT * FROM image WHERE mid=$mid AND id=$image_id";
        $arrRs = $db->query_first($sql);

        $sqlComment = "SELECT * FROM image_comment WHERE 1 AND image_id=$image_id";
        $rsComment = $db->query($sqlComment);

        return array('arrRs' => $arrRs, 'rsComment' => $rsComment);
    }

    function profile() {
        global $db;

        $mid = $_SESSION['client']['id'];
        $sql = "SELECT * FROM member where id=$mid";
        if ($mid) {
            $profile = $db->query_first($sql);
            if ($profile['geo_id']) {
                $sqlGeo = "SELECT * FROM geographic WHERE id=" . $profile['geo_id'];
                $arrGeo = $db->query_first($sqlGeo);
                $profile['city_id'] = intval($arrGeo['parent_id']);
                $sqlDistricts = "SELECT * FROM geographic WHERE parent_id=" . $profile['city_id'];
                $rsDistricts = $db->query($sqlDistricts);
            }
            return array('profile' => $profile, 'rsDistricts' => $rsDistricts);
        }
    }

    function getAvatar() {
        global $db;
        $mid = $_SESSION['client']['id'];
        $sql = "SELECT * FROM member where id=$mid";
        $rs = $db->query_first($sql);
        return $rs['avatar'];
    }

    function getById($id) {
        global $db;
        if ($id > 0) {
            $sql = "SELECT * FROM member where id=$id";
            $rs = $db->query_first($sql);
            return $rs;
        }else{
            return FALSE;
        }
    }

}

?>

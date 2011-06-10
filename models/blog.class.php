<?php

/*
 * Author: Quan Van Sinh
 * Email : qvsinh@gmail.com
 * Mobile: 0972405165
 */

class blog {

    function blog() {
        
    }

    function listComment($limit=20) {
        global $db;
        $mid = intval($_GET['mid']);
        $sqlGeo = "SELECT * FROM member WHERE id=$mid";
        $arrGeo = $db->query_first($sqlGeo);
        $geo_id = intval($arrGeo['geo_id']);
        $sql = "SELECT * FROM blog WHERE 1 AND parent_id=0 AND (mid=$mid OR geo_id=$geo_id) ORDER BY create_date DESC LIMIT $limit";
        if ($mid > 0) {
            $rs = $db->query($sql);
        }
        return array('rs' => $rs);
    }

    function listCommentFromLastId($limit=20) {
        global $db;
        $last_id = intval($_POST['last_id']);
        $mid = intval($_POST['mid']);
        $sqlGeo = "SELECT * FROM member WHERE id=$mid";
        $arrGeo = $db->query_first($sqlGeo);
        $geo_id = intval($arrGeo['geo_id']);
        $sql = "SELECT * FROM blog WHERE 1 AND parent_id=0 AND id<$last_id AND (mid=$mid OR geo_id=$geo_id) ORDER BY id DESC LIMIT $limit";
        if ($mid > 0) {
            $rs = $db->query($sql);
        }
        return array('rs' => $rs);
    }

    function listChildComment($parent_id, $limit=20) {
        global $db;

        $sql = "SELECT * FROM blog WHERE 1 AND parent_id=$parent_id ORDER BY create_date ASC LIMIT $limit";
        if ($parent_id > 0) {
            $rs = $db->query($sql);
            return array('rs' => $rs);
        } else {
            return FALSE;
        }
    }

}

?>

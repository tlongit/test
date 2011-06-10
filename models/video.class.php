<?php

/*
 * Author: Quan Van Sinh
 * Email : qvsinh@gmail.com
 * Mobile: 0972405165
 */

class video {

    function video() {
        
    }

    function listRecentArticle($limit = 10) {
        global $db, $params;
        $cat_link = $params[1];
        $sql = "SELECT n.* FROM news n LEFT JOIN cat_news c ON n.cat_id=c.cat_id
                WHERE 1 AND n.active='yes' AND n.type!='hot' AND c.cat_link='$cat_link'
                ORDER BY n.`create_date` DESC LIMIT $limit";
        $rs = $db->query($sql);
        if ($db->num_rows($rs) < 1) {
            $sql = "SELECT n.* FROM news n LEFT JOIN cat_news c ON n.cat_id=c.cat_id
                WHERE 1 AND n.active='yes' AND n.type!='hot'
                ORDER BY n.`create_date` DESC LIMIT $limit";
            $rs = $db->query($sql);
        }
        return $rs;
    }

    function listHotArticle($limit = 5) {
        global $db, $params;
        $sql = "SELECT n.* FROM news n
            WHERE 1 AND n.active=1 AND n.type='hot'
            ORDER BY n.`view_count` DESC LIMIT $limit";
        $rs = $db->query($sql);
        return $rs;
    }

    function getCatNewsIdToArray($parent_id = 0, $trees=null) {
        global $db;
        if (!$trees)
            $trees = array();
        $rsCat = $db->query("SELECT cat_id FROM cat_news WHERE  cat_parent = " . intval($parent_id));
        if ($rsCat) {
            while ($rs = $db->fetch_array($rsCat)) {
                $trees[] = $rs['cat_id'];
                $trees = $this->getCatNewsIdToArray($rs['cat_id'], $trees);
            }
        }
        return $trees;
    }

    function listVideo() {
        global $db, $params;
        $page = 1;
        if (isset($params[1])) {
            $arrExplodeParams = explode('-', $params[1]);
            $page = intval($arrExplodeParams[1]);
        }
        $rsTotal = $db->query_first("SELECT count(n.id) as total FROM video n WHERE 1 AND n.active=1");
        $limit = NUM_ROW_PER_PAGE;
        $totalPage = ceil($rsTotal['total'] / $limit);
        $start = (($page * $limit) - $limit);
		if($start<0){
			$start = 0;		
		}
        $sql = "SELECT n.* FROM video n WHERE 1 AND n.active=1 ORDER BY n.`create_date` DESC LIMIT $start,$limit";
        $rs = $db->query($sql);
        return array("rs" => $rs, "page" => $page, "totalPage" => $totalPage);
    }

    function detailVideo() {
        global $db, $videoParams;
        $link = $videoParams[1];
        $db->query("UPDATE video SET view_count=view_count+1 WHERE youtube_id='$link' AND active=1");
        $rs = $db->query_first("SELECT * FROM video WHERE 1 AND youtube_id='$link' AND active=1");
        $rsNewer = $db->query("SELECT * FROM video WHERE 1 AND create_date>'".$rs['create_date']."' AND active=1 LIMIT 3");
        $rsOlder = $db->query("SELECT * FROM video WHERE 1 AND create_date<'".$rs['create_date']."' AND active=1 LIMIT 3");
        return array('rs'=>$rs,'rsNewer'=>$rsNewer,'rsOlder'=>$rsOlder);
    }
    function detailBookmarkYoutube() {
        global $db, $params;
        $link = $params[1];
        $db->query("UPDATE bookmark SET view_count=view_count+1 WHERE title_link='$link'");
        $rs = $db->query_first("SELECT * FROM bookmark WHERE 1 AND active=1 AND title_link='$link'");
        return $rs;
    }
    function getMaxIdYoutube() {
        global $db;
        $rs = $db->query_first("SELECT * FROM bookmark WHERE 1 AND active=1 ORDER BY id DESC");
        return $rs['id'];
    }
    function topYoutube($id) {
        global $db;
        $rs = $db->query_first("SELECT * FROM bookmark WHERE 1 AND active=1 AND id=$id");
        return $rs;
    }

    function viewArticle() {
        global $db, $params;
        $link = $params[1];
        $db->query("UPDATE news SET view_count=view_count+1 WHERE title_link='$link'");
        $rs = $db->query_first("SELECT * FROM url_data WHERE 1 AND title_link='$link'");
        return $rs;
    }

    function getBreakCum() {
        global $db, $params;
        $breakcum = array();
        $link = $params[1];
        $rs = $db->query_first("SELECT * FROM cat_news WHERE 1 AND cat_link = '$link'");
        if ($rs['cat_parent']) {
            $rsParent = $db->query_first("SELECT * FROM cat_news WHERE 1 AND cat_id=" . $rs['cat_parent']);
            $breakcum[] = array('title' => $rsParent['cat_title'], 'link' => $rsParent['cat_link']);
        }
        $breakcum[] = array('title' => $rs['cat_title'], 'link' => $rs['cat_link']);
        return $breakcum;
    }

}
?>

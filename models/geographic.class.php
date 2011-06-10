<?php

/*
 * Author: Quan Van Sinh
 * Email : qvsinh@gmail.com
 * Mobile: 0972405165
 */

class geographic {

    function geographic() {
        
    }

    function getCity() {
        global $db;
        $sql = "SELECT * FROM geographic WHERE parent_id IN (1,2,3) ORDER BY name";
        $rs = $db->query($sql);
        return $rs;
    }
    
    function getByParentId($id){
        global $db;
        $sql = "SELECT * FROM geographic WHERE parent_id=$id ORDER BY name";
        $rs = $db->query($sql);
        return $rs;
    }

    

}

?>

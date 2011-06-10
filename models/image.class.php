<?php

/*
 * Author: Quan Van Sinh
 * Email : qvsinh@gmail.com
 * Mobile: 0972405165
 */

class image {

    function image() {
        
    }

    function loadElements($folder='default') {
        $element_dir = BASE_DIR . '/uploads/editor/'.$folder;
        $count = 0;
        $arrFile = array();
        $handle = opendir($element_dir);
        if ($handle) {
            while (false !== ($file = readdir($handle))) {
                if (strpos($file, '.png',1)||strpos($file, '.PNG',1) ) {
                    $arrFile[] = $file;
                } 
                
            }
            closedir($handle);
        }
        return $arrFile;
    }

}
?>

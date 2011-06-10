<?php

class common {

    function common() {

    }

    function quote_escape($string) {
        $string = str_replace('"', "&quot;", $string);
        $string = str_replace("'", "&#039;", $string);
        return $string;
    }

    
    // $date = YY/MM/DD , $o = +, -, $ov = songay, $f = 'Y-m-d...'
    function dateProcess($date, $o, $ov, $f) {
        $date = explode('-', $date);
        $d = $date[2];
        $m = $date[1];
        $y = $date[0];
        if ($o == '-')
            $d = $d - $ov;
        else
            $d = $d + $ov;
        return date($f, mktime(0, 0, 0, $m, $d, $y));
    }

    function getParams($param) {
        $params = array();
        $arrTemParams2 = explode('$', $param);
        for ($i = 0; $i < count($arrTemParams2); $i++) {
            $arrTemParamsKeyValue = explode('-', $arrTemParams2[$i]);
            array_push($params, $arrTemParamsKeyValue[0]);
            if (isset($arrTemParamsKeyValue[1])) {
                $params_value = str_replace($arrTemParamsKeyValue[0] . '-', '', $arrTemParams2[$i]);
                array_push($params, $params_value);
            }
        }
        return $params;
    }

    function printGzippedPage() {

        global $HTTP_ACCEPT_ENCODING;
        if (headers_sent ()) {
            $encoding = false;
        } elseif (strpos($HTTP_ACCEPT_ENCODING, 'x-gzip') !== false) {
            $encoding = 'x-gzip';
        } elseif (strpos($HTTP_ACCEPT_ENCODING, 'gzip') !== false) {
            $encoding = 'gzip';
        } else {
            $encoding = false;
        }

        if ($encoding) {
            $contents = ob_get_contents();
            ob_end_clean();
            header('Content-Encoding: ' . $encoding);
            print("\x1f\x8b\x08\x00\x00\x00\x00\x00");
            $size = strlen($contents);
            $contents = gzcompress($contents, 9);
            $contents = substr($contents, 0, $size);
            print($contents);
            exit();
        } else {
            ob_end_flush();
            exit();
        }
    }

    function randStr($length = 6, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890') {
        // Length of character list
        $chars_length = (strlen($chars) - 1);
        // Start our string
        $string = $chars{rand(0, $chars_length)};
        // Generate random string
        for ($i = 1; $i < $length; $i = strlen($string)) {
            // Grab a random character from our list
            $r = $chars{rand(0, $chars_length)};
            // Make sure the same two characters don't appear next to each other
            if ($r != $string{$i - 1})
                $string .= $r;
        }
        // Return the string
        return $string;
    }

    function limitWord($str, $length) {
        $arrWord = explode(' ', $str);
        if (count($arrWord) > $length + 1) {
            return implode(' ', array_slice($arrWord, 0, $length)) . ' ...';
        } else {
            return implode(' ', array_slice($arrWord, 0, $length));
        }
    }

    function dateFomat($date, $fomat = 'd/m/Y, H:i:s') {
        return date($fomat, strtotime($date));
    }

    function paging($page, $total, $url) {
        $num = 2;
        $numPage = 6;
        if ($total > 1) {
            if ($page != 1) {
                $dau = $page - $num;
                if ($dau <= 0) {
                    $dau = 1;
                    $dit = $num - $page;
                }
                $dit = $dit + $page + $num;
                if ($dit > $total) {
                    $dit = $total;
                    $dau = $total - $numPage;
                    if ($dau <= 0) {
                        $dau = 1;
                    }
                }
            } else {
                $dau = 1;
                $dit = 10;
                if ($dit > $total) {
                    $dit = $total;
                }
            }
            if ($page > $total) {
                $dau = 1;
                $dit = 1;
            }
            for ($i = $dau; $i <= $dit; $i++) {
                if ($i == $page) {
                    $pagesM.="<li class='current'>$i</li>";
                } else {
                    $pagesM.="<li><a href=" . $url . "-$i>$i</a></li>";
                }
            }
            $pages.= '<div class="page"><ul>';
            $pages.= "<li><a href=" . $url . "-1>First</a></li>";
            $pages.=$pagesM;
            $pages.="<li><a href=" . $url . "-" . $total . ">Last</a></li>";
            $pages.='</ul></div>';

            return $pages;
        } else {
            return false;
        }
    }

    

    function getLink($option="", $link="") {
        if (!empty($link)) {
            $link = "-" . $link;
            $link = DOMAIN . $option . $link;
        }
        return $link;
    }

    function create_link($Raw) {
        $Raw = trim($Raw);
        $Raw = $this->nosignLink($Raw);
        $Raw = strtolower($Raw);
        if (strlen($Raw) > 100) {
            $Raw = substr($Raw, 0, 100);
        }
        $RemoveChars = array("([\40])", "([^a-zA-Z0-9-])", "(-{2,})");
        $ReplaceWith = array("-", "", "-");
        return preg_replace($RemoveChars, $ReplaceWith, $Raw);
    }

    function nosignLink($str) {
        $sign = array("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă",
            "ằ", "ắ", "ặ", "ẳ", "ẵ",
            "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ",
            "ì", "í", "ị", "ỉ", "ĩ",
            "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ"
            , "ờ", "ớ", "ợ", "ở", "ỡ",
            "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
            "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ",
            "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă"
            , "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
            "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
            "Ì", "Í", "Ị", "Ỉ", "Ĩ",
            "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ"
            , "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
            "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
            "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
            "Đ", "ê", "ù", "à", " ", "_");

        $unsign = array("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a"
            , "a", "a", "a", "a", "a", "a",
            "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
            "i", "i", "i", "i", "i",
            "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o"
            , "o", "o", "o", "o", "o",
            "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
            "y", "y", "y", "y", "y",
            "d",
            "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A"
            , "A", "A", "A", "A", "A",
            "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
            "I", "I", "I", "I", "I",
            "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O"
            , "O", "O", "O", "O", "O",
            "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U",
            "Y", "Y", "Y", "Y", "Y",
            "D", "e", "u", "a", "-", "-");
        return str_replace($sign, $unsign, $str);
    }

}

?>
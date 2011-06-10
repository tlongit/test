<?php

/*
 * Author: Quan Van Sinh
 * Email: qvsinh@yahoo.com
 */

/*
  $start = microtime ();
  $start = explode ( " ", $start );
  $start = $start [1] + $start [0];
 */

//sao khong commit duoc
session_start();
error_reporting(E_ALL );
error_reporting(0);

include "init.php";

ob_start("clean_html_output");

$params = array();
if (isset($_GET['url'])) {
    $param = $_GET ['url'];
    $params = $common->getParams($param);
} else {
    $param = '';
}
//echo $param;
switch ($param) {
    case 'dang-ky':
        include MODULE_DIR . "member/member_controller.php";
        break;
    case 'dang-nhap':
        include MODULE_DIR . "member/member_controller.php";
        break;
    case 'thanh-vien':
        include MODULE_DIR . "member/member_controller.php";
        break;
    default:
        include MODULE_DIR . "member/member_controller.php";
        break;
}

/*
  $end = microtime ();
  $end = explode ( " ", $end );
  $end = $end [1] + $end [0];
  printf ( "<br>Page was generated by PHP %s in %f seconds", phpversion (), $end - $start );
 */
?>

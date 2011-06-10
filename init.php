<?php
//define url
defined('DOMAIN') || define('DOMAIN', 'http://'.$_SERVER['HTTP_HOST'].'/');
defined('ADMIN_URL') || define('ADMIN_URL', DOMAIN . 'admincp/');
defined('UPLOAD_URL') || define('UPLOAD_URL', DOMAIN . 'uploads/');
defined('JS_URL') || define('JS_URL', DOMAIN . 'js/');
defined('CSS_URL') || define('CSS_URL', DOMAIN . 'css/');
defined('IMG_URL') || define('IMG_URL', DOMAIN . 'images/');
//define directory
defined('BASE_DIR') || define('BASE_DIR', realpath(dirname(__FILE__)));
defined('MODULE_DIR') || define('MODULE_DIR', BASE_DIR . '/modules/');
defined('MODEL_DIR') || define('MODEL_DIR', BASE_DIR . '/models/');
defined('INCLUDE_DIR') || define('INCLUDE_DIR', BASE_DIR . '/includes/');
defined('LIBRARY_DIR') || define('LIBRARY_DIR', BASE_DIR . '/library/');
defined('UPLOAD_DIR') || define('UPLOAD_DIR', BASE_DIR . '/uploads/');

defined('NUM_ROW_PER_PAGE') || define('NUM_ROW_PER_PAGE', 6);

$config['title'] = 'Umee.net | Happy sharing';
$config['description'] = 'Funny video page and blog sharing.';
$config['keyword'] = 'Fun, Funny, Funny video, Blog share, Happy sharing';

include LIBRARY_DIR . "/common.php";
$common = new common();

//database connection
include (LIBRARY_DIR . "mysql.php"); //database object
$db = new database();

$db->db = array(
    "host" => 'localhost',
    "user" => 'root',
    "pass" => '123',
    "db" => 'cungque'
);

$db->Debug = true;
$db->connect();
$db->query("set names utf8");

function clean_html_output($buffer) {
    global $config;
//    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer); // remove comments
//    $buffer = str_replace(array("\r\n", "\r", "\n", "\t","  "), '', $buffer); // remove tabs, spaces, newlines, etc.

//    $buffer = str_replace('{ ', '{', $buffer); // remove unnecessary spaces.
//    $buffer = str_replace(' }', '}', $buffer);
//    $buffer = str_replace('; ', ';', $buffer);
//    $buffer = str_replace(', ', ',', $buffer);
//    $buffer = str_replace(' {', '{', $buffer);
//    $buffer = str_replace('} ', '}', $buffer);
//    $buffer = str_replace(': ', ':', $buffer);
//    $buffer = str_replace(' ,', ',', $buffer);
//    $buffer = str_replace(' ;', ';', $buffer);

    $buffer = str_replace("[TITLE]", $config['title'], $buffer);
    $buffer = str_replace("[KEYWORD]", $config['keyword'], $buffer);
    $buffer = str_replace("[DESCRIPTION]", $config['description'], $buffer);

    return $buffer;
}
?>

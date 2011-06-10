<?php

include_once MODEL_DIR . 'contact.class.php';
include_once MODEL_DIR . 'validate.class.php';

$contact = new contact();
$validate = new validate();
include INCLUDE_DIR . "header.php";
include "views/contact-html.php";
include INCLUDE_DIR . "footer.php";



?>
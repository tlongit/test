<?php
	session_start();
	include("captcha.class.php");

	$captchaOBJ = new Captcha();
	$captchaOBJ->OutputCaptcha($width=80,$height=20,$length=5) // can be call also $capthaOBJ->OutputCaptcha(100,30,6) // param width, height, length respectively
?>
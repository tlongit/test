<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title>[TITLE]</title>
	<meta name="description" content="[DESCRIPTION]" />
    <meta name="keywords" content="[KEYWORD]" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="/images/favi.ico" />
	<link rel="stylesheet" href="/css/style.css" type="text/css" media="all" />
	<?php
	if($params[0]=='blog'){
	?>
	<link rel="stylesheet" href="/css/jquery.snippet.css" type="text/css" media="all" />
	<script src="/js/jquery-1.3.2.js" type="text/javascript"></script>
	<script src="/js/jquery.snippet.js" type="text/javascript"></script>
	<script src="/js/snippet.js" type="text/javascript"></script>
	<?php
	}
	?>
	<!--[if IE 6]>
		<link rel="stylesheet" href="/css/ie6.css" type="text/css" media="all" />
		<script src="/js/png-fix.js" type="text/javascript"></script>
	<![endif]-->
</head>
<body>
<!-- Header -->
<div id="header">
	<div class="shell">
		<h1 id="logo" class="notext"><a href="<?php echo DOMAIN;?>">Umee.net - Happy sharing</a></h1>
		<div id="navigation">
			<ul>
			    <li><a href="<?php echo DOMAIN;?>video" <?php echo $params[0]=='video'? 'class="active"':'';?>>Video</a></li>
                            <li><a href="<?php echo DOMAIN;?>blog" <?php echo $params[0]=='blog'? 'class="active"':'';?> >Blog</a></li>
			    <!--li><a href="#">About</a></li-->
			</ul>
		</div>
	</div>
</div>
<!-- End Header -->

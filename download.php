<?php
function quote_escape($string) {
        // Provides: <body text='black'>
        $string = str_replace('"', "&quot;", $string);
        $string = str_replace("'", "&#039;", $string);
        return $string;
    }
	$a = "chan'";
	$b = 'chuuoi" qua';
echo quote_escape($a);
echo '<br>';
echo quote_escape($b);
?>
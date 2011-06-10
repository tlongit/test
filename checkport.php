<?php

  $server  = "smtp.gmail.com";
  $port   = "465";
  
  $timeout = "10";

  if ($server and $port and $timeout) {
    $verbinding =  @fsockopen("$server", $port, $errno, $errstr, $timeout);
    
  }
  if($verbinding) {
    echo "$server is online<br>";
  }
  else {
    echo "$server is offline<br>";
  }
  
?>
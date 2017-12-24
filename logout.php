<?php

require_once('config.php');
session_start();

if(session_destroy()){
  session_destroy();
}
header('location: main.html');

 ?>

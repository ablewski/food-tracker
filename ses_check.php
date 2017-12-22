<?php

require_once('config.php');
session_start();
if((!isset($_SESSION['email'])) || (empty($_SESSION['email']))){
  header('location: login.php');
}else{
  $ses_check = $_SESSION['email'];
  $q = "SELECT id FROM users WHERE email = '$ses_check';
  $r = $c->query($q);
  if($r->num_rows==0){
    header('location: login.php');
  }
}

?>

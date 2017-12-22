<?php
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'tracker';

  $c = new mysqli($servername, $username, $password, $dbname);
  if($c->connect_error){
    die("Error: ".$c->connect_error);
  }
?>

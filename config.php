<?php
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'tracker';

  $c = new mysqli($servername, $username, $password, $dbname);
  if($c->connect_error){
    echo $c->connect_error;
  }
?>

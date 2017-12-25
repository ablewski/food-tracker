<?php

  require_once('config.php');
  session_start();


  if(isset($_SESSION['key'])){
    $bytes = random_bytes(8);
    $key = bin2hex($bytes);
    $key_hash = password_hash($key, PASSWORD_DEFAULT);
    $email = $_SESSION['email'];
    $q = "INSERT INTO users (email, hashed_key) VALUES ('$email' ,'$key_hash')";
    if($c->query($q) === TRUE){
      $_SESSION['success'] = "Registration successfull";
      $_SESSION['show_key'] = $key;
      unset($_SESSION['key']);
    }else{
      $_SESSION['failed'] = "Unable to register, try again later";
      unset($_SESSION['email']);
      unset($_SESSION['key']);
    }
  }else{
    unset($_SESSION['email']);
    unset($_SESSION['key']);
    header('location: register.php');

  }

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <div class='container'>
      <div class='header' id='to-check'>
        <?php
        if(isset($_SESSION['success'])){
          echo $_SESSION['success'];
          unset($_SESSION['success']);
        }
        if(isset($_SESSION['failed'])){
          echo $_SESSION['failed'];
          unset($_SESSION['failed']);
        }
         ?>
      </div>
      <div class='key'>
        <?php
        if(isset($_SESSION['show_key'])){
          echo $_SESSION['show_key'];
          unset($_SESSION['show_key']);
        }
        ?>
      </div>
      <div class='button-field'>
        <button onclick="check()">Continue</button>
        <script>
        function check(){
          var str_to_check = document.getElementById('to-check').innerHTML;
          var success = "successfull";
          if(str_to_check.includes(success)){
            window.location.href = 'index.php';
          }else{
            window.location.href = 'register.php';
          }
        }
      </script>
      </div>
    </div>
  </body>
</html>

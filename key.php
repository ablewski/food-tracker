<?php

  require_once('config.php');

  if(isset($_SESSION['key'])){
    unset($_SESSION['key']);
    $bytes = random_bytes(8);
    $key = hex2bin($bytes);
    $key_hash = password_hash($key, PASSWORD_DEFAULT);
    $q = "INSERT INTO users (email, hashed_key) VALUES ('$_SESSION['email']' ,'$key_hash')";
    if($c->query($q) === TRUE){
      $_SESSION['success'] = "Registration successfull";
      $_SESSION['show_key'] = $key;
    }else{
      $_SESSION['failed'] = "Unable to register, try again later";
      unset($_SESSION['email']);
    }
  }else{
    header('location: register.php');
  }

 ?>
<!DOCTYPE html>
<html>
  <head>

  </head>
  <body>
    <div class='container'>
      <div class='haeder'>
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
        <input type='button' value='Continue' onclick="check();">
        <script>
        function check(){
          var str_to_check = document.getElementsByClassName('header').innerHTML;
          var success = "successfull";
          if(string.includes(success)){
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

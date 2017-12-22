<?php

require_once('config.php');
session_start();

$error_flag = true;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $email;
  if((isset($_POST['email'])) || (!empty($_POST['email']))){
    $email = $_POST['email'];
    $s_email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if($s_email==$email){
      if(filter_var($s_email, FILTER_VALIDATE_EMAIL) === TRUE){
        $email = $s_email;
        $q = "SELECT id FROM users WHERE email = '$email'";
        $r = $c->query($q);
        if($r->num_rows>0){
          $error_flag = false;
          $_SESSION['err_email'] = "Email already used";
        }
      }else{
        $error_flag = false;
        $_SESSION['err_email'] = "Enter valid email";
      }
    }else{
      $error_flag = false;
      $_SESSION['err_email'] = "Enter valid email";
    }
  }else{
    $error_flag = false;
    $_SESSION['err_email'] = "Enter valid email";
  }
  if($error_flag == true){
    $q = "INSERT INTO users (email) VALUES ('$email')";
    if($c->query($q) === TRUE){
      header('location: key.php');
    }else{
      echo $_SESSION['err_email'] = "Something went wrong, try again later";
    }
  }
}

?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <div class='container'>
      <div class='header'>

      </div>
      <div class='rl-form'>
        <form method='POST' action=''>
          <input type='text' name='email' placeholder="Email">
          <?php
            if(isset($_SESSION['err_email']{
              echo "<span class='email-error'>".$_SESSION['err_email']."</span>";
              unset($_SESSION['err_email']);
            }
          ?>
          <input type='submit' value='Register'>
          <span class='tos-accept'>By clicking Register, I agree that I have read and accepted the <a href='#'>Terms and Conditions</a>.</span>
        </form>
      </div>
    </div>
  </body>
</html>

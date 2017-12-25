<?php
  require_once('config.php');
  session_start();

  if(isset($_SESSION['email'])){
    header('location: index.php');
  }

  if($_SERVER['REQUEST_METHOD'] === "POST"){
    if((isset($_POST['email'])) && (!empty($_POST['email']))){
      $email = $_POST['email'];
      if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        if((isset($_POST['key'])) && (!empty($_POST['key']))){
          $key = $_POST['key'];
          $q = "SELECT hashed_key FROM users WHERE email = '$email'";
          $r = $c->query($q);
          if($r->num_rows>0){
            $row = $r->fetch_assoc();
            $hash = $row['hashed_key'];
            if(password_verify($key, $hash)){
              $_SESSION['email'] = $email;
              header('location: index.php');
            }else{
              $_SESSION['err_log'] = "Invalid credentials";
            }
          }
        }else{
          $_SESSION['err_log'] = "Enter your password";
        }
      }else{
        $_SESSION['err_log'] = "Enter valid email";
      }
    }else{
      $_SESSION['err_log'] = "Enter your credentials";
    }
  }

 ?>
<!DOCTYPE html>
<html>
  <head>

  </head>
  <body>
    <div class='container'>
      <div class='header'>

      </div>
      <div class='login-form'>
        <form method="POST" action="">
          <input type='text' name='email' placeholder='Email'>
          <input type='password' name='key' placeholder='Key'>
          <input type='submit' value='Sign in'>

        </form>
      </div>
      <div class='error-box'>
        <?php
        if(isset($_SESSION['err_log'])){
          echo $_SESSION['err_log'];
          unset($_SESSION['err_log']);
        }
         ?>
      </div>
      <div class='help-box'>

      </div>
    </div>
  </body>
</html>

function check(){
  var str_to_check = document.getElementsByClassName('header').innerHTML;
  var success = "successfull";
  if(string.includes(success)){
    window.location.href = 'index.php';
  }else{
    window.location.href = 'register.php';
  }
}

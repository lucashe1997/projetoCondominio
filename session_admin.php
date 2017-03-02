<?php
   include('config.php');
   
   $user_check = $_SESSION['login_user'];


    if ($isuseradmin == 0) {
    header("location:index.php");
    }else{
    

   if(!isset($_SESSION['login_user'])){
      header("location:index.html");
   }
}
  ?>
  
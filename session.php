<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];

   $ses_sql = mysqli_query($conn,"SELECT ap, ID FROM user WHERE ap = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['ap'];
   $login_userID = $row['ID'];
   
   $admin_sql = "SELECT isadmin FROM user WHERE ap = '$user_check' ";;
   $result = mysqli_query($conn,$admin_sql); 
   $admin = mysqli_fetch_array($result);
   $isuseradmin = $admin['isadmin'];
     
   if(!isset($_SESSION['login_user'])){
      header("location:index.html");
   }

?>
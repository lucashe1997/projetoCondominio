<?php
   include("config.php");
   
   
  
      // username and password sent from form 
      
      $apartamento = mysqli_real_escape_string($conn,$_POST['apartamento']);
      $password = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT name FROM user WHERE ap = '$apartamento' and password = '$password'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
   session_start();
         $_SESSION['login_user'] = $apartamento;

         
         header("location: index.php");
		 echo("SIM");
      }else {
         $error = "Não encontramos seu cadastro. <br/> Por favor volte a página de Login e confirme suas informações. <br/><br/>Você será redirecionado. Em <span id='counter'>5</span> segundos";
		
}
      
  
   ?>
<html lang="pt-br">
      <head>
      <title>Entrando...</title>
	  <meta charset="UTF-8">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/default.css" />

   </head>
   
   <body>
   		
		<section id="login" class="wrapper special">
				<div class="container">
					<header class="major">
						<h2><a href="index.html">Puma</a></h2>
						<?php echo $error ;?>
					</header>
				</div>
		</section>
<script type="text/javascript">
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=0) {
        location.href = 'index.html';
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}
setInterval(function(){ countdown(); },1000);
</script>
</html>


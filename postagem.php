<?php
 
   include('session.php');
   
   $user_check = $_SESSION['login_user'];

   $admin_sql = "SELECT isadmin FROM user WHERE ap = '$user_check' ";;
   $result = mysqli_query($conn,$admin_sql); 
   $admin = mysqli_fetch_array($result);

   $_SESSION['admin'] = $admin['isadmin'];
    if (($_SESSION['admin']) == 1) {
    $adm_link = "<a href='admin.php' class='list-group-item'>Página do Administrador</a>";
    }else{$adm_link = "<span></span>";}
   
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body>
	  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand"><?php echo $login_session; ?> - Eco One Araucárias</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">Início</a></li>
            <li><a href="#contact">Contatos</a></li>
            <li><a href="#">Configurações</a></li>
            <li><a href="logout.php">Sair</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container">
            <div class="col-md-3">
				<div class="panel panel-body">
					<ul class="nav nav-pills nav-stacked">
					<li role="presentation"><a href="index.php">Inicio</a></li>
					<li role="presentation"><a href="index.php">Mensagens<span class="close glyphicon glyphicon-comment" aria-hidden="true"></span></a></li>
					<li role="presentation"><a href="votacao.php">Votações<span class="close glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a></li>
					<li role="presentation"><a href="calendario.php">Calendário<span class="close glyphicon glyphicon-calendar" aria-hidden="true"></span></a></li>
					<li role="presentation"><a href="#">Salão de Festas</a></li>
					<li role="presentation"><a href="#">Churrasqueira</a></li>
					<li role="presentation"><a href="newmsg.php">Sugestões / Reclamações<span class="close glyphicon glyphicon-bullhorn" aria-hidden="true"></span></a></li>

					</ul>
				</div>
            </div>

            <div class="col-md-6">
				<?php
				if(isset($_GET['postid'])) 
				{
					$postagemID = $_GET['postid'];
				}
				$Post = mysqli_query($conn,"SELECT * FROM postagens WHERE ID='$postagemID'");
				$row = mysqli_fetch_row($Post);
				$autor = mysqli_query($conn,"SELECT * FROM user WHERE ID='$row[5]'");
				$autor = mysqli_fetch_row($autor);
				//if ($row[5] == 1) {$isadminpost = 'panel-primary';}else{$isadminpost = 'panel-default';}
				echo '<div class=" panel">
						<div class="panel-heading"><h3>';
				echo $row[1];
				echo '</h3></div>
						  <div class="panel-body"><p>';
				echo	$row[3];
				echo	'</p>';

				echo	'<small class="pull-right">Por: '.$autor[1].', em: ';
				$db = $row[2];
				$timestamp = strtotime($db);
				setlocale(LC_TIME, "pt_BR");
				echo strftime("%d de %b de %Y", $timestamp);
				echo '</small></br></div><div class="panel-body">';
				?>
				<form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?postid='.$postagemID; ?>"><div class="input-group">
				  <input name="comentario" type="text" class="form-control" placeholder="Comentar..."required>
				  <span class="input-group-btn">
					<button class="btn btn-default" type="submit" name="submit">Enviar</button>
				  </span>
				</div></form>
				<?php 
 //criar comentario
				if(isset($_POST['submit'])){
				$texto = $_POST['comentario'];
				$newcomentario = "INSERT INTO postagens_comentarios (ID, texto, data, dequem,postID)
				VALUES (NULL, '$texto', DEFAULT, '$login_userID', '$postagemID')";
				if (mysqli_query($conn, $newcomentario)) {
					echo '<br><div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Sucesso!</strong> Novo comentário criada com sucesso.
</div>';
				}else{
					echo '<br><div class="alert alert-danger alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Erro!</strong> Houve um erro ao enviar o comentário.
</div>';
				}}
//remove comentario
				if(isset($_POST['multi'])) 
		{
			$multi = $_POST['multi'];
			$sql = "DELETE FROM postagens_comentarios WHERE id= ".$multi."";
			if (mysqli_query($conn, $sql)) {
		echo '<div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Sucesso!</strong> Mensagem apagada com sucesso.
</div>';
		}}
				?>
				<?php
				$comment = mysqli_query($conn,"SELECT * FROM postagens_comentarios WHERE postID='$postagemID' ORDER BY data DESC");
				$count = mysqli_num_rows($comment);
				echo '</br>Comentarios: <br>';
				for($postsnumber = 0;$postsnumber < $count;$postsnumber++){
					$row = mysqli_fetch_row($comment);
					$rowuser = mysqli_fetch_row(mysqli_query($conn,"SELECT * FROM user WHERE ID='$row[3]'"));
					echo '<div class=" panel">';
					echo '<div class="panel-body "><p>';
					if($row[3] == $login_userID){
						echo '<form method="POST" action="'.$_SERVER['PHP_SELF'].'?postid='.$postagemID.'">
				<button onClick=\'javascript: return confirm("Você quer apagar o comentário?");\' class="close" type="submit" name="multi" value="'.$row['0'].'"><span aria-hidden="true">&times;</span></button>
				</form>';
					}
					echo '<b>'.$rowuser[1].' diz:</br></b>';
					
					echo	$row[1];
					echo	'</p>';

					echo	'<small class="pull-right">';
					$db = $row[2];
					$timestamp = strtotime($db);
					setlocale(LC_TIME, "pt_BR");
					echo strftime("%d de %b de %Y", $timestamp);
					echo '</small></br>';
					echo '</div></div>';
				}
					echo '</div></div>';
				?>
            </div>
			
			<div class="col-md-3">
				<!-- coluna da direita-->
            </div>

        </div>
        </div>
	<footer class="footer">
      <div class="container">
        <p class="text-muted text-center">Eco One Araucárias | Desenvolvido por <b><a href="http://facebook.com/luquinhas10">LucasHe </a></b></p>
      </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
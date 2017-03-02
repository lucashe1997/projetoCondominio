<?php 
	include('session.php');
	include('session_admin.php');
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
	  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">Administrador - Eco One Araucárias</a>
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

      <div class="row">
			<div class="col-md-3">
				<div class="logo">
					<img src="images/logo.png"/>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading"><h3 class="panel-title">Menu de Administrador</h3></div>
					<a href="index.php" class="list-group-item">Página do Morador</a>
					<a href="newpost.php" class="list-group-item active">Nova Mensagem<span class="close glyphicon glyphicon-plus" aria-hidden="true"></span></a>
					<a href="votacao_admin.php" class="list-group-item">Nova Votação<span class="close glyphicon glyphicon-plus" aria-hidden="true"></span></a>
					<a href="admin.php" class="list-group-item">Mensagens<span class="close glyphicon glyphicon-comment" aria-hidden="true"></span></a>
					<a href="#" class="list-group-item">Salão de Festas</a>
					<a href="#" class="list-group-item">Churrasqueira</a>
					<a href="newmsg_admin.php" class="list-group-item">Sugestões / Reclamações<span class="close glyphicon glyphicon-bullhorn" aria-hidden="true"></span></a>
				</div>
			</div>
            <div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Nova Mensagem</h3>
				</div>
				<div class="panel-body">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label for="titulo">Titulo da Mensagem</label>
			<input type="text" id="titulo"name="tituloPost" class="form-control" required>
			<label for="mensagem">Mensagem</label>
			<textarea class="form-control" name="textoPost" rows="5" id="mensagem" required></textarea><br>
			<button type="submit" name="submit" class="btn btn-success">Publicar</button>
			</form>
				</div>
				</div>
				<?php 
 
				if(isset($_POST['submit'])) 
				{

				$titulo = $_POST['tituloPost'];
				$texto = $_POST['textoPost'];

				$newpost = "INSERT INTO postagens (id, tituloPost, dataPost, textoPost, anexo, whompost)
				VALUES (NULL, '$titulo', DEFAULT, '$texto', default, '$login_userID')";

				if (mysqli_query($conn, $newpost)) {
					echo '<div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Sucesso!</strong> Nova mensagem criada com sucesso.
</div>';
				} else {
					echo '<div class="alert alert-danger alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Erro!</strong> Houve um erro ao criar a mensagem.
</div>';
				}
				}
				?>
<?php 
		///licença
	if(isset($_POST['multi'])) 
		{
			$multi = $_POST['multi'];
			$sql = "DELETE FROM postagens WHERE id= ".$multi."";
			if (mysqli_query($conn, $sql)) {
		echo '<div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Sucesso!</strong> Mensagem apagada com sucesso.
</div>';
		}}
		///licença
	
?>
<?php 

	$check_post = "SELECT id FROM postagens";
	$result = mysqli_query($conn,$check_post);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	
	$tituloPost = mysqli_query($conn,"SELECT * FROM postagens ORDER BY dataPost DESC");
	
	$postsnumber = 0;
	while ($postsnumber < $count){
		$row = mysqli_fetch_row($tituloPost);
		echo '<div class="panel panel-default">
				<div class="panel-heading">
				
				<form method="POST" action="'?><?php echo $_SERVER['PHP_SELF']; ?><?php echo '">
				<button class="close" aria-label="Close" type="submit" name="multi" value="'?><?php echo $row['0'] ?><?php echo '"><span aria-hidden="true">&times;</span></button>
				</form>
				
					<h3 class="panel-title">';
		echo $row[1];
		echo '</h3>
				  </div>
				  <div class="panel-body"><p>';
		echo	$row[3];
		echo	'</p></div>';
		echo	'<div class="panel-footer text-right">';
		$db = $row[2];
		$timestamp = strtotime($db);
		echo date("d-m-Y", $timestamp);
		echo '</div></div>';
		$postsnumber = $postsnumber + 1;
		
	}

?>
            </div>
			
			<div class="col-md-3 mbhidden">
                <div class="panel panel-default">
                    <a href="#" class="list-group-item">Mensagens<span class="close glyphicon glyphicon-comment" aria-hidden="true"></span></a>
                    <a href="votacao.php" class="list-group-item">Votações<span class="close glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a>
                    <a href="#" class="list-group-item">Sugestões / Reclamações<span class="close glyphicon glyphicon-bullhorn" aria-hidden="true"></span></a>
                </div>
            </div>
        </div>
        </div>
		<footer class="footer">
      <div class="container">
        <p class="text-muted text-center">Eco One Araucárias | Desenvolvido por <b><a href="http://facebook.com/luquinhas10">LucasHe </a></b></p>
      </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

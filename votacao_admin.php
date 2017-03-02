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
					<a href="newpost.php" class="list-group-item">Nova Mensagem<span class="close glyphicon glyphicon-plus" aria-hidden="true"></span></a>
					<a href="votacao_admin.php" class="list-group-item active">Nova Votação<span class="close glyphicon glyphicon-plus" aria-hidden="true"></span></a>
					<a href="admin.php" class="list-group-item">Mensagens<span class="close glyphicon glyphicon-comment" aria-hidden="true"></span></a>
					<a href="#" class="list-group-item">Salão de Festas</a>
					<a href="#" class="list-group-item">Churrasqueira</a>
					<a href="newmsg_admin.php" class="list-group-item">Sugestões / Reclamações<span class="close glyphicon glyphicon-bullhorn" aria-hidden="true"></span></a>
				</div>
            </div>

            <div class="col-md-6">
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title">Resultados</h3>
				  </div>
				</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Nova Votação</h3>
				</div>
				<div class="panel-body">
					<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<label for="titulo">Titulo da Votação</label>
						<input type="text" id="titulo"name="tituloPost" class="form-control" required>
						<label for="mensagem">Descrição da Votação</label>
						<input type="text" id="mensagem"name="textoPost" class="form-control" required><br>
						<button type="submit" name="submit" class="btn btn-success">Publicar</button>
					</form>
				</div>
			</div>
<?php 
		///licença
	if(isset($_POST['multi'])) 
		{
			$multi = $_POST['multi'];
			$sql = "DELETE FROM respostas_enquete WHERE cod_pergunta='$multi'";
			$sql2 = "DELETE FROM perguntas_enquete WHERE ID='$multi'";
			if (mysqli_query($conn, $sql)) {
				if (mysqli_query($conn, $sql2)) {
		echo '<div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Sucesso!</strong> Mensagem apagada com sucesso.
</div>';
		}}}
		///licença
	
?>
			<?php
	$respostas = mysqli_query($conn,"SELECT * FROM perguntas_enquete ORDER BY data DESC");
	$count = mysqli_num_rows($respostas);
		
	for ($number = 0;$number< $count; $number++){
		$row = mysqli_fetch_array($respostas);
		echo '<div class="panel panel-default">
				<div class="panel-heading">
				
				<form method="POST" action="'?><?php echo $_SERVER['PHP_SELF']; ?><?php echo '">
				<button class="close" aria-label="Close" type="submit" name="multi" value="'.$row['ID'].'"><span aria-hidden="true">&times;</span></button>
				</form>
				
					<h3 class="panel-title">';
		echo $row['titulo'];
		echo '</h3>
				  </div>
				  <div class="panel-body"><p>';
		echo	$row['texto'].'</p><p>';
		
		$sql_resp = mysqli_query($conn,"SELECT * from respostas_enquete WHERE cod_pergunta = '$row[ID]' ORDER BY id");
		$rows_resp = mysqli_num_rows($sql_resp);	
		
		for($countr = 0; $countr < $rows_resp; $countr++){
			$row_resp = mysqli_fetch_array($sql_resp);
			$qnt_votos = mysqli_query($conn,"SELECT SUM(qnt_votos) AS Total FROM respostas_enquete WHERE cod_pergunta = '$row[ID]'");
			
			$total = mysqli_fetch_array($qnt_votos);
			$total = $total['Total'];
			$progress = ($row_resp['qnt_votos'] / $total) * 100;

			echo $row_resp['opcao'].':<br>';	
			echo '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width:'.$progress.'%;"> '.$row_resp['qnt_votos'].' Votos </div></div>';
		}
		
		echo	'</p></div>';
		echo	'<div class="panel-footer text-right">';
		$db = $row['data'];
		$timestamp = strtotime($db);
		echo date("d-m-Y", $timestamp);
		echo '</div></div>';
	
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
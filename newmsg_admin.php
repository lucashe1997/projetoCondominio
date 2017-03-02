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
					<li role="presentation" class="active"><a href="newmsg.php">Sugestões / Reclamações<span class="close glyphicon glyphicon-bullhorn" aria-hidden="true"></span></a></li>

					</ul>
				</div>
            </div>


            <div class="col-md-6">
				<div class="panel">
					<div class="panel-heading">
						<h4>Sugestões / Reclamações</h4>
					</div>
					<div class="panel-body">
<?php 
if(isset($_POST['submit'])){
				$texto = $_POST['resposta'];
				$id_msg = $_POST['id_msg'];
				$newcomentario = "INSERT INTO mensagem_resposta (ID, texto, data, id_msg)
				VALUES (NULL, '$texto', DEFAULT, '$id_msg')";
				
				if (mysqli_query($conn, $newcomentario)) {
					echo '<br><div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Sucesso!</strong> Novo comentário criada com sucesso.
</div>';
				} else {
					echo '<br><div class="alert alert-danger alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Erro!</strong> Houve um erro ao enviar o comentário.
</div>';
				}}
?>					
<?php 
	$check_msg = "SELECT id FROM mensagem"; 	//select rows messagem
	$result = mysqli_query($conn,$check_msg);		//select rows messagem
	$result = mysqli_num_rows($result);		//select rows messagem	
	$tituloPost = mysqli_query($conn,"SELECT * FROM mensagem ORDER BY data DESC ");
	echo '<div class="panel-group">';
	for($count=0;$count<$result;$count++){
		$row = mysqli_fetch_row($tituloPost);
		$resposta = mysqli_query($conn,"SELECT * FROM mensagem_resposta WHERE id_msg='$row[0]' ORDER BY data DESC");
		if($row[6] == 0){
		$countr = mysqli_num_rows($resposta);
		if($countr==0){
		
		echo '<div class="panel panel-warning">
				<div class="panel-heading" role="tab" id="heading'.$row[0].'">
				<form method="POST" action="'?><?php echo $_SERVER['PHP_SELF']; ?><?php echo '">
				<button class="close glyphicon glyphicon-trash" aria-label="Close" type="submit" name="multi" value="'?><?php echo $row['0'] ?><?php echo '"><span aria-hidden="true"></span></button>
				</form>
					<h3 class="panel-title">';
		echo '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$row[0].'" aria-expanded="true" aria-controls="collapse'.$row[0].'">';
		echo 'Assunto: '.$row[2];
		echo '</a><span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span>';
		echo '</h3>
				  </div>
				  <div id="collapse'.$row[0].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$row[0].'">
				  <div class="panel-body"><p>';
		$db = $row[5];
		$timestamp = strtotime($db);
		
		echo	'<b>Mensagem:</br></b>'.$row[3].'</br><small class="pull-right">'.strftime("%d de %b de %Y", $timestamp).'</small></br>';
		//responder messagem	
		echo '<form method="post">
			<div class="input-group">
				<input type="hidden" name="id_msg" value="'.$row[0].'">
				<input name="resposta" type="text" class="form-control" placeholder="Responder..."required>
				<span class="input-group-btn">
				<button class="btn btn-default" type="submit" name="submit">Enviar</button>
			  </span>
			</div>
		</form>';

//responder messagem
		
		
		echo	'</p></div>';
//		echo	'<div class="panel-footer text-right">';
//		$db = $row[5];
//		$timestamp = strtotime($db);
//		echo date("d-m-Y", $timestamp);
//		echo '</div></div>';		
		echo '</div></div>';		
	}}}
	echo '</div>';
	?>
					</div>
				</div>
            </div>
			
			<div class="col-md-3 mbhidden">
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
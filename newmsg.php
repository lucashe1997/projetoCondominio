<?php
   include('session.php');
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
					<li role="presentation" class="active"><a href="newmsg.php">Sugestões / Reclamações<span class="close glyphicon glyphicon-bullhorn" aria-hidden="true"></span></a></li>

					</ul>
				</div>
            </div>


            <div class="col-md-6">
				<div class="panel">
					<div class="panel-heading">
						<h4>Sugestões / Reclamações</h4>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addvisitante">Escrever Mensagem</button>
					</div>
					<div class="panel-body">

<div class="modal fade" id="addvisitante" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Adicionar Visitantes</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<label for="sobre">Assunto da Mensagem</label>
				<select name="sobre"  id="sobre" class="form-control" required>
				  <option value="Sugestão">Sugestão</option>
				  <option value="Reclamação">Reclamação</option>
				  <option value="Outro">Outro</option>
				</select>
				<label for="titulo">Titulo da Mensagem</label>
				<input type="text" id="titulo"name="tituloPost" class="form-control" required>
				<label for="mensagem">Mensagem</label>
				<textarea class="form-control" name="textoPost" rows="5" id="mensagem" required></textarea><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="submit" name="submit" class="btn btn-primary">Enviar mensagem</button>
			</form>
				<?php 
 
				if(isset($_POST['submit'])) 
				{

				$sobre = $_POST['sobre'];
				$titulo = $_POST['tituloPost'];
				$texto = $_POST['textoPost'];

				$newpost = "INSERT INTO mensagem (ID, sobre, titulo, texto, id_user, data)
				VALUES (NULL, '$sobre', '$titulo', '$texto', '$login_session', DEFAULT)";

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
      </div>
    </div>
  </div>
</div>
			<?php 
		///apagar mensagem
	if(isset($_POST['multi'])) 
		{
			$multi = $_POST['multi'];
			$sql = "UPDATE mensagem SET status = '1' WHERE id= ".$multi."";
			if (mysqli_query($conn, $sql)) {
		echo '<div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Sucesso!</strong> Mensagem apagada com sucesso.
</div>';
		}}
?>
			<?php include('messages.php')?>
			
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
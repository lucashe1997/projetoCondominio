<?php
   include('session.php');
?>
<!DOCTYPE html>
<html>
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
					<li role="presentation" class="active"><a href="index.php">Inicio<span class="pull-right badge">5</span></a></li>
					<li role="presentation"><a href="index.php">Mensagens<span class="close glyphicon glyphicon-comment" aria-hidden="true"></span></a></li>
					<li role="presentation"><a href="votacao.php">Votações<span class="close glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a></li>
					<li role="presentation"><a href="calendario.php">Calendário<span class="close glyphicon glyphicon-calendar" aria-hidden="true"></span></a></li>
					<li role="presentation"><a href="visitantes.php">Visitantes</a></li>
					<li role="presentation"><a href="#">Salão de Festas</a></li>
					<li role="presentation"><a href="#">Churrasqueira</a></li>
					<li role="presentation"><a href="newmsg.php">Sugestões / Reclamações<span class="close glyphicon glyphicon-bullhorn" aria-hidden="true"></span></a></li>

					</ul>
				</div>
            </div>

			<div class="col-md-6">
				<div class="panel">
					<div class="panel-heading">
						<h4>Mensagens</h4>
					</div>
					<div class="panel-body">
					<?php include('post.php');?>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="panel panel-body">
					<ul class="nav nav-pills nav-stacked">
					<li role="presentation" class="active"><a href="index.php" class="list-group-item active">Inicio</a></li>
					<li role="presentation"><a href="index.php">Mensagens<span class="close glyphicon glyphicon-comment" aria-hidden="true"></span></a></li>
					<li role="presentation"><a href="votacao.php">Votações<span class="close glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a></li>
					<li role="presentation"><a href="calendario.php">Calendário<span class="close glyphicon glyphicon-calendar" aria-hidden="true"></span></a></li>
					<li role="presentation"><a href="#">Salão de Festas</a></li>
					<li role="presentation"><a href="#">Churrasqueira</a></li>
					<li role="presentation"><a href="newmsg.php">Sugestões / Reclamações<span class="close glyphicon glyphicon-bullhorn" aria-hidden="true"></span></a></li>

					</ul>
				</div>
            </div>
        </div>

	<footer class="footer">
      <div class="container">
        <p class="text-muted text-center">Eco One Araucárias | Desenvolvido por <b><a href="http://facebook.com/luquinhas10">LucasHe </a></b></p>
      </div>
    </footer>
 <?php include('scripts.php');?>
  </body>
</html>
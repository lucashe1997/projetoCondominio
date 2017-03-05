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
	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

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
					<li role="presentation" class="active"><a href="visitantes.php">Visitantes</a>			</li>
					<li role="presentation"><a href="#">Salão de Festas</a></li>
					<li role="presentation"><a href="#">Churrasqueira</a></li>
					<li role="presentation"><a href="newmsg.php">Sugestões / Reclamações<span class="close glyphicon glyphicon-bullhorn" aria-hidden="true"></span></a></li>

					</ul>
				</div>
            </div>

			<div class="col-md-6">
				<div class="panel">
					<div class="panel-heading">
						<h4>Liberação de visitantes</h4>
						<button type="button" class="btn btn-primary col-md-4" data-toggle="modal" data-target="#addvisitante">Adicionar Visitantes</button>
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
			<div class="form-group">
				<label for="vnome" class="control-label">Nome dos Visitantes:</label>
				<textarea class="form-control" id="vnome" name="vnome" placeholder="Marcos Silva, Lucas Henrique, ..."></textarea>
			</div>
			<div class="row">
			<div class="form-group col-md-6">
				<label for="vonde" class="control-label">Aonde:</label>
				<input type="text" class="form-control" id="vonde" name="vonde" placeholder="Salão/Apartamento/Churrasqueira">
			</div>
			<div class="form-group col-md-6">
				<label for="dtp_input2" class="control-label">Data Permitida:</label>
				<div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					<input class="form-control" size="16" name="vdata" type="text" value="" >
				</div>
			</div>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="submit" name="submit" class="btn btn-primary">Salvar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php 
				if(isset($_POST['submit'])) 
				{

				$nomes = $_POST['vnome'];
				$data = $_POST['vdata'];
				$onde = $_POST['vonde'];
				
				$newv = "INSERT INTO visitantes (ID, id_ap, nomes, aonde, quando)
				VALUES (NULL, '$login_userID', '$nomes', '$onde', '$data')";

				if (mysqli_query($conn, $newv)) {
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
	<footer class="footer">
      <div class="container">
        <p class="text-muted text-center">Eco One Araucárias | Desenvolvido por <b><a href="http://facebook.com/luquinhas10">LucasHe </a></b></p>
      </div>
    </footer>
 <?php include('scripts.php');?>
 <script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.pt-BR.js" charset="UTF-8"></script>
<script type="text/javascript">
	$('.form_date').datetimepicker({
        language:  'pt-BR',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
</script>
  </body>
</html>
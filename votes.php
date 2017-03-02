<?php
	if(isset($_POST['submit'])) 
	{

		$multi_pergunta = $_POST['pergunta'];
		$multi = $_POST['radio'];
		$sql = "UPDATE respostas_enquete SET qnt_votos = qnt_votos + 1 WHERE opcao= '$multi'";
		
		$can_vote = mysqli_query($conn,"SELECT * from voted WHERE user_id= '$login_userID' and cod_pergunta = '$multi_pergunta'");
		$can_vote = mysqli_num_rows($can_vote);
		if($can_vote==0){
		if (mysqli_query($conn, $sql)) {
			echo '<div class="alert alert-success alert-dismissable">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Sucesso!</strong> Mensagem apagada com sucesso.
				</div>';
			mysqli_query($conn,"INSERT INTO voted (ID, cod_pergunta, user_id) VALUES (NULL, '$multi_pergunta', '$login_userID') ");
			header ('Location: votacao.php');
		}
	}}
	
?>
<?php

	$sql = mysqli_query($conn,"SELECT * from perguntas_enquete ORDER BY data DESC");
	$rows = mysqli_num_rows($sql);

	for($count = 0; $count < $rows; $count++){
	
		$row = mysqli_fetch_array($sql);
		$cod_pergunta = $row['ID'];
		$can_vote = mysqli_query($conn,"SELECT * from voted WHERE user_id= '$login_userID' and cod_pergunta = '$cod_pergunta'");
		$can_vote = mysqli_num_rows($can_vote);
		
			if($can_vote==0){
				echo '<div class="panel ">
						<div class="panel-heading">
							<h3 class="panel-title">'.$row['titulo'].'</h3></div><div class="panel-body">';
				
				$sql_resp = mysqli_query($conn,"SELECT * from respostas_enquete WHERE cod_pergunta = '$cod_pergunta' ORDER BY id");
				$rows_resp = mysqli_num_rows($sql_resp);	
				echo '<p>'.$row['texto'].'</p>';
				
				echo '<form method="POST" name="" action="'. $_SERVER['PHP_SELF'] .'">';
				echo '<input type="hidden" name="pergunta" value="'.$cod_pergunta.'">';
				for($countr = 0; $countr < $rows_resp; $countr++){
					$row_resp = mysqli_fetch_array($sql_resp);
					echo '<div class="form-check"><label class="form-check-label">';
					echo '<input class="form-group" type="radio" name="radio" value="'.$row_resp['opcao'].'" checked> '.$row_resp['opcao'];
					echo '</label></div>';
				}
				$db = $row['data'];
				$timestamp = strtotime($db);
				echo '<br><button class="btn btn-defaul" type="submit" name="submit" value="'.$row['0'].'">Votar</button></form></div><div class="panel-footer text-right">'.date("d-m-Y", $timestamp).'</div></div>';
				
			}else{echo '<div class="alert alert-success" role="alert">Não há perguntas disponíveis no momento</div>';}
			
	
	}
		
?>
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title">Resultados</h3>
				  </div>
				</div>

<?php

	$respostas = mysqli_query($conn,"SELECT * FROM perguntas_enquete WHERE ID IN (SELECT cod_pergunta FROM voted WHERE user_id = '$login_userID') ORDER BY data DESC");
	$count = mysqli_num_rows($respostas);
	if($count!=0){	
	for ($number = 0;$number< $count; $number++){
		$row = mysqli_fetch_array($respostas);
		echo '<div class="panel panel-default">
				<div class="panel-heading">
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
	}else{
				echo '<div class="alert alert-success" role="alert">Não há resultados disponíveis no momento</div>';
	}
		
?>
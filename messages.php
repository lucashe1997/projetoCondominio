<?php 
		///apagar mensagem
	if(isset($_POST['multi'])) 
		{
			$multi = $_POST['multi'];
			$sql = "DELETE FROM mensagem WHERE id= ".$multi."";
			if (mysqli_query($conn, $sql)) {
		echo '<div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Sucesso!</strong> Mensagem apagada com sucesso.
</div>';
		}}
?>	
<?php 
	
	$check_msg = "SELECT id FROM mensagem WHERE id_user='$login_session'"; 	//select rows messagem
	$result = mysqli_query($conn,$check_msg);		//select rows messagem
	$result = mysqli_num_rows($result);		//select rows messagem	
	$tituloPost = mysqli_query($conn,"SELECT * FROM mensagem WHERE id_user='$login_session' ORDER BY data DESC ");
	echo '<div class="panel-group">';
	for($count=0;$count<$result;$count++){
		$row = mysqli_fetch_row($tituloPost);
		$resposta = mysqli_query($conn,"SELECT * FROM mensagem_resposta WHERE id_msg='$row[0]' ORDER BY data DESC");
		$countr = mysqli_num_rows($resposta);
		if($countr>0){$status='success';$statusIcon='ok';}else{$status='warning';$statusIcon='hourglass';}
		
		echo '<div class="panel panel-'.$status.'">
				<div class="panel-heading" role="tab" id="heading'.$row[0].'">
				<form method="POST" action="'?><?php echo $_SERVER['PHP_SELF']; ?><?php echo '">
				<button class="close glyphicon glyphicon-trash" aria-label="Close" type="submit" name="multi" value="'?><?php echo $row['0'] ?><?php echo '"><span aria-hidden="true"></span></button>
				</form>
					<h3 class="panel-title">';
		echo '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$row[0].'" aria-expanded="true" aria-controls="collapse'.$row[0].'">';
		echo 'Assunto: '.$row[2];
		echo '</a><span class="glyphicon glyphicon-'.$statusIcon.'" aria-hidden="true"></span>';
		echo '</h3>
				  </div>
				  <div id="collapse'.$row[0].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$row[0].'">
				  <div class="panel-body"><p>';
		$db = $row[5];
		$timestamp = strtotime($db);
		
		echo	'<b>Mensagem:</br></b>'.$row[3].'</br><small class="pull-right">'.strftime("%d de %b de %Y", $timestamp).'</small></br>';
		//select resposta messagem
			
			if($countr>0){
			for($postsnumber = 0;$postsnumber < $countr;$postsnumber++){
				$rowr = mysqli_fetch_row($resposta);
				$dbr = $rowr[2];
				$timestampr = strtotime($dbr);
				echo	'<b>Resposta:</br></b>'.$rowr[1].'</br><small class="pull-right">'.strftime("%d de %b de %Y", $timestampr).'</small>';
		//		$db = $row[2];
		//		$timestamp = strtotime($db);
		//		setlocale(LC_TIME, "pt_BR");
		//		echo strftime("%d de %b de %Y", $timestamp);
			}}
//select resposta messagem
		
		
		echo	'</p></div>';
//		echo	'<div class="panel-footer text-right">';
//		$db = $row[5];
//		$timestamp = strtotime($db);
//		echo date("d-m-Y", $timestamp);
//		echo '</div></div>';		
		echo '</div></div>';		
	} 
	echo '</div>';
	?>
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

	$check_msg = "SELECT id FROM mensagem WHERE id_user='$login_session'";
	$result = mysqli_query($conn,$check_msg);
	$result = mysqli_num_rows($result);
	
	$tituloPost = mysqli_query($conn,"SELECT * FROM mensagem WHERE id_user='$login_session' ORDER BY data DESC ");
	echo '<div class="panel-group">';
	for($count=0;$count<$result;$count++){
		$row = mysqli_fetch_row($tituloPost);
		echo '<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="heading'.$row[0].'">
				<form method="POST" action="'?><?php echo $_SERVER['PHP_SELF']; ?><?php echo '">
				<button class="close" aria-label="Close" type="submit" name="multi" value="'?><?php echo $row['0'] ?><?php echo '"><span aria-hidden="true">&times;</span></button>
				</form>
					<h3 class="panel-title">';
		echo '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$row[0].'" aria-expanded="true" aria-controls="collapse'.$row[0].'">';
		echo 'Assunto: '.$row[2];
		echo '</a>';
		echo '</h3>
				  </div>
				  <div id="collapse'.$row[0].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$row[0].'">
				  <div class="panel-body"><p>';
		echo	$row[3];
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
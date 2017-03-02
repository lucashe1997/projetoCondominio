<?php  
   if(!isset($_SESSION['login_user'])){
      header("location: index.php");
   }
?>
<?php 
	
	
	$Post = mysqli_query($conn,"SELECT * FROM postagens ORDER BY dataPost DESC");
	$count = mysqli_num_rows($Post);
	
	for($postsnumber = 0;$postsnumber < $count;$postsnumber++){
		$row = mysqli_fetch_row($Post);
		$comment = mysqli_query($conn,"SELECT * FROM postagens_comentarios WHERE postID='$row[0]'");
		$comment = mysqli_num_rows($comment);
		$autor = mysqli_query($conn,"SELECT * FROM user WHERE ID='$row[5]'");
		$autor = mysqli_fetch_row($autor);
		echo '<div class="panel"><div class="media">
				<div class="media-body"><h4 class="media-heading">';
		echo '<a href="postagem.php?postid='.$row[0].'">'.$row[1].'</a></h4>';
		echo	$row[3];
		echo	'</br></br><small class="pull-right">Por: '.$autor[1].', em: ';
		$db = $row[2];
		$timestamp = strtotime($db);
		setlocale(LC_TIME, "pt_BR");
		echo strftime("%d de %b de %Y", $timestamp);
		echo '</small></br>';
		echo	'<a href="postagem.php?postid='.$row[0].'">'.$comment.' Comentários</a>';
		echo '</div></div></div>';
	}

?>
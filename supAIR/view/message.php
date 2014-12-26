<?php
	$isShared = ($message->m_parent != $message->m_emetteur) ? true : false;
	$userPicture = ($isShared) ? $message->m_parent->avatar : $message->m_emetteur->avatar;
	$author = ($isShared) ? $message->m_parent : $message->m_emetteur;

	//if($userPicture = "")
		$userPicture = "images/dummy.jpg";
?>

<article id="message">
	<?php
		if($isShared)
			echo '<p id="shared">
					Ce message a été partagé par '.$message->m_emetteur->prenom.' '.$message->m_emetteur->nom.'
				</p>';
	?>

	<div id="content">
		<?php
			echo '<img src="'.$userPicture.'" alt="photo de profil" width="48px" height="48px" />';
		?>
		<p id="author">
			<?php
				echo '<span id="nameSurname">'.$author->prenom." ".$author->nom.'</span> <span id="pseudo">'.$author->identifiant.'</span>';
			?>
		</p><br/>
		<p id="text">
			<?php
				$post=$message->m_post;
				include("post.php");
			?>
		</p>
		<p id="footer">
			<?php
				$likeNumber = ($message->aime) ? $message->aime : 0;
				echo $likeNumber." personnes aime(nt) ça.<br/>";
			?>
		</p>
	</div>
</article>

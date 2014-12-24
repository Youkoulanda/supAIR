<div id="message">
	<div id="userPicture">
		<?php	
			$userPictureLink = ($message->m_parent != $message->m_emetteur) ? $message->m_parent->avatar : $message->m_emetteur->avatar;
			echo '<img src="'.$userPictureLink.'" alt="photo de profil" width="48px" height="48px" />';
		?>
	</div>
	<div id="content">
		<?php
			if($message->m_parent!=$message->m_emetteur)
				echo "Posté par: ".$message->m_parent->identifiant."<br>";
			echo "De: ".$message->m_emetteur->identifiant."<br>";
			//cho "Vers: ".$message->m_destinataire->identifiant."<br>";
			$likeNumber = ($message->aime) ? $message->aime : 0;
			echo $likeNumber." personnes aime(nt) ça.<br>";
			$post=$message->m_post;
			include("post.php");
		?>
	</div>
</div>

<?php
	$isShared = ($message->m_parent != $message->m_emetteur) ? true : false;

	$author = $message->m_parent;

	$userPicture = ($isShared) ? $message->m_parent->avatar : $message->m_emetteur->avatar;
	$author = ($isShared) ? $message->m_parent->identifiant : $message->m_emetteur->identifiant;

	//if($userPicture = "")
		$userPicture = "images/dummy.jpg";
?>

<article id="message">
	<div id="userPicture">
		<?php
			echo '<img src="'.$userPicture.'" alt="photo de profil" width="48px" height="48px" />';
		?>
	</div>
	<div id="header">
		<?php
			if($isShared)
				echo '<p id="shared">
						Ce message a été partagé par '.$message->m_emetteur.'
					</p>';
			echo $author."<br/>";
		?>
	</div>
	<div id="content">
		<?php
			$post=$message->m_post;
			include("post.php");
		?>
	</div>
	<div id="footer">
		<?php
			$likeNumber = ($message->aime) ? $message->aime : 0;
			echo $likeNumber." personnes aime(nt) ça.<br/>";
		?>
	</div>
</article>

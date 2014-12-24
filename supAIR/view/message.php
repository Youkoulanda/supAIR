<?php
	echo '<div id="message">';
	if($message->m_parent!=$message->m_emetteur)
		echo "Posté par: ".$message->m_parent->identifiant."<br>";
	echo "De: ".$message->m_emetteur->identifiant."<br>";
	echo "Vers: ".$message->m_destinataire->identifiant."<br>";
	$likeNumber = ($message->aime) ? $message->aime : 0;
	echo $likeNumber." personnes aime(nt) ça.<br>";
	$post=$message->m_post;
	include("post.php");
	echo '</div>';
?>

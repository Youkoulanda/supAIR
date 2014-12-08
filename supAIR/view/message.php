<?php

	if($message->m_parent!=$message->m_emetteur)
		echo "Posté par: ".$message->m_parent->identifiant."<br>";
	echo "De: ".$message->m_emetteur->identifiant."<br>";
	echo "Vers: ".$message->m_destinataire->identifiant."<br>";
	echo $message->aime." personnes aiment ça<br>";
	$post=$message->m_post;
	include("post.php");
?>

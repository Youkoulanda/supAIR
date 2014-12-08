<?php

	if($message->m_parent!=$message->m_emetteur)
		echo "Posté par: ".$message->m_parent->identifiant."<br>";
	echo "De: ".$message->m_emetteur->identifiant."<br>";
	echo "Vers: ".$message->m_destinataire->identifiant."<br>";
	echo $message->m_post->texte."<br>";
	echo "<img src=\"".$message->m_post->image."\"><br>";

?>

<?php
//Auteur: Aurélien Rivet
//but: vue fournissant les derniers messages ajoutés, sera appelé par des requêtes ajax suite à certains évènements
	foreach(messageTable::getNewerThan($context->lastID) as $message)
	{
		if($message->m_parent!=$message->m_emetteur)
			echo "Posté par: ".$message->m_parent->identifiant."<br>";
		echo "De: ".$message->m_emetteur->identifiant."<br>";
		echo "Vers: ".$message->m_destinataire->identifiant."<br>";
		echo $message->aime." personnes aiment ça<br>";
		$post=$message->m_post;
		include("post.php");
	}

?>

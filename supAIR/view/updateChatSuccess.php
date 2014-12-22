<?php

//Auteur: Daniel Salas
//But: affichage des chats plus récent qu'un certain id

	foreach(chatTable::getNewerThan($context->lastID) as $chat)
	{
		echo $chat->c_emetteur->identifiant.": ";
		$post=$chat->c_post;
		include("post.php");
	}
?>

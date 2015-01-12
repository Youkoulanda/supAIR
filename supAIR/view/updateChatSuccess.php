<?php

//Auteur: Daniel Salas
//But: affichage des chats plus récent qu'un certain id
	$message1="";
	foreach(chatTable::getNewerThan($context->lastChatID) as $chat)
	{
		$message1.='<a href="supAIR.php?action=viewProfile&id='.$chat->c_emetteur->id.'">'.$chat->c_emetteur->identifiant."</a>: ";
		$post=$chat->c_post;
		ob_start();
		include("post.php");
		$message1.=ob_get_clean();
	}
	echo json_encode(array('message1' => $message1, 'message2' => $chat->id));
?>

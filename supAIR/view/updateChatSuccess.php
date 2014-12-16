<?php

	foreach(chatTable::getNewerThan($context->lastID) as $chat)
	{
		echo $chat->c_emetteur->identifiant.": ";
		$post=$chat->c_post;
		include("post.php");
	}

?>

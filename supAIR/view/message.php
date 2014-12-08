<?php

	$message=messageTable::getMessageById($_REQUEST["id"]);
	
	echo $message->m_parent."<br>";
	echo $message->m_expediteur."<br>";
	echo $message->m_destinataire."<br>";
	echo $message->m_post."<br>";

?>
<?php
//Auteur: Daniel Salas
//Objectif: Créer la vue contenant les 10 derniers chats et le champ pour envoyer un chat
	foreach(chatTable::getTenLastChats() as $chat)
	{
		echo $chat->c_emetteur->identifiant.": ";
		$post=$chat->c_post;
		include("post.php");
	}
?>
<form>
		<input type="text" name="message" placeholder="Envoyer un chat"/> <input id="chatSubmit" type="button" value="Envoyer"/>
</form>
<script src="js/chatPosting.js" type="text/javascript"></script>

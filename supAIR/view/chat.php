<?php
//Auteur: Daniel Salas
//Objectif: Créer la vue contenant les 10 derniers chats et le champ pour envoyer un chat
	foreach(chatTable::getTenLastChats() as $chat)
		echo $chat->c_post->texte."<br>";
?>
<form>
		<input type="text" name="message" placeholder="Envoyer un chat">
</form>
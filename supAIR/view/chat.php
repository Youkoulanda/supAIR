<div id="chatList">
<?php
//Auteur: Daniel Salas
//Objectif: Créer la vue contenant les 10 derniers chats et le champ pour envoyer un chat
	foreach(chatTable::getTenLastChats() as $chat)
	{
		echo '<a href="supAIR.php?action=viewProfile&id='.$chat->c_emetteur->id.'">'.$chat->c_emetteur->identifiant."</a>: ";
		$post=$chat->c_post;
		include("post.php");
	}
	echo '<script type="text/javascript"> var lastChatID = '.$chat->id.'; </script>';
?>
</div>
<form id="addChat">
		<input type="hidden" id="senderID" name="senderID" value="<?php echo $context->getSessionAttribute("id") ?>" />
		<input type="text" id="chatText" name="chatText" required placeholder="Envoyer un chat"/> <input type="submit" value="Envoyer"/>
</form>

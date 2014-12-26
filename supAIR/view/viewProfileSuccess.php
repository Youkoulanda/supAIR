<?php
//Auteur: Aurélien Rivet
//Objectifs: Afficher le profil d'un utilisateur
?>

<section id="profil">
	<div id="pseudo">
		<?php
			if($context->viewProfileUser->id == $context->getSessionAttribute("id"))
				echo "Votre profil";
			else
				echo "Profil de ".$context->viewProfileUser->identifiant."<br/>";
		?>
	</div>

	<?php
		$srcImage = ($context->viewProfileUser->avatar == "") ? "images/dummy.jpg" : $context->viewProfileUser->avatar;
		echo '<img height="140px" src="'.$srcImage.'" alt="photo de profil de '.$context->viewProfileUser->identifiant.'"/><br/>';
		echo $context->viewProfileUser->prenom.' '.$context->viewProfileUser->nom.'<br/>';
		echo date("d-m-Y", strtotime($context->viewProfileUser->date_de_naissance)).'<br/>';
		echo $context->viewProfileUser->statut.'<br/>';
	?>
</section>

<?php
	if($context->viewProfileUser->id == $context->getSessionAttribute("id"))
		echo
			'<form>
				<input type="text" name="statut" placeholder="Changez votre statut si vous voulez">
				<input type="submit" value="Valider">
			</form>';
			echo '<br/><br/>
			<form method="post" id="addMessage">
				<input type="hidden" id="senderID" name="senderID" value="'.$context->getSessionAttribute("id").'" />
				<input type="hidden" id="recipientID" name="recipientID" value="'.$context->viewProfileUser->id.'" />
				<input type="text" name="messageText" placeholder="Envoyez un message &agrave; '.$context->viewProfileUser->identifiant.'">
				<input type="submit" value="Envoyer">
			</form>';
?>
<section id="messageList">
	<?php
		foreach(messageTable::getMessagesByDestinataire($context->viewProfileUser->id) as $message)
			include($nameApp."/view/message.php");
	?>
</section>

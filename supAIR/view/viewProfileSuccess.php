<?php
//Auteur: Aurélien Rivet
//Objectifs: Afficher le profil d'un utilisateur
?>

<section id="profil">
	<div id="pseudo">
		<?php
			if($context->viewProfileUser->id == $context->getSessionAttribute("id"))
				echo "Votre Profil";
			else
				echo "Profil de ".$context->viewProfileUser->identifiant;
		?>
	</div>

	<?php
		echo '<img height="140px" src="'.$context->srcAvatar.'" alt="photo de profil de '.$context->viewProfileUser->identifiant.'"/><br/>';
		echo $context->viewProfileUser->prenom.' '.$context->viewProfileUser->nom.'<br/>';
		echo $context->userBirthdate.'<br/>';
		echo $context->viewProfileUser->statut.'<br/>';
	?>
</section>

<?php
	if($context->viewProfileUser->id == $context->getSessionAttribute("id"))
		echo
			'<form id="changeStatus">
				<input type="text" name="statut" placeholder="Changez votre statut si vous voulez">
				<input type="submit" value="Valider">
			</form>';

	echo '<br/><br/>';
?>
<section id="messageList">
	<form method="post" id="addMessage">
		<input type="hidden" id="senderID" name="senderID" value="<?php echo $context->getSessionAttribute("id") ?>" />
		<input type="hidden" id="recipientID" name="recipientID" value="<?php echo $context->viewProfileUser->id ?>" />
		<textarea rows="1" maxlength="2000" name="messageText" required placeholder="Envoyez un message &agrave; <?php echo $context->viewProfileUser->identifiant; ?>"></textarea>
		<input type="submit" value="Envoyer">
	</form>

	<?php
		foreach($context->messages as $message)
			include($nameApp."/view/message.php");
	?>
</section>

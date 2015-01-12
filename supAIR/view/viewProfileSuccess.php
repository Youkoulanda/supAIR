<?php
//Auteur: Aurélien Rivet
//Objectifs: Afficher le profil d'un utilisateur
?>

<section id="profil">

	<?php
		echo '<img height="140px" src="'.$context->srcAvatar.'" alt="photo de profil de '.$context->viewProfileUser->identifiant.'"/><br/>';
	?>
	<div id="pseudo">
		<?php
			echo $context->viewProfileUser->identifiant;
		?>
	</div>
	<div id="personalData">
		<?php
			echo $context->viewProfileUser->prenom.' '.$context->viewProfileUser->nom.'<br/>';
			echo $context->userBirthdate.'<br/>';
		?>
	</div>
	<p id="status">
		<?php echo $context->viewProfileUser->statut; ?>
	</p>
</section>

<?php
	if($context->viewProfileUser->id == $context->getSessionAttribute("id"))
		echo
			'<form id="changeStatus">
				<input type="text" name="newStatus" placeholder="Changez votre statut si vous voulez" />
				<input type="hidden" name="viewProfileUserID" value="'.$context->viewProfileUser->id.'" />
				<input type="submit" value="Valider" />
			</form>';
?>
<section id="messageList">
	<form method="post" id="addMessage" enctype="multipart/form-data">
		<input type="hidden" id="senderID" name="senderID" value="<?php echo $context->getSessionAttribute("id") ?>" />
		<input type="hidden" id="recipientID" name="recipientID" value="<?php echo $context->viewProfileUser->id ?>" />
		<textarea rows="1" maxlength="2000" name="messageText" required placeholder="Envoyez un message &agrave; <?php echo $context->viewProfileUser->identifiant; ?>"></textarea>
		<input type="file" accept="image/*" name="picture" />
		<input type="button" value="Ajouter une image" />
		<input type="submit" value="Envoyer">
	</form>

	<?php
		foreach($context->messages as $message)
			include($nameApp."/view/message.php");
	?>
</section>

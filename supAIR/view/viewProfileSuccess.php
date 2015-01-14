<?php
//Auteur: Aurélien Rivet
//Objectifs: Afficher le profil d'un utilisateur
?>

<section id="profil">

	<img height="140px" src="<?php echo $context->srcAvatar; ?>" alt="photo de profil de <?php echo $context->viewProfileUser->identifiant; ?>" />
	<div id="pseudo">
		<?php
			echo $context->viewProfileUser->identifiant;
		?>
	</div>
	<div id="personalData">
		<?php
			echo $context->viewProfileUser->prenom.' '.$context->viewProfileUser->nom.'<br/>';
			echo $context->userBirthdate;
		?>
	</div>
	<p id="status">
		<?php echo $context->viewProfileUser->statut; ?>
	</p>
	<?php
		if($context->viewProfileUser->id == $context->getSessionAttribute("id"))
		{
	?>
			<form id="changeStatus">
				<input type="text" name="newStatus" placeholder="Changez votre statut si vous voulez" />
				<input type="submit" value="Valider" />
			</form>
	<?php
		}
	?>
</section>

<section id="messageList">
	<form method="post" id="addMessage" enctype="multipart/form-data">
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

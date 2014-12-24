<?php
//Auteur: Aurélien Rivet
//Objectifs: Afficher le profil d'un utilisateur
?>

<article id="profil">
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
</article>

<?php
	if($context->viewProfileUser->id == $context->getSessionAttribute("id"))
		echo
			'<form>
				<input type="text" name="statut" placeholder="Changez votre statut si vous voulez">
				<input type="submit" value="Valider">
			</form>';
			echo '<br/><br/>
			<form>
				<input type="text" name="messageto" placeholder="Envoyez un message &agrave; '.$context->viewProfileUser->identifiant.'">
				<input type="submit" value="Envoyer">
			</form>';

	foreach(messageTable::getMessagesByDestinataire($context->viewProfileUser->id) as $message)
		include($nameApp."/view/message.php");
?>

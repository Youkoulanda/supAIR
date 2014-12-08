<?php 
//Auteur: Aurélien Rivet
//Objectifs: Afficher le profil d'un utilisateur

if($context->viewProfileUser->id == $context->getSessionAttribute("id"))
	echo "Votre profil";
else
	echo "Profil de ".$context->viewProfileUser->identifiant;

echo '<img src="'.$context->viewProfileUser->avatar.'" alt="photo de profil de '.$context->viewProfileUser->identifiant.'"/><br/>';
echo $context->viewProfileUser->nom.' '.$context->viewProfileUser->prenom.'<br/>';
echo $context->viewProfileUser->date_de_naissance.'<br/>';
echo $context->viewProfileUser->statut.'<br/>';
echo '<form>
		<input type="text" name="statut" placeholder="Changez votre statut si vous voulez">
		<input type="submit" value="Valider">
	 </form>';

foreach(messageTable::getMessagesByDestinataire($context->viewProfileUser->id) as $message)
	include($nameApp."/view/message.php");
?>

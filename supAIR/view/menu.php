<?php
//Auteur: Daniel Salas
//Objectif: Créer la vue contenant le menu vers les profils des utilisateurs
	echo '<a href="'.$nameApp.'.php?action=viewProfile&id='.$context->getSessionAttribute("id").'"><li>Mon profil</li></a>';
	foreach(utilisateurTable::getUsers() as $user)
		if($user->id != $context->getSessionAttribute("id"))
			echo '<a href="'.$nameApp.'.php?action=viewProfile&id='.$user->id.'"><li>'.$user->identifiant.'</li></a>';
?>

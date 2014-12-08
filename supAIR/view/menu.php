<?php
//Auteur: Daniel Salas
//Objectif: Créer la vue contenant le menu vers les profils des utilisateurs
	echo "<a href=\"supAIR.php?action=viewProfile&id=".$context->getSessionAttribute("id")."\">Mon profil</a><br>";
	foreach(utilisateurTable::getUsers() as $user)
		echo "<a href=\"supAIR.php?action=viewProfile&id=".$user->id."\">".$user->identifiant."</a><br>";
?>
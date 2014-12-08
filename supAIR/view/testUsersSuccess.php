Liste des gens:<br>
<?php

	foreach($context->users as $user)
		echo $user->id.'<br>';
 
?>
Voilà le nom de monsieur numéro 9:
<?php
	echo $context->usernine->nom.'<br>';
?>

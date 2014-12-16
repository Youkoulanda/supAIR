<p>
	Vous devez être connecté pour accéder à cette page. Du coup connectez-vous en utilisant le formulaire suivant:
</p>

<form action="supAIR.php?action=login" method="post">
	<?php
		if($context->getSessionAttribute("login")==null)
		{
			echo '<input type="text" placeholder="Login" name="log">';
			echo '<input type="password" placeholder="Password" name="psw">';
			echo '<input type="submit" value="Connect">';
		}
	?>
</form>

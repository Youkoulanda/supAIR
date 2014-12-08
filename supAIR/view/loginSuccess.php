<form action="supAIR.php?action=login" method="POST">

	<?php
		if($context->getSessionAttribute("login")==null)
		{
			echo '<input type="text" placeholder="Login" name="log">';
			echo '<input type="password" placeholder="Password" name="psw">';
			echo '<input type="submit" value="Connect">';
		}
		else
		{
			echo 'Bonjour '.$context->getSessionAttribute("login").' !';
		}
	?>
</form>

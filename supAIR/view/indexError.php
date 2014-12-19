<p>
	Connectez-vous pour avoir accès au contenu du site:
</p>

	<form id="formulaireLogin" action="supAIR.php?action=login" method="post">
		<?php
			if($context->getSessionAttribute("login")==null)
			{
				echo '<input type="text" placeholder="Login" name="log"><br/>';
				echo '<input type="password" placeholder="Password" name="psw"><br/>';
				echo '<input type="submit" value="Connect">';
			}
		?>
	</form>

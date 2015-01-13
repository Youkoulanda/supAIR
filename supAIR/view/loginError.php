<?php include($nameApp."/view/error.php"); ?>

<div id="blocConnexion">
	<p>Connexion</p>
		<form id="formulaireLogin" action="supAIR.php?action=login" method="post">
				<input type="text" placeholder="Login" name="log"><br/>
				<input type="password" placeholder="Password" name="psw"><br/>
				<input type="submit" value="Connexion">
		</form>
</div>

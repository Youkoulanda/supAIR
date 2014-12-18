<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8"/>
		<title>Ton appli !</title>
		<link rel="stylesheet" type="text/css" href="css/layout.css">
	</head>
	<body>
<!-- j'ai le droit de mettre des commentaires dans mon fichier HTML -->
<!-- Encore heureux qu'on a le droit ! C'est le nôtre ou non ?! -->

				<?php
					if($context->getSessionAttribute("login")!=null)
					{
						echo'
							<aside id="verticalBanner">
								<ul id="friendList">';
									include($nameApp."/view/menu.php");
						echo'	</ul>
							</aside>';
						
					}
				?>
		<div id="centralWrapper">
			<header>
				<h2>BossBouc</h2>
			</header>
			<section>
				<article>
					<?php include($template_view); ?>
				</article>
			</section>
			<footer>
				<?php include($nameApp."/view/chat.php"); ?>
			</footer>
		</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</body>
</html>

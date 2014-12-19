<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8"/>
		<title>Bossbouc</title>
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
		</div>
		<footer id="chatbox" title="Chatdesboss">
			<?php include($nameApp."/view/chat.php"); ?>
		</footer>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
			<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
			<script src="js/chatPosting.js"></script>
	</body>
</html>

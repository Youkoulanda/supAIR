<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8"/>
		<title>Bossbouc</title>
		<!--<link rel="stylesheet" type="text/css" href="css/layout.css">-->
		<link rel="stylesheet" type="text/css" href="css/screen.css">
	</head>
	<body>
		<div id="mainWrapper">
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
						</aside>
						<div id="chatbox" title="BossChat">';
							include($nameApp."/view/chat.php");
						echo '</div>';
				}
			?>
			<div id="centralWrapper">
				<header>
					<h2>BossBouc</h2>
				</header>
						<?php include($template_view); ?>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
		<script src="js/chatPosting.js"></script>
		<script src="js/messages.js"></script>
	</body>
</html>

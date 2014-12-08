<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Ton appli !</title>
	<link rel="stylesheet" type="text/css" href="css/layout.css">
   
</head>
<body>
<!-- j'ai le droit de mettre des commentaires dans mon fichier HTML -->
	<header><h2>Super c'est ton appli ! </h2></header>
	<section>
		<article><?php include($template_view); ?></article>
		<nav>
			<ul>
				<li><a href="supAIR.php?action=helloWord">Hello Word</a></li>
				<li><a href="supAIR.php?action=index">Index</a></li>
				<?php
					if($context->getSessionAttribute("login")==null)
					{
						echo "<li><a href=\"supAIR.php?action=login\">Login</a></li>";
					}
				?>
			</ul>
		</nav>
   	</section>
	<aside>
		<?php 
			if($context->getSessionAttribute("login")!=null)
				include($nameApp."/view/"."menu.php"); 
		?>
	</aside>
	<?php include($nameApp."/view/"."chat.php"); ?>
</body>
</html>

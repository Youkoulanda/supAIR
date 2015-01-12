<?php
	echo  "<p>".html_entity_decode($post->texte)."</p>";

	if($post->image != "")
			echo "<img src=\"".$post->image."\"/><br/>";
?>

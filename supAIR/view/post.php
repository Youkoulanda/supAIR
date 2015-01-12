<?php
	echo  html_entity_decode($post->texte)."<br/>";

	if($post->image != "")
			echo "<img class = imgChat src=\"".$post->image."\"/><br/>";
?>

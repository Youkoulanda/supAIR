<?php
	echo  html_entity_decode($post->texte)."<br/>";

	if($post->image != "")
		echo "<img src=\"".$post->image."\"/><br/>";
?>

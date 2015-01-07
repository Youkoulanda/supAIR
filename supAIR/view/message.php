<?php
	if($message['userPicture'] == "")
			$message['userPicture'] = "images/dummy.jpg";
?>

	<article class="message" id="<?php echo $message['content']->id?>">
	<?php
		if($message['isShared'])
			echo '<p class="shared">'
					.$message['content']->m_emetteur->prenom.' '.$message['content']->m_emetteur->nom.' a partagé'.
				'</p>';
	?>

	<div class="content">
		<?php
			echo '<img src="'.$message['userPicture'].'" alt="photo de profil" width="48px" height="48px" />';
		?>
		<p class="author">
			<?php
				echo '<span class="nameSurname">'.$message['author']->prenom." ".$message['author']->nom.'</span> <span class="pseudo">'.$message['author']->identifiant.'</span>';
			?>
		</p><br/>
		<p class="text">
			<?php
				$post=$message['content']->m_post;
				include("post.php");
			?>
		</p>
		<p class="footer">
			<?php
				$likeNumber = ($message['content']->aime) ? $message['content']->aime : 0;
				echo '<span class="likeIcon"></span> <span class="likeNumber">'.$likeNumber.'</span>';
				echo '   <span class="shareIcon"></span>'
			?>
		</p>
	</div>
</article>

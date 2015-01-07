<?php
	if($message['userPicture'] == "")
			$message['userPicture'] = "images/dummy.jpg";
?>

<article class="message" id="<?php echo $message['content']->id?>">
	<?php
		if($message['isShared'])
			echo '<p class="shared">
					<a href="supAIR.php?action=viewProfile&id='.$message['content']->m_emetteur->id.'" >'
						.$message['content']->m_emetteur->prenom.' '.$message['content']->m_emetteur->nom.
					'</a> a partagé
				</p>';
	?>

	<div class="content">
		<img src="<?php echo $message['userPicture']; ?>" alt="photo de profil" width="48px" height="48px" class="userPicture" />
		<p class="author">
			<a href="supAIR.php?action=viewProfile&id=<?php echo $message['author']->id; ?>">
				<?php
					echo '<span class="nameSurname">'.$message['author']->prenom." ".$message['author']->nom.'</span> <span class="pseudo">'.$message['author']->identifiant.'</span>';
				?>
			</a>
		</p>
		<br/><br/>
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
				if($context->getSessionAttribute("id") != $context->viewProfileUser->id)
					echo '   <span class="shareIcon"></span>'
			?>
		</p>
	</div>
</article>

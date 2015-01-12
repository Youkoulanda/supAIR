<article class="message" id="<?php echo $message['content']->id?>" >
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
				<span class="nameSurname">
					<?php echo $message['author']->prenom." ".$message['author']->nom; ?>
				</span>
				<span class="pseudo">
					<?php echo $message['author']->identifiant; ?>
				</span>
			</a>
		</p>
		<p class="text">
			<?php
				$post=$message['content']->m_post;
				include("post.php");
			?>
		</p>
		<p class="footer">
			<?php
				echo '<span class="likeIcon"></span> <span class="likeNumber">'.$message['content']->aime.'</span>';
				if($message['content']->m_emetteur != $context->viewProfileUser)
					echo '   <span class="shareIcon"></span>';
				else if($message['isShared'] && $context->viewProfileUser->id == $context->getSessionAttribute("id"))
					echo '   <span class="shareIconOn"></span>';

			?>
		</p>
	</div>
</article>

<article class="message" id="<?php echo $message['content']->id?>" >
	<?php
		if($message['isShared'])
		{
	?>
			<p class="shared">
				<a href="supAIR.php?action=viewProfile&id=<?php echo $message['content']->m_emetteur->id;?>" >
					<?php echo $message['content']->m_emetteur->prenom.' '.$message['content']->m_emetteur->nom; ?>
				</a> a partagé
			</p>
	<?php
		}
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
			<span class="likeIcon">
			</span>
			<span class="likeNumber">
				<?php echo $message['content']->aime; ?>
			</span>
		<?php
			if($message['content']->m_emetteur != $context->viewProfileUser)
			{
		?>
					<span class="shareIcon"></span>
			<?php
				}
				else if($message['isShared'] && $context->viewProfileUser->id == $context->getSessionAttribute("id"))
				{
			?>
					<span class="shareIconOn"></span>
			<?php
				}
			?>

		</p>
	</div>
</article>

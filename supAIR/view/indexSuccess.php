<section id="messageList">
	<h2>Messages populaires</h2>
<?php
	foreach($context->messages as $message)
		include($nameApp."/view/message.php");
?>
</section>

/*$("#chatSubmit").click(function()
{
    $.ajax({
       url : 'ajaxDispatcher.php',
       type : 'POST',
       data : 'action=addChat&text=' +$("#chatText").val() + '&id=' +<?php echo $context->getSessionAttribute("id"); ?>
    });
});*/
	  $(function() {
		  $( "#chatbox" ).dialog();
	  });

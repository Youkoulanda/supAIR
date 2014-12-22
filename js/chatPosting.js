/*$("#chatSubmit").click(function()
{
    $.ajax({
       url : 'ajaxDispatcher.php',
       type : 'POST',
       data : 'action=addChat&text=' +$("#chatText").val() + '&id=' +<?php echo $context->getSessionAttribute("id"); ?>
    });
});*/
$( "#chatbox" ).dialog(
{
	closeText:"X",
	position :{ my: "center ", at: "right bottom", of: window }
});

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
	resizable:false,
	position :{ my: "right bottom", at: "right bottom", of: window }
});

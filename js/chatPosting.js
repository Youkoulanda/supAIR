$(document).ready(function(e)
{
	$("#addChat").on("submit", function(e)
	{
	
		e.preventDefault();
		var $this = $(this);

    		$.ajax
		({
       			url : 'ajaxDispatcher.php?action=addChat',
       			type : 'POST',
       			data: $this.serialize(),	
			success: function(html)
			{
				if(html != "")
				{
					updateChat();
				}
				$('#addChat input[type=text]').val('');
			}
    		});
	});

	$( "#chatbox" ).dialog(
	{
		closeText:"X",
		autoOpen:true,
		resizable:false,
		position :{ my: "right bottom", at: "right bottom", of: window }
	});
});

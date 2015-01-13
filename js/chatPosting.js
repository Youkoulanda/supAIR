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
				$('#addChat').trigger('reset');
			}
		});
	});

	$( "#chatbox" ).dialog(
	{
		autoOpen:true,
		resizable:false,
		dragStart:function( event, ui ) {$("#chatbox").addClass('noclick');},
		position :{ my: "right bottom", at: "right bottom", of: window }
	});
	$(".ui-button").hide();
	$(".ui-dialog-titlebar").click(function()
	{
		if ($("#chatbox").hasClass('noclick'))
		{
        		$("#chatbox").removeClass('noclick');
    		}
    		else 
		{
			$('#chatbox').toggle();
		}
	});
});

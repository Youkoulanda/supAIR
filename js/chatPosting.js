//Auteur: Daniel Salas
//But: Permettre l'envoi de messages dans le chat et configuration de la fenêtre de chat
$(document).ready(function(e)
{
	//Gestion de l'envoi de message
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

	//création de la fenêtre de chat
	$( "#chatbox" ).dialog(
	{
		autoOpen:true,
		resizable:false,
		dragStart:function( event, ui ) {$("#chatbox").addClass('noclick');},
		position :{ my: "right bottom", at: "right bottom", of: window }
	});
	$(".ui-button").hide();

	//gestion de la minimisation de la fenêtre de chat
	$(".ui-dialog-titlebar").click(function()
	{
		if ($("#chatbox").hasClass('noclick'))
		{
        		$("#chatbox").removeClass('noclick');
    		}
    		else 
		{
			if(!chatOpen)
				$('#chatbox').dialog( "option", "title", "BossChat");
			if(chatOpen)
				newChatsCount=0;
			chatOpen=!chatOpen;
			$('#chatbox').toggle();
		}
	});
});

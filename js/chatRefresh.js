//Auteur: Daniel Salas
//But: rafraichissement du contenu de la fenêtre de chat
var newChatsCount=0;
var chatOpen=true;
function updateChat()
{
	$.getJSON
	(
       		'ajaxDispatcher.php?action=updateChat',
		'&lastChatID='+lastChatID,
		function(html)
		{
			if(html.message2 != null)
			{
				$('#chatList').append(html.message1);
				lastChatID=html.message2;
				newChatsCount+=html.newChatsCount;
				if(!chatOpen && newChatsCount!=0)
					$('#chatbox').dialog( "option", "title", "BossChat "+newChatsCount );
			}
		}
    	);
}
var d=$('#chatList');
d.scrollTop(d.prop("scrollHeight"));
setInterval(function () {updateChat()}, 3000);

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
			}
		}
    	);
}

setInterval(function () {updateChat()}, 3000);

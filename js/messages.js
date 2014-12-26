$(document).ready(function()
{
	$('#addMessage').on('submit', function(e)
	{
		e.preventDefault();

		var $this = $(this);
		var messageText = $('#recipientText').val();
		var latestMessageID = $('#messageList .message:first').attr('id');

		//if(messageText.length > 2000)
		$.ajax
		({
			url: 'ajaxDispatcher.php?action=addNewMessage',
			type : 'POST',
			data : $this.serialize() + '&latestMessageID=' + latestMessageID,
			success : function(html)
			{
				$('#messageList').prepend(html);
				$('#addMessage input[type=text]').val('');
			}
		});
	});
});

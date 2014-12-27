$(document).ready(function()
{
	$('#addMessage').on('submit', function(e)
	{
		e.preventDefault();

		var $this = $(this);
		var messageText = $('#recipientText').val();
		var latestMessageID = $('#messageList .message:first').attr('id');

		$.ajax
		({
			url: 'ajaxDispatcher.php?action=addNewMessage',
			type: 'POST',
			data: $this.serialize() + '&latestMessageID=' + latestMessageID,
			success: function(html)
			{
				if(html != '')
				{
					$('#messageList').prepend(html);
					noty(
					{
						layout: 'topRight',
						text: 'Vous avez ajouté un nouveau message',
						type: 'success',
						timeout: '5000'
					});
				}
				else
				{
					noty(
					{
						layout: 'topRight',
						text: 'Erreur lors de l\'ajout du message',
						type: 'error',
						timeout: '5000'
					});
				}
				$('#addMessage input[type=text]').val('');
			}
		});
	});

	$('.shareIcon').on('click', function()
	{
		var toShareMessageID = $(this).parents('article').attr('id');
		$.ajax
		({
			url: 'ajaxDispatcher?action=shareMessage',
			type: 'POST',
			data: 'toShareMessageID=' + toShareMessageID,
			success:function()
			{
					noty(
					{
						layout: 'topRight',
						text: 'Vous avez partagé ce message',
						type: 'success',
						timeout: '5000'
					});
			}
		});

	});

	$('.likeIcon').on('click', function()
	{
		var toLikeMessageID = $(this).parents('article').attr('id');
		$.ajax
		({
			url: 'ajaxDispatcher?action=likeMessage',
			type: 'POST',
			data: 'toLikeMessageID=' + toLikeMessageID,
			success:function(html)
			{
				$('#' + toLikeMessageID + ' .likeNumber').text(html);
			}
		});
	});

	$('#addMessage textarea').on('focus', function()
	{
		$(this).css('height', '5em');
	});
});

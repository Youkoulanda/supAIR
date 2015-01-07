$(document).ready(function()
{
	$('#addMessage').on('submit', function(e)
	{
		e.preventDefault();

		var $this = $(this);
		var latestMessageID = $('#messageList .message:first').attr('id') || '';

		$.ajax
		({
			url: 'ajaxDispatcher.php?action=addNewMessage',
			type: 'POST',
			data: $this.serialize() + '&latestMessageID=' + latestMessageID,
			success: function(html)
			{
				if(html != '')
				{
					$('#messageList form').after(html);
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

	//Agrandis la zone de texte à la saisie
	$('#addMessage textarea').on('focus', function()
	{
		$(this).css('height', '5em');
	});

	//Stylise les liens vers les utilisateurs
	$('.message .author').hover(function()
	{
		$(this).find('.nameSurname').css('text-decoration', 'underline');
	},
	function()
	{
		$(this).find('.nameSurname').css('text-decoration', 'none');
	});

	$('.message .shared').hover(function()
	{
		$(this).find('a').css('text-decoration', 'underline');
	},
	function()
	{
		$(this).find('a').css('text-decoration', 'none');
	});
});

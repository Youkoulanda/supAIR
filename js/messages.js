$(document).ready(function()
{
	//Affichage dynamique du nouveau message écrit avec notification d'ajout
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
				$error = $(html).filter('#error').html();

				if($.type($error) === "undefined")
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
						text: $error,
						type: 'error',
						timeout: '5000'
					});
				}
				$('#addMessage').trigger('reset');
			}
		});
	});

	//gestion du bouton de partage, avec notification
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

	//Rafraîchissement dynamique du nombre de "j'aime"
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

	pictureOrSubmitClick = false;
	$('#addMessage input[type=submit],input[type=button]').mousedown(function()
	{
		pictureOrSubmitClick = true;
	});

	$('#addMessage textarea').blur(function()
	{
		if(pictureOrSubmitClick)
			pictureOrSubmitClick = false;
		else
			$('#addMessage textarea').css('height', '');
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


	//Changement du statut
	$('#changeStatus').on('submit', function(e)
	{
		e.preventDefault();

		var $this = $(this);

		$.ajax
		({
			url: 'ajaxDispatcher.php?action=changeStatus',
			type: 'POST',
			data: $this.serialize(),
			success: function(html)
			{
				$error = $(html).filter('#error').html();

				if($.type($error) === "undefined")
				{
					$('#status').text(html);
					noty(
					{
						layout: 'topRight',
						text: 'Vous avez changé votre statut',
						type: 'success',
						timeout: '5000'
					});
				}
				else
				{
					noty(
					{
						layout: 'topRight',
						text: $error,
						type: 'error',
						timeout: '5000'
					});
				}
				$('#changeStatus').trigger('reset');
			}
		});
	});

	//Style du bouton d'envoi d'image
	$('#addMessage input[type=button]').on('click', function()
	{
		$('#addMessage input[type=file]').click();
	});
});

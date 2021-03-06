//Auteur de tout le fichier: Aurélien RIVET
//L'utilité de chaque fonction est précisée.

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

	//Gestion du bouton de partage, avec notification
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

	submitClick = false;
	$('#addMessage input[type=submit]').mousedown(function()
	{
		submitClick = true;
	});

	$('#addMessage textarea').blur(function()
	{
		if(submitClick)
			submitClick = false;
		else
			$('#addMessage textarea').css('height', '');
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

				$('#changeStatus').hide();
				$('#status').show();
			}
		});
	});

	//Animation statut: disparition/apparition du formulaire
	if($('#changeStatus').length != 0)
	{
		if($.trim($('#status').html()) == "")
		{
			$('#changeStatus').show();
			$('#status').hide();
		}

		$('#status').on('click', function()
		{
			$(this).hide();
			$('#changeStatus').show();
			$('#changeStatus input[type=text]').attr("value", $(this).text());
		});
	}
});

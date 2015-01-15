<?php
/*
 * All doc on :
 * Toutes les actions disponibles dans l'application
 *
 */

class mainController
{
	public static function updateChat($request,$context)
	{
		$context->lastChatID=$request['lastChatID'];
		return context::SUCCESS;
	}

	public static function addChat($request,$context)
	{
		$post = postTable::addPost($request['chatText']);
		$sender = utilisateurTable::getUserById($request['senderID']);
		$context->result = $sender->identifiant.": ".$request['chatText'];
		$chat=chatTable::addChat($post,$sender);
		if($chat!=NULL)
		{
			$context->chat=$chat;
			return context::SUCCESS;
		}
		return context::ERROR;
	}

	public static function index($request,$context)
	{
		if($context->getSessionAttribute("login")!=null)
		{
			$context->messages = self::prepareMessages(messageTable::getPopularMessages());
			return context::SUCCESS;
		}
		return context::ERROR;
	}

	public static function login($request,$context)
	{
		if($context->getSessionAttribute("login")!=null)
			return context::SUCCESS;

		if(isset($request['log']) && isset($request['psw']))
		{
			$temp=utilisateurTable::getUserByLoginAndPass($request['log'],$request['psw']);
			if($temp!=false)
			{
				$context->setSessionAttribute("login",$request['log']);
				$context->setSessionAttribute("id",$temp->id);
				return context::SUCCESS;
			}
			else
				$context->errorMessage = "Utilisateur introuvable. Vérifiez vos identifiants.";
		}
		else
			$context->errorMessage = "Un des deux champs était vide.";

		return context::ERROR;
	}

	//Auteur:Aurélien Rivet
	//Prépare l'affichage des messages en plaçant les informations de chacun d'eux dans un tableau à deux dimensions.
	private static function prepareMessages($sourceMessages)
	{
			$messages = array();

			foreach($sourceMessages as $message)
			{
				$isShared = ($message->m_parent != $message->m_emetteur) ? true : false;
				$userPicture = ($isShared) ? $message->m_parent->avatar : $message->m_emetteur->avatar;
				$message->aime = ($message->aime) ? $message->aime : 0;

				$messages[] = array(
				'isShared' => $isShared,
				'userPicture' => ($userPicture == "") ? "https://pedago01a.univ-avignon.fr/~uapv1201349/squelette/images/dummy.jpg" : $userPicture,
				'author' => ($isShared) ? $message->m_parent : $message->m_emetteur,
				'content' => $message);
			}

			return $messages;
	}

	//Auteur: Aurélien Rivet
	//But: Permet de voir le mur et le profil d'un utilisateur. Prépare les contenus à afficher par la vue.
	public static function viewProfile($request, $context)
	{
		if($context->getSessionAttribute("login")!=null)
		{
			$context->viewProfileUser = utilisateurTable::getUserById($request['id']);
			$context->srcAvatar = ($context->viewProfileUser->avatar == "") ? "images/dummy.jpg" : $context->viewProfileUser->avatar;
			$context->userBirthdate = date("d-m-Y", strtotime($context->viewProfileUser->date_de_naissance));

			$context->messages = self::prepareMessages(messageTable::getMessagesByDestinataire($context->viewProfileUser->id));

			return context::SUCCESS;
		}

		$context->errorMessage = "Vous n'êtes pas connecté, vous n'avez rien à faire sur cette page.";
		return context::ERROR;
	}

	//Auteur: Aurélien Rivet
	//But: Ajoute un nouveau message au mur de l'utilisateur actuellement visionné
	public static function addNewMessage($request, $context)
	{
		if($context->getSessionAttribute("login") != null)
		{
			$sender = utilisateurTable::getUserById($context->getSessionAttribute("id"));
			$recipient = utilisateurTable::getUserById($request['recipientID']);
			$post = postTable::addPost($request['messageText']);

			if(!messageTable::addNewMessage($sender, $recipient, $post))
			{
				$context->errorMessage = "Erreur lors de l'ajout du message. Veuillez réessayer.";
				return context::ERROR;
			}

			$messages = array();

			if($request['latestMessageID'] != '')
				$newMessages = messageTable::getNewerThan($recipient->id, $request['latestMessageID']);
			else
				$newMessages = messageTable::getMessagesByDestinataire($recipient->id);

			$context->messages = self::prepareMessages($newMessages);
			$context->viewProfileUser = $recipient;

			return context::SUCCESS;
		}

		$context->errorMessage = "Vous n'êtes pas connecté, vous n'avez rien à faire ici.";
		return context::ERROR;
	}

	//Auteur: Aurélien Rivet
	//But: Partage un message, c'est à dire le reécrit sur le mur de l'utilisateur qui partage en ajoutant la mention est partagé
	public static function shareMessage($request, $context)
	{
		if($context->getSessionAttribute("login") != null)
		{
			$toShareMessageID = $request['toShareMessageID'];
			$sender = utilisateurTable::getUserById($context->getSessionAttribute('id'));

			if(messageTable::shareMessage($toShareMessageID, $sender))
				return context::SUCCESS;
		}

		$context->errorMessage = "Vous n'êtes pas connecté, vous n'avez rien à faire ici";
		return context::ERROR;
	}

	//Auteur: Aurélien Rivet
	//But: Incrémente le nombre de "j'aime" d'un message de 1. Rien n'est prévu dans l' architecture fournie pour gérer le nombre de fois qu'un utilisateur peut aimer un message,
	// par conséquent ce nombre est infini.
	public static function likeMessage($request, $context)
	{
		if($context->getSessionAttribute("login") != null)
		{
			$toLikeMessageID = $request['toLikeMessageID'];
			messageTable::likeMessage($toLikeMessageID);
			$context->likeNumber = messageTable::getLikeNumberFromMessage($toLikeMessageID);
			return context::SUCCESS;
		}

		$context->errorMessage = "Vous n'êtes pas connecté, vous n'avez rien à faire ici.";
		return context::ERROR;
	}

	//Auteur::Aurélien Rivet
	//But: Permet de chanegr le statut de l'utilisateur. Accessible seulement sur la propre page de profil de l'utilisateur.
	public static function changeStatus($request, $context)
	{
		if($context->getSessionAttribute("login") != null)
		{
				if(utilisateurTable::changeStatus($context->getSessionAttribute('id'), $request['newStatus']))
				{
					$context->newStatus = $request['newStatus'];
					return context::SUCCESS;
				}
				else
					$context->errorMessage = "Erreur lors de l'enregistrement du nouveau statut. Veuillez réessayer.";
		}
		else
			$context->errorMessage = "Vous n'êtes pas connecté, vous n'avez rien à faire ici.";

		return context::ERROR;
	}
}
?>

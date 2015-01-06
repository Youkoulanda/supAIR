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
		$context->lastID=$request['id'];
		return context::SUCCESS;
	}

	public static function addChat($request,$context)
	{
		$post = postTable::addPost($request['chatText']);
		$sender = utilisateurTable::getUserById($request['senderID']);
		$context->result = $sender->identifiant.": ".$request['chatText'];
		if(chatTable::addChat($post,$sender))
			return context::SUCCESS;
		return context::ERROR;
	}

	public static function index($request,$context)
	{
		if($context->getSessionAttribute("login")!=null)
			return context::SUCCESS;
		return context::ERROR;
	}

	public static function login($request,$context)
	{
		if($context->getSessionAttribute("login")!=null)
			return context::SUCCESS;
		if(isset($_REQUEST['log']) && isset($_REQUEST['psw']))
		{
			$temp=utilisateurTable::getUserByLoginAndPass($_REQUEST['log'],$_REQUEST['psw']);
			if($temp!=false)
			{
				$context->setSessionAttribute("login",$_REQUEST['log']);
				$context->setSessionAttribute("id",$temp->id);
				return context::SUCCESS;
			}
			else
				return context::ERROR;
		}
		return context::SUCCESS;
	}

	public static function viewProfile($request, $context)
	{
		if($context->getSessionAttribute("login")!=null)
		{
			$context->viewProfileUser = utilisateurTable::getUserById($request['id']);
			$context->srcAvatar = ($context->viewProfileUser->avatar == "") ? "images/dummy.jpg" : $context->viewProfileUser->avatar;
			$context->userBirthdate = date("d-m-Y", strtotime($context->viewProfileUser->date_de_naissance));
			$messages = array();
			foreach(messageTable::getMessagesByDestinataire($context->viewProfileUser->id) as $message)
			{
				$isShared = ($message->m_parent != $message->m_emetteur) ? true : false;

				$messages[] = array(
				'isShared' => $isShared,
				'userPicture' => ($isShared) ? $message->m_parent->avatar : $message->m_emetteur->avatar,
				'author' => ($isShared) ? $message->m_parent : $message->m_emetteur,
				'content' => $message);
			}
			$context->messages = $messages;
			return context::SUCCESS;
		}

		return context::ERROR;
	}

	public static function addNewMessage($request, $context)
	{
		if($context->getSessionAttribute("login") != null)
		{
			if($request['latestMessageID'] != '')
				$context->messages = messageTable::getNewerThan($request['latestMessageID']);
			else
				$context->messages = messageTable::getMessagesByDestinataire($context->viewProfileUser->id);

			$sender = utilisateurTable::getUserById($request['senderID']);
			$recipient = utilisateurTable::getUserById($request['recipientID']);
			$post = postTable::addPost($request['messageText']);

			if(messageTable::addNewMessage($sender, $recipient, $post))
				return context::SUCCESS;
		}

		return context::ERROR;
	}

	public static function shareMessage($request, $context)
	{
		if($context->getSessionAttribute("login") != null)
		{
			$toShareMessageID = $request['toShareMessageID'];
			$sender = utilisateurTable::getUserById($context->getSessionAttribute('id'));
			if(messageTable::shareMessage($toShareMessageID, $sender))
				return context::SUCCESS;
		}

		return context::ERROR;
	}

	public static function likeMessage($request, $context)
	{
		if($context->getSessionAttribute("login") != null)
		{
			$toLikeMessageID = $request['toLikeMessageID'];
			messageTable::likeMessage($toLikeMessageID);
			$context->likeNumber = messageTable::getLikeNumberFromMessage($toLikeMessageID);
			return context::SUCCESS;
		}

		return context::ERROR;
	}
}
?>

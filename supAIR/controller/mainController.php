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
		$context->lastID=$_REQUEST['id'];
		return context::SUCCESS;
	}

	public static function addChat($request,$context)
	{
		chatTable::addChat($_REQUEST['text'],$_REQUEST['id']);
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
			return context::SUCCESS;
		}

		return context::ERROR;
	}

	public static function addNewMessage($request, $context)
	{
		if($context->getSessionAttribute("login") != null)
		{
			/*if($request['latestMessageID'] != '')
			{
				$context->messages = messageTable::getNewerThan(53);
			}
			else
				$context->messages = messageTable::getMessagesByDestinataire($context->id);
			*/
			//messageTable::addNewMessage($request['senderID'], $request['recipientID'], $request['messageText']);
			return context::SUCCESS;
		}

		return context::ERROR;
	}

	public static function shareMessage($request, $context)
	{
		if($context->getSessionAttribute("login") != null)
		{
			//messageTable::shareMessage($request['toShareID'], $request['sender']);
			//If right return
			return context::SUCCESS;
		}

		return context::ERROR;
	}

	public static function likeMessage($request, $context)
	{
		if($context->getSessionAttribute("login") != null)
		{
			//messageTable::likeMessage($request["likeID"]);
			//If right return
			return context::SUCCESS;
		}
		return context::ERROR;
	}
}
?>

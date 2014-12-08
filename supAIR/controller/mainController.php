<?php
/*
 * All doc on :
 * Toutes les actions disponibles dans l'application 
 *
 */

class mainController
{

	public static function helloWord($request,$context)
	{
		$context->mavariable="hello word";
		return context::SUCCESS;
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
			if(utilisateurTable::getUserByLoginAndPass($_REQUEST['log'],$_REQUEST['psw'])!=false)
			{
				$context->setSessionAttribute("login",$_REQUEST['log']);
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
			$context->viewProfileUser = utilisateurTable::getUserById($_REQUEST['id']);
			return context::SUCCESS;
		}

		return context::ERROR;
	}
}

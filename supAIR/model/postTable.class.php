<?php

class postTable extends Doctrine_Table
{
	//Auteur: Daniel Salas
	//But : Ajoute un post à la base de données. retourne son index ou bien -1 en cas d'erreur.
	public static function addPost($text,$image = "")
	{
		$connection = dbconnection::getInstance();
		$text = htmlentities($text);

		if(get_magic_quotes_gpc()===1)
			$text = stripslashes($text);

		if(strlen($text) > 2000)
			return "Message trop long";

		$post=new post();
		$post->texte=$text;
		$post->image=$image;
		$post->date=date('Y-m-d H:i:s');
		if($post->trySave())
			return $post;
		else
			return -1;
	}

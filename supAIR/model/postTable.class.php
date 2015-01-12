<?php
//Auteur: Daniel Salas
//But : réaliser la classe postTable

class postTable extends Doctrine_Table
{
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

	public static function addImage($id, $location)
	{
		$connection = dbconnection::getInstance();
		$req = Doctrine_Query::create()
			->update('post')
			->set('image', '?', $location)
			->where('id = ?', $id);

		$req->execute();
	}
}

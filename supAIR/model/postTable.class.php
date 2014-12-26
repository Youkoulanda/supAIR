<?php
//Auteur: Daniel Salas
//But : réaliser la classe postTable

class postTable extends Doctrine_Table
{
	public static function addPost($text,$image)
	{
		$post=new post();
		$post->texte=$text;
		$post->image=$image;
		$post->date=date('Y-m-d H:i:s');
		if($post->trySave())
			return $post;
		else
			return -1;
	}
}

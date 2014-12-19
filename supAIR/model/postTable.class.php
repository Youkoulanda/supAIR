<?php
//Auteur: Daniel Salas
//But : réaliser la classe postTable

class postTable extends Doctrine_Table
{
	public static function addPost($text,$image)
	{
		$post=new Post();
		$post->texte=$text;
		$post->save();
		return $store->identifier();	
	}
}

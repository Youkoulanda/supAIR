<?php

class chatTable extends Doctrine_Table
{

	//Auteur: Aurélien Rivet
	//But : réaliser la classe chatTable
	public static function getChats()
	{
		$connection = dbconnection::getInstance();

		$req = Doctrine_Query::create()
			->from('chat c');

		return $req->execute();
	}

	//But: Renvoie le dernier chat
	public static function getLastChat()
	{
		$connection = dbconnection::getInstance();

		$req = Doctrine_Query::create()
			->from('chat c')
			->orderBy('c.id DESC')
			->limit(1);

		return  $req->execute();
	}

	//Auteur: Daniel Salas
	//But:Renvoier les 10 dernier chats
	public static function getTenLastChats()
	{
		$connection = dbconnection::getInstance();

		$req = Doctrine_Query::create()
			->from('chat c')
			->orderBy('c.id DESC')
			->limit(10);

		$collection=$req->execute();
		$orderedCollection = new Doctrine_Collection('chat');
		for($i=$collection->count()-1; $i>=0; $i--)
			$orderedCollection->add($collection->get($i));

		return $orderedCollection;
	}

	//Auteur: Daniel Salas
	//But:Renvoier tout les chats plus récent que celui dont l'ID est passé en paramètre (pour le rafraichissement du chat)
	public static function getNewerThan($lastID)
	{
		$connection = dbconnection::getInstance();

		$req = Doctrine_Query::create()
			->from('chat c')
			->where('c.id > ?', $lastID)
			->orderBy('c.id', 'DESC');

		return $req->execute();
	}

	//Auteur: Daniel Salas
	//But:Ajouter un chat dans la base
	public static function addChat($post,$sender)
	{
		$connection = dbconnection::getInstance();

		$chat=new Chat();
		$chat->emetteur=$sender;
		$chat->post=$post;
		if($chat->trySave())
			return $chat;
		else return NULL;
	}
}

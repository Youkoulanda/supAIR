<?php
//Auteur: Aurélien Rivet
//But : réaliser la classe chatTable

class chatTable extends Doctrine_Table{

	public static function getChats()
	{
		$connection = dbconnection::getInstance();

		$req = Doctrine_Query::create()
			->from('chat c');

		return $req->execute();
	}

	public static function getLastChat()
	{
		$connection = dbconnection::getInstance();

		$req = Doctrine_Query::create()
			->from('chat c')
			->orderBy('c.id DESC')
			->limit(1);

		return  $req->execute();
	}

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

	public static function getNewerThan($lastID)
	{
		$connection = dbconnection::getInstance();

		$req = Doctrine_Query::create()
			->from('chat c')
			->where('c.id > ?', $lastID)
			->orderBy('c.id', 'DESC');

		return $req->execute();
	}

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

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
			->orderBy('c.id', 'DESC');

		$res = $req->fetchOne();

		if($res == false)
		{
			echo 'Erreur sql';
		}
		return $res;
	}
	
	public static function getTenLastChats()
	{
		$connection = dbconnection::getInstance();

		$req = Doctrine_Query::create()
			->from('chat c')
			->orderBy('c.id', 'DESC')
			->limit(10);

		return $req->execute();
	}
}

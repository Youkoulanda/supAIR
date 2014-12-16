<?php
// Inclusion de la classe message
//require_once "message.class.php";
// Classe definissant les methodes associees a la table message (fille de Doctrine_Table)
class messageTable extends Doctrine_Table{

	//Auteur: Daniel Salas
	//But: réalisation de la fonction getMessageById(id)
	public static function getMessageById($id)
	{
		$connection = dbconnection::getInstance() ;

		$req = Doctrine_Query::create()
			->from('message u')
			->where('u.id = ?', $id);

		$res=$req->fetchOne();
		return $res;
	}
	
	public static function getMessagesByDestinataire($id)
	{
		$connection = dbconnection::getInstance() ;

		$req = Doctrine_Query::create()
			->from('message m')
			->where('m.destinataire = ?', $id);

		return $req->execute();
	}

	//Auteur:Aurélien Rivet
	//But : récupérer les message du mur ajoutés après celui qui a l'ID lastID
	public static function getNewerThan($lastID)
	{
		$connection = dbconnection::getInstance();

		$req = Doctrine_Query::create()
			->from('message m')
			->where('m.id > ?', $lastID)
			->orderBy('m.id', 'DESC');

		return $req->execute();
	}

}

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

}

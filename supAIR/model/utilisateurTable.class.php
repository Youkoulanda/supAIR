<?php
// Inclusion de la classe utilisateur
//require_once "utilisateur.class.php";
// Classe definissant les methodes associees a la table utilisateur (fille de Doctrine_Table)
class utilisateurTable extends Doctrine_Table{

	public static function getUserByLoginAndPass($login,$pass){
		$connection = dbconnection::getInstance() ;

		$req = Doctrine_Query::create()
			->from('utilisateur u')
			->where('u.identifiant = ?', $login)
			->andWhere('u.pass = ?', sha1($pass));

		$res=$req->fetchOne();

		$res=Doctrine_Core::getTable('utilisateur')->findOneByidentifiantAndpass($login, sha1($pass));

		if ($res == false){
			echo 'Erreur sql';
		}
		return $res;
	}

	//Auteur: Daniel Salas
	//But: Permet de récupérer un objet mappé via son ID.
	public static function getUserById($id)
	{
		$connection = dbconnection::getInstance() ;

		$req = Doctrine_Query::create()
			->from('utilisateur u')
			->where('u.id = ?', $id);

		$res=$req->fetchOne();
		return $res;
	}

	//Auteur: Daniel Salas
	//But: Récupère la liste des utilisateurs.
	public static function getUsers()
	{
		$connection = dbconnection::getInstance() ;
		$req = Doctrine_Query::create()
			->from('utilisateur');
		return $req->execute();
	}

	//Auteur: Aurélien Rivet
	//But: Permet de changer le statut de l'utilisateur ayant l'id $userID.
	public static function changeStatus($userID, $newStatus)
	{
		$user = self::getUserById($userID);
		$user->statut = $newStatus;
		return $user->trySave();
	}

}

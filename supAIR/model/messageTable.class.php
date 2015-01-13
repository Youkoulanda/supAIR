<?php
// Inclusion de la classe message
//require_once "message.class.php";
// Classe definissant les methodes associees a la table message (fille de Doctrine_Table)
class messageTable extends Doctrine_Table
{

	//Auteur: Daniel Salas
	//But: réalisation de la fonction getMessageById(id)
	public static function getMessageById($id)
	{
		$connection = dbconnection::getInstance();

		$req = Doctrine_Query::create()
			->from('message u')
			->where('u.id = ?', $id);

		$res=$req->fetchOne();
		return $res;
	}

	public static function getMessagesByDestinataire($id)
	{
		$connection = dbconnection::getInstance();

		$req = Doctrine_Query::create()
			->from('message m')
			->where('m.destinataire = ?', $id)
			->orderBy('m.id DESC');

		return $req->execute();
	}

	public static function getPopularMessages()
	{
		$connection = dbconnection::getInstance();

		$req = Doctrine_Query::create()
			->from('message m')
			->orderBy('m.aime DESC')
			->limit(10);

		return $req->execute();
	}

	//Auteur:Aurélien Rivet
	//But : récupérer les message du mur ajoutés après celui qui a l'ID lastID
	public static function getNewerThan($userID, $lastID)
	{
		$connection = dbconnection::getInstance();

		$req = Doctrine_Query::create()
			->from('message z')
			->where('z.id > ?', $lastID)
			->where('z.destinataire = ?', $userID)
			->orderBy('z.id DESC');

		return $req->execute();
	}

	private static function createMessage($sender, $recipient, $parent, $post, $aime = "")
	{
		$connection = dbconnection::getInstance();

		$message = new message();
		$message->m_emetteur = $sender;
		$message->m_destinataire = $recipient;
		$message->m_parent = $parent;
		$message->m_post = $post;
		$message->aime = 0;
		return $message->trySave();
	}

	public static function addNewMessage($sender, $recipient, $post)
	{
		return self::createMessage($sender, $recipient, $sender, $post);
	}

	public static function likeMessage($id)
	{
		$connection = dbconnection::getInstance();

		$message = self::getMessageById($id);
		$message->aime++;
		return $message->trySave();
	}

	private static function alreadyShareBy($messageToShare, $userID)
	{
		$connection = dbconnection::getInstance();

		foreach(self::getMessagesByDestinataire($userID) as $message)
			if($messageToShare->m_post->id == $message->m_post->id)
				return true;
		return false;
	}

	public static function shareMessage($toShareID, $sender)
	{
		$connection = dbconnection::getInstance();

		$messageToShare = self::getMessageById($toShareID);
		if(!self::alreadyShareBy($messageToShare, $sender))
			return self::createMessage($sender,
				$sender,
				$messageToShare->m_parent,
				$messageToShare->m_post,
				$messageToShare->aime);
		else
			return false;
	}

	public static function getLikeNumberFromMessage($messageID)
	{
		$connection = dbconnection::getInstance();

		$message = self::getMessageById($messageID);
		return $message->aime;
	}
}

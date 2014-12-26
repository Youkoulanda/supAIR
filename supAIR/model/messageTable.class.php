<?php
// Inclusion de la classe message
//require_once "message.class.php";
// Classe definissant les methodes associees a la table message (fille de Doctrine_Table)
class messageTable extends Doctrine_Table{

	//Auteur: Daniel Salas
	//But: réalisation de la fonction getMessageById(id)
	public static function getMessageById($id)
	{
		$req = Doctrine_Query::create()
			->from('message u')
			->where('u.id = ?', $id);

		$res=$req->fetchOne();
		return $res;
	}

	public static function getMessagesByDestinataire($id)
	{
		$req = Doctrine_Query::create()
			->from('message m')
			->where('m.destinataire = ?', $id)
			->orderBy('m.id DESC');

		return $req->execute();
	}

	//Auteur:Aurélien Rivet
	//But : récupérer les message du mur ajoutés après celui qui a l'ID lastID
	public static function getNewerThan($lastID)
	{
		$req = Doctrine_Query::create()
			->from('message z')
			->where('z.id > ?', $lastID)
			->orderBy('z.id DESC');

		return $req->execute();
	}

	private static function createMessage($senderID, $recipientID, $text, $picture = "")
	{
		$sender = utilisateurTable::getUserById($senderID);
		$recipient = utilisateurTable::getUserById($recipientID);
		$message = new message();
		$message->m_emetteur = $sender;
		$message->m_destinataire = $recipient;
		$message->m_parent = $sender;
		$message->m_post = postTable::addPost($text, $picture);
		$message->aime = 0;
		return $message->trySave();
	}

	public static function addNewMessage($senderID, $recipientID, $messageText, $picture = "")
	{
		$messageText = htmlentities($messageText);

		if(get_magic_quotes_gpc()===1)
			$messageText = stripslashes($messageText);

		if(strlen($messageText) > 2000)
			return "Message trop long";
		return self::createMessage($senderID, $recipientID, $messageText, $picture);
	}

	public static function likeMessage($id)
	{
		$message = getMessageById($id);
		$message->aime++;
		return $message->trySave();
	}

	public static function shareMessage($toShareID, $sender)
	{
		$messageToShare = getMessageById($toShareID);
		return createMessage($sender, utilisateurTable::getUserById($messageToShare->destinataire),
			$messageToShare->m_post->texte,
			$messageToShare->m_post->image);
	}
}

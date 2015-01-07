<?php
// Classe definissant la table utilisateur dans le SGBDR

class post extends Doctrine_Record
{
	public function setTableDefinition(){
		// On définit le nom de notre table  :utilisateur.
		$this->setTableName('post');

		//Puis, tous les champs
		$this->hasColumn('id', 'integer', 8, array('primary' => true,
			'autoincrement' => true));
		$this->hasColumn('texte', 'TEXT');
		$this->hasColumn('date', 'TIMESTAMP');
		$this->hasColumn('image', 'varchar', 45);
	}

	public function setUp()
	{
		$this->hasOne('chat as p_post', array('local' => 'id', 'foreign' => 'post'));
		$this->hasMany('message as p_message', array('local' => 'id', 'foreign' => 'post'));
	}
}

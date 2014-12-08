<?php
// Classe definissant la table utilisateur dans le SGBDR

class chat extends Doctrine_Record{

	public function setTableDefinition(){
        	// On définit le nom de notre table  :utilisateur.
        	$this->setTableName('chat');
        
    		//Puis, tous les champs
        	$this->hasColumn('id', 'integer', 8, array('primary' => true,
                           'autoincrement' => true));
        	$this->hasColumn('emetteur', 'integer');
        	$this->hasColumn('post', 'integer');
    	}

	public function setUp()
	{
		$this->hasOne('utilisateur as c_emetteur', array('local' => 'emetteur', 'foreign' => 'id'));
		$this->hasOne('post as c_post', array('local' => 'post', 'foreign' => 'id'));
	}
}

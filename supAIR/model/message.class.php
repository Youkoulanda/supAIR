<?php
// Classe definissant la table utilisateur dans le SGBDR

class message extends Doctrine_Record{

	public function setTableDefinition(){
        	// On définit le nom de notre table  :utilisateur.
        	$this->setTableName('message');
        
    		//Puis, tous les champs
        	$this->hasColumn('id', 'integer', 8, array('primary' => true,
                           'autoincrement' => true));
        	$this->hasColumn('emetteur', 'integer');
        	$this->hasColumn('destinataire', 'integer');
    		$this->hasColumn('parent', 'integer');
    		$this->hasColumn('post', 'integer');
    		$this->hasColumn('aimer', 'integer');
    	}

	public function setUp()
	{
		$this->hasOne('post as m_post', array('local' => 'post', 'foreign' => 'id'));
		$this->hasOne('utilisateur as m_emetteur', array('local' => 'emetteur', 'foreign' => 'id'));
		$this->hasOne('utilisateur as m_destinataire', array('local' => 'destinataire', 'foreign' => 'id'));
		$this->hasOne('utilisateur as m_parent', array('local' => 'parent', 'foreign' => 'id'));
	}
}

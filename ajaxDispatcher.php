<?php
//nom de l'application
$nameApp = "supAIR";

// Inclusion des classes et librairies
require_once 'lib/core.php';
require_once $nameApp.'/controller/mainController.php';

foreach(glob($nameApp.'/model/*.class.php') as $model){
	include_once $model ;
}

//action par défaut
$action = "index";

if(key_exists("action", $_REQUEST))
$action = $_REQUEST['action'];

session_start();

$context = context::getInstance();
$context->init($nameApp);

$user = $context->getSessionAttribute('user_id') ;
if(!isset($user) || $user == NULL){
//	$action = "login" ;
}

$view=$context->executeAction($action, $_REQUEST);

//traitement des erreurs de bases, reste a traiter les erreurs d'inclusion
if($view===false){
	echo "Une grave erreur s'est produite, il est probable que l'action ".$action." n'existe pas...";
	die;
}
//inclusion directe de la vue à afficher
elseif($view!=context::NONE){
	include($nameApp."/view/".$action.$view.".php");
}
?>

<?php

if(key_exists("ajaxAction", $_REQUEST))
$ajaxAction = $_REQUEST['ajaxAction'];

$ajaxResult=$context->executeAction($action, $_REQUEST);

//traitement des erreurs de bases, reste a traiter les erreurs d'inclusion
if($ajaxResult===false){
	echo "Une grave erreur s'est produite, il est probable que l'action ".$ajaxAction." n'existe pas...";
	die;
}
else
{
	echo $ajaxResult;
}
?>

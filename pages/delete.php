<?php 
include('../fonction.php');
$json = file_get_contents('../data/fichier.json');
$json = json_decode($json,true);
if (isset($_GET['login'])) 
{
	$login =  $_GET['login'];
	$position = 0;
    for($i = 0; $i< count($json['joueurs']);$i++){
        if ($json['joueurs'][$i]['Login'] == $login) {
        	$position = $i;
			break;
        }
    }
    $json['joueurs'][$position] = null;
    $json = json_encode($json);
	$json = file_put_contents('../data/fichier.json', $json);

	header('location:../index.php?controlPage=accueil&p=listj');
}
?>
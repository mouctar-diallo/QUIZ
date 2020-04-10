<?php
function redirectionUser($login,$password)
{
	$file = "fichier.json";
	$data = file_get_contents($file);
	$obj = json_decode($data,true);
	//controle page admin
	for ($i=0; $i <count($obj['admins']); $i++) { 
		if ($login==$obj['admins'][$i]['Login'] && $password==$obj['admins'][$i]['password']) {
			header('location:CompteAdmin.php?id='.$i);
		}
	}
	//controle page joueur
	for ($i=0; $i <count($obj['joueurs']); $i++) { 
		if ($login==$obj['joueurs'][$i]['Login'] && $password==$obj['joueurs'][$i]['password']) {
			header('location:joueur.php');
		}
	}
}
?>
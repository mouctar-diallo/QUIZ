<?php
session_start();
function redirectionUser($login,$password)
{
	$file = "fichier.json";
	$data = file_get_contents($file);
	$obj = json_decode($data,true);
	//controle page admin
	for ($i=0; $i <count($obj['admins']); $i++) { 
		if ($login==$obj['admins'][$i]['Login'] && $password==$obj['admins'][$i]['password']) {
      $_SESSION['admin'] = $obj['admins'][$i];
      $_SESSION['statut'] = 'connecter';
			header('location:CompteAdmin.php');
		}
	}
	//controle page joueur
	for ($i=0; $i <count($obj['joueurs']); $i++) { 
		if ($login==$obj['joueurs'][$i]['Login'] && $password==$obj['joueurs'][$i]['password']) {
      $_SESSION['joueur'] = $obj['joueurs'][$i];
      $_SESSION['statut'] = 'connecter';
			header('location:joueur.php');
		}
	}
}

//deconnexion des users
function deconnexion(){
  unset($_SESSION['admin']);
  unset($_SESSION['joueur']);
  unset($_SESSION['statut']);
  session_destroy();
}
//tester si l'user est connecter
function is_connect(){
  if (!isset($_SESSION['statut'])) {
    header('location:authentification.php');
  }
}

//fonction permettant de telecharger l'image dans le dossier images du projet
function loadImage()
{
  // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
  if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0)
  {
    // Testons si le fichier n'est pas trop gros
    if ($_FILES['image']['size'] <= 1000000)
    {
      // Testons si l'extension est autorisée
      $infosfichier = pathinfo($_FILES['image']['name']);
      $extension_upload = $infosfichier['extension'];
      //les extensions autorises
      $extensions_autorisees = array('jpg','jpeg','png');
      if (in_array($extension_upload, $extensions_autorisees))
      {
        // On peut valider le fichier et le stocker 
        move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . basename($_FILES['image']['name']));
      }
    }else{
      echo "la taille de l'image est trop grande";
    }
} 
}
?>
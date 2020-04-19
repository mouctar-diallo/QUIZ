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
			header('location:index.php?controlPage=accueil');
		}
	}
	//controle page joueur
	for ($i=0; $i <count($obj['joueurs']); $i++) { 
		if ($login==$obj['joueurs'][$i]['Login'] && $password==$obj['joueurs'][$i]['password']) {
      $_SESSION['joueur'] = $obj['joueurs'][$i];
      $_SESSION['statut'] = 'connecter';
			header('location:index.php?controlPage=jeux');
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
    header('location:index.php');
  }
}


function loadImage()
{
  $infoPhoto = false;
  // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
  if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0)
  {
    // Testons si le fichier n'est pas trop gros
    if ($_FILES['image']['size'] <= 2000000)
    {
      // Testons si l'extension est autorisée
      $infosfichier = pathinfo($_FILES['image']['name']);
      $extension_upload = $infosfichier['extension'];
      //les extensions autorises
      $extensions_autorisees = array('jpg','jpeg');
      if (in_array($extension_upload, $extensions_autorisees))
      {
        // On peut valider le fichier et le stocker dans le dossier image du projet
        move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . basename($_FILES['image']['name']));
        $infoPhoto = true;
      }
    }
  }
  return $infoPhoto; 
}
//fonction qui liste les 5 meilleurs joueurs
function top5_players($tableau)
{
  for ($i=0; $i < 5; $i++) 
  {?>
    <div class="first-name"><?php echo $tableau[$i]['nom']; ?></div>
    <div class="first-name"><?php echo $tableau[$i]['prenom']; ?></div>
    <div class="first-name"><?php echo $tableau[$i]['score']; ?></div> <?php
  }
}

//tri des joueurs par score
function triDecroissant($tab)
{
  for ($i=0; $i < (count($tab)-1); $i++) 
  { 
    for ($j=$i+1; $j < count($tab) ; $j++) 
    { 
      if ($tab[$i]['score'] < $tab[$j]['score']) 
      {
        $echange = $tab[$j];
        $tab[$j]=  $tab[$i];
        $tab[$i] = $echange;
      }
    }

    return $tab;
  }
}
?>
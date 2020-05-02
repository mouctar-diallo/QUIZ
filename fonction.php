<?php
session_start();
function redirectionUser($login,$password)
{
  $obj = getData();
  $questions = getData('questions');
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
      $_SESSION['questions'] = nbreQuestionParJeu($questions);
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
//recuperation des donnees
function getData($file='fichier'){
  $data = file_get_contents('data'.'/'.$file.'.json');
  $data = json_decode($data,true);
  return $data;
}

//enregistrer donnees
function saveData($data,$file='fichier'){
  $data = json_encode($data);
  file_put_contents('data'.'/'.$file.'.json', $data);
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
  }
  return $tab;
}

//liste des questions 
function listeQuestions($depart,$questionsParPage)
{
  $liste = getData('questions');
  for ($i=$depart; $i < ($depart+$questionsParPage) ; $i++) { 
    if ($i==count($liste)) {
      break;
    }
    
    if ($liste[$i]['type'] == 'choixM') {
      echo $i ."- ". $liste[$i]['question'];
      for ($j=0; $j < (count($liste[$i]['reponses'])/2); $j++) { 
        if ($liste[$i]['reponses']['result'.$j]==true) 
        {?>
          <li>
            <input type="checkbox" name="valeur<?=$j?>" checked="checked">
            <label><?php echo $liste[$i]['reponses']['valeur'.$j]; ?></label>
          </li><?php
        }else{ ?>
          <li>
           <input type="checkbox" name="valeur<?=$j?>">
          <label><?php echo $liste[$i]['reponses']['valeur'.$j]; ?></label>
          </li><?php
        }
      }
    }else if ($liste[$i]['type'] == 'choixS') {
      echo $i ."- ". $liste[$i]['question'];
      for ($j=0; $j < (count($liste[$i]['reponses'])/2); $j++) { 
        if ($liste[$i]['reponses']['result'.$j]==true) { ?>
          <li>
            <input type="radio" name="valeur<?=$i?>" checked="checked" >
            <?php echo $liste[$i]['reponses']['valeur'.$j]; ?>
          </li><?php
        }else{?>
          <li>
            <input type="radio" name="valeur<?=$i?>">
            <?php echo $liste[$i]['reponses']['valeur'.$j]; ?>
          </li><?php
        }
      }
    }else {
      echo $i ."- ". $liste[$i]['question']; ?>
      <li>
        <input type="text" class="form-inscription" name="champs" value="<?= $liste[$i]['reponses']['valeur0'] ?> " readonly>
      </li><?php
    }
  }
}

//generation aleatoire de nombre de question par jeu
function nbreQuestionParJeu($tableauQuestion) {
  $nombre = getData("nombreQuestion");
  $tableau = array();
  while (count($tableau) < $nombre['nombre']) {
    $aleatoire = rand(0,(count($tableauQuestion)-1));
    if (!in_array($tableauQuestion[$aleatoire], $tableau)) {
      $tableau[] = $tableauQuestion[$aleatoire];
    }
  }
  return $tableau;
}

function Score($questions)
{
  $score = 0; $compare = array(); $verifie= array();
  for ($i=0; $i <count($questions) ; $i++)
  { 
    if ($questions[$i]['type']=='choixS') 
    {
      for ($j=0; $j < count($questions[$i]['answer']); $j++) 
      { 
        if ((!empty($questions[$i]['answer'][$j])) && in_array($questions[$i]['answer'][$j], $questions[$i]['reponses'])) 
        {
          $aide=$questions[$i]['answer'][$j];
          if ($questions[$i]['reponses'][$aide] == true) 
          {
            $score = $score + $questions[$i]['nombrePoints'];
          }
        }
      }
    }
    else if ($questions[$i]['type'] == 'choixT') 
    {
      if ((!empty($questions[$i]['answer'])) && $questions[$i]['answer'] == $questions[$i]['reponses']['valeur0']) 
      {
        $score = $score + $questions[$i]['nombrePoints'];
      } 
    }
    else
    {
      for ($j=0; $j < (count($questions[$i]['reponses'])); $j++) 
      { 
        if (!empty($questions[$i]['answer'])) 
        {
          if (isset($questions[$i]['reponses']['result'.$j]) && $questions[$i]['reponses']['result'.$j]==true) 
          {
            $compare[] = 'result'.$j;
            if (count($compare) == count($questions[$i]['answer'])) 
            {
              for ($k=0; $k < count($compare) ; $k++) 
              { 
                if ($compare[$k] == $questions[$i]['answer'][$k]) 
                {
                  $verifie[] = $k;
                }
              }
            }
          }
        }
      }
      if (count($verifie) == count($compare)) 
      {
        $score = $score + $questions[$i]['nombrePoints'];
      }
    } 
  }
  return $score;
}
//var_dump(Score($_SESSION['questions']));
?>
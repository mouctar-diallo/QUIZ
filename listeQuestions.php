<?php
//var_dump($_POST);

function listeQuestions()
{
	$json = 'test.json';
	$liste = file_get_contents($json);
	$liste = json_decode($liste,true);
	for ($i=0; $i < count($liste['questions']) ; $i++) { 
		
		if ($liste['questions'][$i]['type'] == 'choixM') {
			echo $i ."- ". $liste['questions'][$i]['question'];
			for ($j=0; $j < count($liste['questions'][$i]['reponses']); $j++) { ?>
				<li>
					<input type="checkbox" name="champs<?=$j+1?>">
					<?php echo $liste['questions'][$i]['reponses'][$j]; ?>
				</li><?php
			}
		}else if ($liste['questions'][$i]['type'] == 'choixS') {
			echo $i ."- ". $liste['questions'][$i]['question'];
			for ($j=0; $j < count($liste['questions'][$i]['reponses']); $j++) { ?>
				<li>
					<input type="radio" name="champs<?=$j+1?>">
					<?php echo $liste['questions'][$i]['reponses'][$j]; ?>
				</li><?php
			}
		}else {
			echo $i ."- ". $liste['questions'][$i]['question']; ?>
			<li>
				<input type="text" name="champs">
			</li><?php
		}
	}
}
//echo ($liste['questions'][2]['reponses_vraie']);die();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Liste Questions</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="pageAuth">
		<div class="hautAuth">
			<div class="logo"><img src="images/logoQuiz.png"></div>
			<h2 class="align1">Le plaisir de jouer</h2>
		</div>
		<div class="pageAdmin">
			<div class="haut">CRÉER ET PARAMÉRTER VOS QUIZZ</div>
			<a href="authentification.php">
				<input type="submit" name="deconnexion" class="btn-deconnexion" value="Déconnexion">
			</a>
			<div class="menu-side">
				<div class="infoAdmin">
					<div class="picture">
						
					</div>
				</div>
				 <div class="vertical-menu">
					  <a href="#">Liste Questions<img src="images/icones/ic-liste.png" class="icone"></a>
					  <a href="#">Créer Admin<img src="images/icones/ajout.png" class="icone"></a>
					  <a href="#">Liste joueurs<img src="images/icones/ic-liste.png" class="icone"></a>
					  <a href="#">Créer Questions<img src="images/icones/ic-ajout.png" class="icone"></a>
				</div> 
			</div>
			<!-- contenue liste questions-->
			<div class="page-droite">
				<form method="POST" action="">
					Nbre de question/jeu
					<input type="number" name="nombreQuestions" class="form">
					<input type="submit" name="ok" class="btn-ok" value="OK">
				

					<div class="liste">
						<?php listeQuestions(); ?>
					</div>
					<input type="submit" name="suivant" value="suivant" class="btn-suivant">
				</form>
			</div>
			<!-- end -->
	</div>
	</div>
</body>
</html>

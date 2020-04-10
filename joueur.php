<?php

$file = "fichier.json";
$data = file_get_contents($file);
$obj = json_decode($data,true);

?>

<!DOCTYPE html>
<html>
<head>
	<title>page joueur</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="pageAuth">
		<div class="hautAuth">
			<div class="logo"><img src="images/logoQuiz.png" style="width: 100px; height: 120px;"></div>
			<h2>Le plaisir de jouer</h2>
		</div>
		<div class="pageAdmin">
			<div class="haut">
				<div class="photoJoueur">
					<img src="images/<?php if(isset($_GET['id'])){ echo $obj['joueurs'][$_GET['id']]['image'];}?>">
				</div>
				<i><?php if(isset($_GET['id'])){ echo $obj['joueurs'][$_GET['id']]['prenom'] ."<br>".
					 $obj['joueurs'][$_GET['id']]['nom']; } ?>	
				</i>
				BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ<br>
				JOUER ET TESTER VOTRE NIVEAU DE CULTURE GÉNÉRALE
			</div>
			<a href="authentification.php">
				<input type="submit" name="deconnexion" class="btn-deconnexion" value="Déconnexion">
			</a>
			<div class="ReponseJoueur"></div>
			<div class="TopScorer">
				<div class="top">
					<a href="#">Top scores</a>
					<a href="#">Mon meilleure score</a>
				</div>
			</div>
	</div>
	</div>
</body>
</html>

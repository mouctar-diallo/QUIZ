<!DOCTYPE html>
<html>
<head>
	<title>Liste Joueurs</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="pageAuth">
		<div class="hautAuth">
			<div class="logo"><img src="images/logoQuiz.png" style="width: 100px; height: 120px;"></div>
			<h2>Le plaisir de jouer</h2>
		</div>
		<div class="pageAdmin">
			<div class="haut">CRÉER ET PARAMÉRTER VOS QUIZZ</div>
			<a href="authentification.php">
				<input type="submit" name="deconnexion" class="btn-deconnexion" value="Déconnexion">
			</a>
			<div class="menu-side">
				<div class="infoAdmin"></div>
				 <div class="vertical-menu">
					  <a href="#">Liste Questions<img src="images/icones/ic-liste.png" class="icone"></a>
					  <a href="#">Créer Admin<img src="images/icones/ajout.png" class="icone"></a>
					  <a href="#">Liste joueurs<img src="images/icones/ic-liste.png" class="icone"></a>
					  <a href="#">Créer Questions<img src="images/icones/ic-ajout.png" class="icone"></a>
				</div> 
			</div>
			<!-- contenue liste questions-->
			<div class="page-droite">
				<strong>LISTE DES JOUEURS PAR SCORE</strong>
				<div class="listeJoueur">liste des joueurs here............</div>
				<input type="submit" name="suivant" value="suivant" class="btn-suivant">
			</div>
			<!-- end -->
	</div>
	</div>
</body>
</html>

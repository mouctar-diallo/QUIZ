<?php
is_connect();
?>
<!DOCTYPE html>
<html>
<head>
	<title>page joueur</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
		<div class="pageAdmin">
			<div class="haut">
				<div class="photoJoueur">
					<img src="images/<?php if(isset($_SESSION['joueur'])){ echo $_SESSION['joueur']['image'];}?>">
				</div>
				<i><?php if(isset($_SESSION['joueur'])){ echo $_SESSION['joueur']['nom'] ."<br>".
					 $_SESSION['joueur']['prenom']; } ?>	
				</i>
				BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ<br>
				JOUER ET TESTER VOTRE NIVEAU DE CULTURE GÉNÉRALE
			</div>
			<a href="index.php?statut=deconnecter">
				<input type="submit" name="deconnexion" class="btn-deconnexion" value="Déconnexion">
			</a>
			<div class="ReponseJoueur">
				<input type="submit" name="btn-suivant" class="btn-suiv-joueur" value="suivant">
				<input type="submit" name="btn-precedent" class="btn-prec-joueur" value="precedent">
			</div>
			<div class="TopScorer">
				<div class="top">
					<a href="#">Top scores</a>
					<a href="#">Mon meilleure score</a>
				</div>
			</div>
	</div>
</body>
</html>

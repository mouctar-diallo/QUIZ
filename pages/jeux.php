<?php
is_connect();
$fichier = 'fichier.json';
$fichier = file_get_contents($fichier);
$players = json_decode($fichier,true);
$TopScorers = $players['joueurs'];

$TopScorers = triDecroissant($TopScorers);
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
				<i><?php if(isset($_SESSION['joueur'])){ echo $_SESSION['joueur']['nom'] ."<br>". $_SESSION['joueur']['prenom']; } ?>	
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
				<div class="colonne"><a href="index.php?controlPage=jeux&verifier=top">Top scores</a></div>
				<div class="colonne"><a href="index.php?controlPage=jeux&verifier=moi">Mon meilleure score</a></div>
				<?php
					if (isset($_GET['verifier'])) 
					{
						$verifier = $_GET['verifier'];
						switch ($verifier) 
						{
							case 'top':
								top5_players($TopScorers);
							break;
							case 'moi': ?>
								<div class="first-name"><?php echo $_SESSION['joueur']['nom']; ?></div>
							    <div class="first-name"><?php echo $_SESSION['joueur']['prenom']; ?></div>
							    <div class="first-name"><?php echo $_SESSION['joueur']['score']; ?></div> <?php
							break;
						}
					}
				?>
			</div>
	</div>
</body>
</html>

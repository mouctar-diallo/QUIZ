<?php
include('../fonction.php');
is_connect();

?>


<!DOCTYPE html>
<html>
<head>
	<title>ADMINISTRATION</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="../js/script.js"></script>
</head>
<body>

<div class="pageAuth">
		<div class="hautAuth">
			<div class="logo"><img src="../images/logoQuiz.png"></div>
			<h2 class="align1">Le plaisir de jouer</h2>
		</div>
		<div class="pageAdmin">
			<div class="haut">CRÉER ET PARAMÉRTER VOS QUIZZ</div>
			<a href="../index.php?statut=deconnecter">
				<input type="submit" name="deconnexion" class="btn-deconnexion" value="Déconnexion">
			</a>
			<div class="menu-side">
				<div class="infoAdmin">
					<div class="picture">
						<img src="../images/<?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['image'];}?>">
					</div>
					<i>
						<?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['nom'] ."<br>".$_SESSION['admin']['prenom']; } ?>	
					</i><br>
				</div>
				 <div class="vertical-menu">
					  <a href="accueil.php?p=listq">Liste Questions<img src="../images/icones/ic-liste.png" class="icone"></a>
					  <a href="accueil.php?p=add">Créer Admin<img src="../images/icones/ajout.png" class="icone"></a>
					  <a href="accueil.php?p=listj">Liste joueurs<img src="../images/icones/ic-liste.png" class="icone"></a>
					  <a href="accueil.php?p=addQ">Créer Questions<img src="../images/icones/ic-ajout.png" class="icone"></a>
				</div> 
			</div>
			<!-- contenue liste questions-->
			<div class="page-droite">
				<?php
				if (isset($_GET['p'])) {
					$page  = $_GET['p'];
					switch ($page) {
						case 'listq':
							include('listeQuestions.php');
						break;
						case 'add':
							include('inscription.php');
						break;
						case 'listj':
							include('joueurs.php');
						break;
						case 'addQ':
							include('questions.php');
						break;
					}
				}
				?>
			</div>
			<!-- end -->
	</div>
	</div>
</body>
</html>

<?php
is_connect();
?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMINISTRATION</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="js/script.js"></script>
	<style type="text/css">
		@media only screen and (max-width: 768px) {
			body{
				width: 100%;
				height: 100%;
				margin: 0 auto;
				background-image: url(images/bg.jpg);
			}
			.pageAuth{
				margin-top: -20px;
			}
		}
	</style>
</head>
<body>
	<div class="pageAdmin">
		<div class="haut">CRÉER ET PARAMÉRTER VOS QUIZZ</div>
		<a href="index.php?statut=deconnecter">
			<input type="submit" name="deconnexion" class="btn-deconnexion" value="Déconnexion">
		</a>
		<div class="menu-side">
			<div class="infoAdmin">
				<div class="picture">
					<img src="images/<?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['image'];}?>">
				</div>
				<i>
					<?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['nom'] ."<br>".$_SESSION['admin']['prenom']; } ?>	
				</i><br>
			</div>
			 <div class="vertical-menu">
			 	<a href="index.php?controlPage=accueil&p=dashbord">Tableau de bord<img src="images/icones/ic-liste.png" class="icone"></a>
				  <a href="index.php?controlPage=accueil&p=listq">Liste Questions<img src="images/icones/ic-liste.png" class="icone"></a>
				  <a href="index.php?controlPage=accueil&p=add">Créer Admin<img src="images/icones/ajout.png" class="icone"></a>
				  <a href="index.php?controlPage=accueil&p=listj">Liste joueurs<img src="images/icones/ic-liste.png" class="icone"></a>
				  <a href="index.php?controlPage=accueil&p=addQ">Créer Questions<img src="images/icones/ic-ajout.png" class="icone"></a>
			</div> 
		</div>
		<div class="page-droite">
			<?php
			if (isset($_GET['p'])) {
				$page  = $_GET['p'];
				switch ($page) {
					case 'listq':
						include('listeQuestions.php');
					break;
					case 'add':
						include('pages/inscription.php');
					break;
					case 'listj':
						include('joueurs.php');
					break;
					case 'addQ':
						include('questions.php');
					break;
					case 'edit':
						include('editQuestion.php');
					break;
				}
			}else{
				include('joueurs.php');
			}
			?>
		</div>
	</div>
</body>
</html>

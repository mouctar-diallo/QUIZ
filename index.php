<?php 
	include('fonction.php'); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>MINI-PROJET</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="pageAuth">
		<div class="hautAuth">
			<div class="logo"><img src="images/logoQuiz.png"></div>
			<h2 class="align1">Le plaisir de jouer</h2>
		</div>
		<?php
			if (isset($_GET['controlPage'])) 
			{
				$page = $_GET['controlPage'];
				switch ($page) 
				{
					case 'accueil':
						include('pages/accueil.php');
					break;
					case 'jeux':
						include('pages/jeux.php');
					break;
				}
			}
			if (!isset($_GET['controlPage'])) {
				require_once('authentification.php');
			}
		?>
	</div>
</body>
</html>


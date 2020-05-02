<?php 
	include('fonction.php'); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>MINI-PROJET</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
				require_once('pages/authentification.php');
			}
		?>
	</div>
</body>
</html>


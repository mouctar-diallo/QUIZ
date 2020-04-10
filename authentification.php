<?php
include('fonction.php');
$login = ""; $error = "";
if (isset($_POST['connexion'])) {
	$login =  $_POST['login'];
	$password = $_POST['password'];
	if (!empty($login) && !empty($password)) {
		redirectionUser($login,$password);
		$error = "login ou mot de passe incorrecte";

	}else{
		$error = "remplissez tout les champs";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>AUTHENTIFICATION</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="pageAuth">
		<div class="hautAuth">
			<div class="logo"><img src="images/logoQuiz.png" style="width: 100px; height: 120px;"></div>
			<h2>Le plaisir de jouer</h2>
		</div>
		<div class="LoginForm"><h2>Login Form</h2></div>
		<div class="formulaire">
			<form method="POST" action="">
				<input type="text" name="login" class="form-control" placeholder="Login" value="<?php echo $login?>">
				<img src="images/icones/ic-login.png">
				<input type="password" name="password" class="form-control" placeholder="Password">
				<img src="images/icones/ic-password.png">
				<span><?php if(!empty($error)){ echo $error; } ?></span><br>
				<input type="submit" name="connexion" class="btn-connexion" value="connexion">
			</form>
				<h5><a href="CompteUser.php">S'inscrire pour jouer ?</a></h5>
		</div>
	</div>
</body>
</html>
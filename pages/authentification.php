<?php
if (isset($_GET['statut']) && $_GET['statut']=='deconnecter') 
{	
	deconnexion();
}
$login = ""; $error = "";
if (isset($_POST['connexion'])) 
{
	$login =  $_POST['login'];
	$password = $_POST['password'];
	if (!empty($login) && !empty($password)) 
	{
		redirectionUser($login,$password);
		$error = "login ou mot de passe incorrecte";
	}else{
		$error = "tout les champs sont obligatoire";
	}
}
?>
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
        h5{
          margin-top: 2%;
        }
        span{
        	font-size: 15px;
        }
        .btn-connexion{
        	margin-top: -1%;
        }
        .align{
        	font-size: 15px;
        }
        .form-control, .form-control1{
        	margin-top: 10%;
        	border-radius: 70px;
        }
        .formulaire{
        	
        }
        .LoginForm{
        	margin-top: 15%;
        }
      }
</style>
<div class="LoginForm"><h2 class="align">Login Form</h2><b>x</b></div>
<div class="formulaire">
	<form method="POST" action="" id="form-connexion">
		<input type="text" name="login" error="error-1" class="form-control" placeholder="Login" value="<?php echo $login?>">
		<span id="error-1"></span>
		<input type="password" name="password" error="error-2" class="form-control1" placeholder="Password">
		<span id="error-2"><?php if(!empty($error)){ echo $error; } ?></span><br>
		<input type="submit" name="connexion" class="btn-connexion" value="connexion">
	</form>
		<h5><a href="inscription.php">S'inscrire pour jouer ?</a></h5>
</div>

<script type="text/javascript">
	const inputs = document.getElementsByTagName('input');
	
		for (input of inputs) {
			input.addEventListener('keyup',function(e){
				if (e.target.hasAttribute('error')) {
					var span = e.target.getAttribute('error');
					document.getElementById(span).innerText="";
				}
			})
		}

	document.getElementById('form-connexion').addEventListener('submit',function(e){
		const inputs = document.getElementsByTagName('input');
		var erreur = false;
		for (input of inputs) {
			if (input.hasAttribute('error')) {
				var span = input.getAttribute('error');
				if (!input.value) {
					document.getElementById(span).innerText="ce champ est obligatoire"
					erreur = true;
				}else{
					document.getElementById(span).innerText=""
				}
			}
		}
		if (erreur) {
			e.preventDefault();
		}
		return false;
	});
</script>


<?php 
include('fonction.php');
is_connect();
$nom=$prenom=$Login=$password=$confirmer=$image=$message="";

if(isset($_POST['connexion']))
{
	$prenom = $_POST['prenom']; $nom = $_POST['nom']; $Login= $_POST['Login']; 
	$password= $_POST['password']; $confirmer = $_POST['confirmer']; $image = $_FILES['image']['name'];

	if(!empty($prenom) && !empty($nom) && !empty($Login) && !empty($password) && !empty($confirmer) &&  !empty($image)){

		if($password == $confirmer)
		{
			$json = file_get_contents('fichier.json');
			$json = json_decode($json, true);

			$testeur=1;
	        foreach($json['admins'] as $j){
	            if ($j['Login'] == $Login) {
	            	$testeur = 0;
					break;
	            }
	        }
			if ($testeur==1) {
				$Admin = array();
				$Admin['prenom'] = $prenom;
				$Admin['nom'] = $nom;
				$Admin['Login'] = $Login;
				$Admin['password'] = $password;
				$Admin['confirmer'] = $confirmer;
				$Admin['image'] = $image;
				$Admin['profil'] = 'Admin';
				$json['admins'][] = $Admin;
				$json = json_encode($json);
				file_put_contents('fichier.json', $json);
				$message = "l'admin' a bien été ajouté";
			}else{
				$message = "login dejà utilisé";
			}
		}else{
			$message = "les deux mot de passe doivent etre identiques";
		}
	}else{
		$message = "remplissez tout les champs svp";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>compte Admin</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
		<script>
		  var loadFile = function(event) {
		    var reader = new FileReader();
		    reader.onload = function(){
		      var output = document.getElementById('output');
		      output.src = reader.result;
		    };
		    reader.readAsDataURL(event.target.files[0]);
		  };
		</script>
</head>
<body>
	<div class="pageAuth">
		<div class="hautAuth">
			<div class="logo"><img src="images/logoQuiz.png"></div>
			<h2 class="align1">Le plaisir de jouer</h2>
		</div>
		<div class="pageAdmin">
			<div class="haut">CRÉER ET PARAMÉRTER VOS QUIZZ</div>
			<a href="authentification.php?statut=deconnecter">
				<input type="submit" name="deconnexion" class="btn-deconnexion" value="Déconnexion">
			</a>
			<div class="menu-side">
				<div class="infoAdmin">
					<div class="picture">
						<img src="images/<?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['image'];}?>">
					</div>
					<i><?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['nom'] ."<br>".
					  $_SESSION['admin']['prenom']; } ?></i><br>
				</div>
				 <div class="vertical-menu">
					  <a href="#">Liste Questions<img src="images/icones/ic-liste.png" class="icone"></a>
					  <a href="#">Créer Admin<img src="images/icones/ajout.png" class="icone"></a>
					  <a href="#">Liste joueurs<img src="images/icones/ic-liste.png" class="icone"></a>
					  <a href="#">Créer Questions<img src="images/icones/ic-ajout.png" class="icone"></a>
				</div> 
			</div>
			<!-- contenue des pages-->
			<div class="page-droite">
				<strong>S'inscrire pour proposer des quiz</strong> <hr>
				<form method="POST" action="" id="formulaire-admin" enctype="multipart/form-data">
					<label>Prenom</label>
					<span id="error-1"></span>
					<input type="text" name="prenom" error="error-1" class="form-admin" value="<?php echo $prenom;?>">
					<label>Nom</label>
					<span id="error-2"></span>
					<input type="text" name="nom" error="error-2" class="form-admin" value="<?php echo $nom;?>">
					<label>Login</label>
					<span id="error-3"></span>
					<input type="text" name="Login" error="error-3" class="form-admin" value="<?php echo $Login;?>">
					<label>Password</label>
					<span id="error-4"></span>
					<input type="password" name="password" error="error-4" class="form-admin" value="<?php echo $password;?>">
					<label>Confirmer Password</label>
					<span id="error-5"></span>
					<input type="password" name="confirmer" error="error-5" class="form-admin" value="<?php echo $confirmer;?>"><br>
					<label>Image</label>
					<input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
					<input type="file" name="image" accept="image/*"  class="form-admin" onchange="loadFile(event)"><br>
					<div class="avatarAdmin">
						<img  id="output">
						<h4>Avatar Admin</h4>
					</div>
					<span><?php if(!empty($message)){ echo $message; } ?></span><br>
					<input type="submit" name="connexion" class="btn-admin" value="créer compte">
				</form>
			</div>
			<!-- end -->
	</div>
	</div>
</body>
</html>

<script type="text/javascript">
	const inputs = document.getElementsByTagName('input');
	for (input of inputs) {
		input.addEventListener('keyup',function(e){
			if (e.target.hasAttribute('error')) {
				var spanError = e.target.getAttribute('error');
				document.getElementById(spanError).innerText="";
			}
		});
	}
	//controler les champs vides du formulaire
	document.getElementById('formulaire-admin').addEventListener('submit',function(e){
		const inputs = document.getElementsByTagName('input');
		var erreur = false;
		for (input of inputs) {
			if(input.hasAttribute('error')){
				var spanError = input.getAttribute('error');
				if(!input.value){
					document.getElementById(spanError).innerText="champ obligatoire";
					erreur = true;
				}else{
					document.getElementById(spanError).innerText="";
				}
			}
		}
		if (erreur) {
			e.preventDefault();
		}
		return false;
	});
</script>
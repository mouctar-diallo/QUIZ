<?php 
$nom=$prenom=$Login=$password=$confirmer=$image=$error="";

/*if (isset($_POST['valider'])) 
{	//file.php permet le traitement de l'image si on veut l'enregistrer dans un dossier du projet
	//include('file.php');
}*/
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
				echo "l'admin' a bien été ajouté";
			}else{
				$error = "login dejà utilisé";
			}
		}else{
			$error = "les deux mot de passe doivent etre identiques";
		}
	}else{
		$error = "remplissez tout les champs svp";
	}
}
$file = "fichier.json";
$data = file_get_contents($file);
$obj = json_decode($data,true);

//var_dump($obj);
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
			<a href="authentification.php">
				<input type="submit" name="deconnexion" class="btn-deconnexion" value="Déconnexion">
			</a>
			<div class="menu-side">
				<div class="infoAdmin">
					<div class="picture">
						<img src="images/<?php if(isset($_GET['id'])){ echo $obj['admins'][$_GET['id']]['image'];}?>">
					</div>
					<i><?php if(isset($_GET['id'])){ echo $obj['admins'][$_GET['id']]['prenom'] ."<br>".
					  $obj['admins'][$_GET['id']]['nom']; } ?></i><br>
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
				<form method="POST" action="" enctype="multipart/form-data">
					<label>Prenom</label>
					<input type="text" name="prenom" class="form-admin" value="<?php echo $prenom;?>">
					<label>Nom</label>
					<input type="text" name="nom" class="form-admin" value="<?php echo $nom;?>">
					<label>Login</label>
					<input type="text" name="Login" class="form-admin" value="<?php echo $Login;?>">
					<label>Password</label>
					<input type="password" name="password" class="form-admin" value="<?php echo $password;?>">
					<label>Confirmer Password</label>
					<input type="password" name="confirmer" class="form-admin" value="<?php echo $confirmer;?>"><br>
					<label>Image</label>
					<input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
					<input type="file" name="image" accept="image/*"  class="form-admin" onchange="loadFile(event)"><br>
					<div class="avatarAdmin">
						<img  id="output">
						<h4>Avatar Admin</h4>
					</div>

					<span><?php if(!empty($error)){ echo $error; } ?></span><br>
					<input type="submit" name="connexion" class="btn-admin" value="créer compte">
				</form>
			</div>
			<!-- end -->
	</div>
	</div>
</body>
</html>
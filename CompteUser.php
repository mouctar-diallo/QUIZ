<?php 
$nom=$prenom=$Login=$password=$confirmer=$image="";

if(isset($_POST['connexion']))
{
	$prenom = $_POST['prenom']; $nom = $_POST['nom']; $Login = $_POST['Login']; 
	$password= $_POST['password']; $confirmer = $_POST['confirmer']; $image = $_FILES['image']['name'];

	if(!empty($prenom) && !empty($nom) && !empty($Login) && !empty($password) && !empty($confirmer) &&  !empty($image)){

		if($password == $confirmer)
		{
			$json = file_get_contents('fichier.json');
			$json = json_decode($json, true);
			//tester si deux user n'ont pas le meme login
			$testeur=1;
	        foreach($json['joueurs'] as $j){
	            if ($j['Login'] == $Login) {
	            	$testeur = 0;
					break;
	            }
	        }
			if ($testeur==1) {
		        $joueur = array();
				$joueur['prenom'] = $prenom;
				$joueur['nom'] = $nom;
				$joueur['Login'] = $Login;
				$joueur['password'] = $password;
				$joueur['confirmer'] = $confirmer;
				$joueur['image'] = $image;
				$joueur['profil'] = 'joueur';
				$json['joueurs'][] = $joueur;
				$json = json_encode($json);
				file_put_contents('fichier.json', $json);

				echo "le joueur a bien été ajouté";
			}else{
				echo "<center><strong>login dejà utilisé</strong></center>";
			}
		}else{
			echo "<center><strong>les deux mot de passe doivent etre identiques</strong></center>";
		}
	}else{
		echo "remplissez tout les champs svp";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>compte user</title>
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
		<div class="CompteUser">
			<h4>S'inscrire pour tester votre niveau de culture génerale</h4> <hr>
			<form method="POST" action="" enctype="multipart/form-data">
				<label>Prenom</label>
				<input type="text" name="prenom" class="form-inscription" value="<?php echo $prenom;?>">
				<label>Nom</label>
				<input type="text" name="nom" class="form-inscription" value="<?php echo $nom?>">
				<label>Login</label>
				<input type="text" name="Login" class="form-inscription" value="<?php echo $Login?>">
				<label>Password</label>
				<input type="password" name="password" class="form-inscription" value="<?php echo $password?>">
				<label>Confirmer Password</label>
				<input type="password" name="confirmer" class="form-inscription" value="<?php echo $confirmer?>"><br>
				<label>Image</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
				<input type="file" name="image" accept="image/*" class="form-inscription" onchange="loadFile(event)"><br>
				<!--<input type="submit" name="valider" value="afficher image" class="form-image"/><br>-->
				<div class="avatar">
					<img  id="output">
					<h4>Avatar du joueur</h4>
				</div>
				<input type="submit" name="connexion" class="btn-inscription" value="créer compte">
			</form>
		</div>
	</div>
</body>
</html>
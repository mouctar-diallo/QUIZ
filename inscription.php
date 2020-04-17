<?php 
$nom=$prenom=$Login=$password=$confirmer=$image=$message="";
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

				$message = loadImage();
				if ($message) 
				{
					$joueur = array();
					$joueur['prenom'] = $prenom;
					$joueur['nom'] = $nom;
					$joueur['Login'] = $Login;
					$joueur['password'] = $password;
					$joueur['confirmer'] = $confirmer;
					$joueur['image'] = $image;
					$joueur['score'] = 0;
					$joueur['profil'] = 'joueur';
					$json['joueurs'][] = $joueur;
					$json = json_encode($json);
					file_put_contents('fichier.json', $json);

					header('location:index.php');
				}else{ 
					$message = "seul les extensions jpg et jpeg sont autorisé";
				} 
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
			<form method="POST" action="" id="form-save-user" enctype="multipart/form-data">
				<label>Prenom</label>
				<span id="error-1"></span>
				<input type="text" name="prenom" error ="error-1" class="form-inscription" value="<?php echo $prenom;?>">
				<label>Nom</label>
				<span id="error-2"></span>
				<input type="text" name="nom" error ="error-2" class="form-inscription" value="<?php echo $nom?>">
				<label>Login</label>
				<span id="error-3"></span>
				<input type="text" name="Login" error ="error-3" class="form-inscription" value="<?php echo $Login?>">
				<label>Password</label>
				<span id="error-4"></span>
				<input type="password" name="password" error ="error-4" class="form-inscription" value="<?php echo $password?>">
				<label>Confirmer Password</label>
				<span id="error-5"></span>
				<input type="password" name="confirmer" error ="error-5" class="form-inscription" value="<?php echo $confirmer?>"><br>
				<label>Image</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
				<input type="file" name="image" class="form-inscription" onchange="loadFile(event)"><br>
				<div class="avatar">
					<img  id="output">
					<h4>Avatar du joueur</h4>
				</div><br>
				<span><?php if(!empty($message)){ echo $message; } ?></span><br>
				<input type="submit" name="connexion" class="btn-inscription" value="créer compte">
			</form>
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
				document.getElementById(spanError).innerText = "";
			}
		});
	}
	var erreur = false;
	document.getElementById('form-save-user').addEventListener('submit',function(e){
		for (input of inputs) {
			if (input.hasAttribute('error')) {
				var spanError = input.getAttribute('error');
				if (!input.value) {
					document.getElementById(spanError).innerText='champ obligatoire';
					erreur =true;
				}else{
					document.getElementById(spanError).innerText= "";
				}
			}
		}
		if (erreur) {
			e.preventDefault();
		}
		return false;
	});
</script>
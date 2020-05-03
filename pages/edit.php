<?php 
include('../fonction.php');
$json = file_get_contents('../data/fichier.json');
$json = json_decode($json,true);
$message="";
if (isset($_GET['login'])) 
{
	$login =  $_GET['login'];
	$position = 0;
    for($i = 0; $i< count($json['joueurs']);$i++){
        if ($json['joueurs'][$i]['Login'] == $login) {
        	$position = $i;
			break;
        }
    }

if(isset($_POST['connexion']))
{
	$prenom = $_POST['prenom']; $nom = $_POST['nom'];

	if(!empty($prenom) && !empty($nom))
	{
		$json['joueurs'][$position]['prenom'] = $prenom;
		$json['joueurs'][$position]['nom'] = $nom;
		$json[$position]['joueurs'] = $json;
		$json = json_encode($json);
		$json = file_put_contents('../data/fichier.json', $json);

		header('location:../index.php?controlPage=accueil&p=listj');
	}else{
		$message = "remplissez tout les champs svp";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Modificatiob joueur</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
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
			<div class="logo"><img src="../images/logoQuiz.png"></div>
			<h2 class="align1">Le plaisir de jouer</h2>
		</div>
		<div class="CompteUser">
			<h4>Modification infos joueurs</h4> <hr>
			<form method="POST" action="" id="form-save-user" enctype="multipart/form-data">
				<label>Prenom</label>
				<span id="error-1"></span>
				<input type="text" name="prenom" error ="error-1" class="form-inscription" value="<?php echo $json['joueurs'][$position]['prenom'];?>">
				<label>Nom</label>
				<span id="error-2"></span>
				<input type="text" name="nom" error ="error-2" class="form-inscription" value="<?php echo $json['joueurs'][$position]['nom']?>">
				<span><?php if(!empty($message)){ echo $message; } ?></span><br>
				<input type="submit" name="connexion" class="btn-inscription" value="créer compte">
			</form>
		</div>
	</div>
</body>
</html>
<?php
}
?>
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
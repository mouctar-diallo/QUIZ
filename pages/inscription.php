<?php 
is_connect();
$nom=$prenom=$Login=$password=$confirmer=$image=$message="";

if(isset($_POST['connexion']))
{
	$prenom = $_POST['prenom']; $nom = $_POST['nom']; $Login= $_POST['Login']; 
	$password= $_POST['password']; $confirmer = $_POST['confirmer']; $image = $_FILES['image']['name'];

	if(!empty($prenom) && !empty($nom) && !empty($Login) && !empty($password) && !empty($confirmer) &&  !empty($image)){

		if($password == $confirmer)
		{
			$json = getData();
			$testeur=1;
	        foreach($json['admins'] as $j){
	            if ($j['Login'] == $Login) {
	            	$testeur = 0;
					break;
	            }
	        }
			if ($testeur==1) {
				$message = loadImage();
				if($message)
				{
					$Admin = array();
					$Admin['prenom'] = $prenom;
					$Admin['nom'] = $nom;
					$Admin['Login'] = $Login;
					$Admin['password'] = $password;
					$Admin['image'] = $image;
					$json['admins'][] = $Admin;
					$json = saveData($json);
					$message = "l'admin' a bien été ajouté";
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
<!--<div class="CompteUser"> -->
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
	<input type="file" name="image" class="btn-file" onchange="loadFile(event)"><br>
	<div class="avatarAdmin">
		<img  id="output">
		<h4>Avatar Admin</h4>
	</div><br>
	<span><?php if(!empty($message)){ echo $message; } ?></span>
	<input type="submit" name="connexion" class="btn-admin" value="créer compte">
</form>


<script type="text/javascript">
	//fonction qui gere l'affichage de l'image
	var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
//fin
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
<?php
$message = "";
$questions = array();
@$points =  $_POST['nombrePoints'];
if (isset($_POST['enregister'])) {
	if (empty($_POST['question']) && empty($_POST['nombrePoints'])) {
		$message = "champ* obligatoire";
	}else{
		$questions = $_POST;
		var_dump($questions);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Questions</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript">
		var increment=0;
		var control=0;
		function dynamique(){
			increment++
			var type = document.getElementById('type').value
			var dynamique = document.getElementById('dynamique')
			if(type=='0')
			{
				alert('choisissez le type svp')
			}else{
				if(type=='choixT'){
					control++
					if(control==1)
					{
						champ = document.createElement('input')
						champ.setAttribute('type','text')
						champ.setAttribute('class','form-dynamique')
						champ.setAttribute('name','champs'+increment)
						champ.setAttribute('placeholder','entrer la reponse')
						dynamique.appendChild(champ)
					}else{alert('un seul champ autorisé pour le type texte')}
				}
			
			if (type=='choixM') 
			{
				champ = document.createElement('input')
				champ.setAttribute('type','text')
				champ.setAttribute('class','form-dynamique')
				champ.setAttribute('name','champs'+increment)
				champ.setAttribute('required','required')
				champ.setAttribute('placeholder','entrer une reponse')
				dynamique.appendChild(champ)
				//checkbox
				var checkbox = document.createElement('input')
				checkbox.setAttribute('type','checkbox')
				checkbox.setAttribute('name','champs[]')
				checkbox.setAttribute('id','check')
				checkbox.setAttribute('value','champ'+increment)
				dynamique.appendChild(checkbox);

				var btn_supp = document.createElement('input')
				btn_supp.setAttribute('type','button')
				btn_supp.setAttribute('class','btn-delete')
				btn_supp.setAttribute('name','supprimer')
				dynamique.appendChild(btn_supp)
				
			}else if(type=='choixS'){
				champ = document.createElement('input')
				champ.setAttribute('type','text')
				champ.setAttribute('class','form-dynamique')
				champ.setAttribute('name','champs'+increment)
				champ.setAttribute('placeholder','entrer une reponse')
				dynamique.appendChild(champ)
				//radio
				var radio = document.createElement('input')
				radio.setAttribute('type','radio')
				radio.setAttribute('name','champs')
				radio.setAttribute('value','champ'+increment)
				dynamique.appendChild(radio);

				var btn_supp = document.createElement('input')
				btn_supp.setAttribute('type','button')
				btn_supp.setAttribute('class','btn-delete')
				btn_supp.setAttribute('name','supprimer')
				dynamique.appendChild(btn_supp)
			}
		}
	}
	/*function Check()
	{
		var box = document.getElementById('check')
		if (box.type.toLowerCase()=='checkbox'  && c.checked == true) { 
		
		}
	}*/
	</script>
</head>
<body>

<div class="pageAuth">
		<div class="hautAuth">
			<div class="logo"><img src="images/logoQuiz.png" style="width: 100px; height: 120px;"></div>
			<h2>Le plaisir de jouer</h2>
		</div>
		<div class="pageAdmin">
			<div class="haut">CRÉER ET PARAMÉRTER VOS QUIZZ</div>
			<a href="authentification.php">
				<input type="submit" name="deconnexion" class="btn-deconnexion" value="Déconnexion">
			</a>
			<div class="menu-side">
				<div class="infoAdmin"></div>
				 <div class="vertical-menu">
					  <a href="#">Liste Questions<img src="images/icones/ic-liste.png" class="icone"></a>
					  <a href="#">Créer Admin<img src="images/icones/ajout.png" class="icone"></a>
					  <a href="#">Liste joueurs<img src="images/icones/ic-liste.png" class="icone"></a>
					  <a href="#">Créer Questions<img src="images/icones/ic-ajout.png" class="icone"></a>
				</div> 
			</div>
			<!-- contenue liste questions-->
			<div class="page-droite">
				<strong>PARAMETRER VOTRE QUESTION</strong>
				<div class="questionnaire">
					<form method="POST" action="">
					<label>Questions</label>
					<span><?= $message ?></span>
					<textarea name="question"></textarea>
					<label>Nbre des points</label>
					<span><?= $message ?></span>
					<input type="number" name="nombrePoints" class="form" value="<?= $points ?>">
					<label>type de réponse</label>
					<select name="type" id="type">
						<option value="0">Donnez le type de reponse</option>
						<option value="choixM">choix multiple</option>
						<option value="choixS">choix simple</option>
						<option value="choixT">choix texte</option>
					</select>
					<input type="button" name="add" class="btn-add"  id="add" onclick="dynamique()">
					<div class="dynamique" id="dynamique">
						
					</div>
					<input type="submit" name="enregister" value="enregister" class="btn-enregistrer">
				</form>
				</div>
			</div>
			<!-- end -->
	</div>
	</div>
</body>
</html>

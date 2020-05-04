<?php
is_connect();
$players = getData();
$TopScorers = $players['joueurs'];
$TopScorers = triDecroissant($TopScorers);
if (isset($_SESSION['id'])) 
{
	$idjoueur = $_SESSION['id'];
}
$nombre = getData("nombreQuestion");
$questionParPage = 1;
if (!empty($_SESSION['questions'])) 
{
	$totalquestions = count($_SESSION['questions']);
}
$nombrePages = ceil($totalquestions/$questionParPage);

if (isset($_POST['btn-suivant'])) 
{
	if (isset($_POST['position'])) 
	{
		$position = intval($_POST['position']);
		$_SESSION['questions'][$position]['answer'] = answerPlayer($position);
		$position++;
		if ($position==$nombre['nombre']) 
		{
			header('location:pages/resultat.php');
			$position=$nombre['nombre']-1;
			if (isset($idjoueur) && $players['joueurs'][$idjoueur]['score'] < Score($_SESSION['questions'])) 
			{
				$players['joueurs'][$idjoueur]['score'] = Score($_SESSION['questions']);
				saveData($players);
			}
		}
	}
}
else
{
	$position = 0;
}
$debut = ($position-1)*$questionParPage;
if (isset($_POST['btn-precedent'])) 
{	$position = intval($_POST['position']);
	if ($position) 
	{
		$position--;
		if ($position<0) 
		{
			$position=0;
		}
	}
}
function answerPlayer($position){
	$answerPlayer =array();
	if (!empty($_POST['result'])) {
		$answerPlayer = $_POST['result'];
	}
	return $answerPlayer;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>page joueur</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<div class="pageAdmin">
		<div class="haut">
			<div class="photoJoueur">
				<img src="images/<?php if(isset($_SESSION['joueur'])){ echo $_SESSION['joueur']['image'];}?>">
			</div>
			<i><?php if(isset($_SESSION['joueur'])){ echo $_SESSION['joueur']['nom'] ."<br>". $_SESSION['joueur']['prenom']; } ?>	
			</i>
			BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ<br>
			JOUER ET TESTER VOTRE NIVEAU DE CULTURE GÉNÉRALE
		</div>
		<a href="index.php?statut=deconnecter">
			<input type="submit" name="deconnexion" class="btn-deconnexion" value="Déconnexion">
		</a>
		<div class="ReponseJoueur">
			<strong>QUESTIONS <?php echo $position+1 .'/'.$nombre['nombre'];?></strong>
			<h5><?php echo $_SESSION['questions'][$position]['nombrePoints'];?> pts</h5>
			<form method="POST" action="" id="form">
				<input type="hidden" name="" value="<?php echo $nombre['nombre'];?>" id= "limit">
				<input type="hidden" value="<?php echo $_SESSION['questions'][$position]['type']?>" id="type">
				<input type="hidden" name="position" value="<?php echo $position; ?>" id="position">
				<textarea name="question" readonly><?php echo $_SESSION['questions'][$position]['question'];?></textarea>
				<div class="affiche-reponse">
				<?php
					for ($i=$debut; $i <($debut+$questionParPage); $i++) 
					{ 
						if ($_SESSION['questions'][$position]['type']=='choixM') 
						{
							for ($j=0; $j < (count($_SESSION['questions'][$position]['reponses'])/2); $j++) 
							{
								if (!empty($_SESSION['questions'][$position]['answer']) && in_array('result'.$j, $_SESSION['questions'][$position]['answer'])) 
								{?>
									<li>
										<input type="checkbox" checked name="result[]" value="result<?=$j?>">
										<?php echo $_SESSION['questions'][$position]['reponses']['valeur'.$j];?>
								  	</li><?php
								}else{?>
								
								<li>
									<input type="checkbox" name="result[]" value="result<?=$j?>">
									<?php echo $_SESSION['questions'][$position]['reponses']['valeur'.$j];?>
							  </li><?php
							  }
							}
						}
						else if ($_SESSION['questions'][$position]['type']=='choixS') 
						{
							for ($j=0; $j < (count($_SESSION['questions'][$position]['reponses'])/2); $j++) 
							{
								if (!empty($_SESSION['questions'][$position]['answer']) && in_array('result'.$j, $_SESSION['questions'][$position]['answer'])) 
								{?>
									<li>
										<input type="radio" checked name="result[]" value="result<?php echo $j?>">
										<?php echo $_SESSION['questions'][$position]['reponses']['valeur'.$j];?>
								 	</li><?php
								}else{ ?>
								
								<li>
									<input type="radio"  name="result[]" value="result<?php echo $j?>">
									<?php echo $_SESSION['questions'][$position]['reponses']['valeur'.$j];?>
							  	</li><?php
								}
							}
						}
						else
						{
							for ($j=0; $j < (count($_SESSION['questions'][$position]['reponses'])/2); $j++) 
							{
								if (!empty($_SESSION['questions'][$position]['answer'])) 
								{?>
									<li>
										<input type="text" class="form-rep" name="result" value="<?php echo $_SESSION['questions'][$position]['answer'];?>">
								  	</li><?php
								}else{
									?>
									<li>
										<input type="text" class="form-rep" name="result" error="error">
										<span id="error"></span>
								  	</li><?php
								}
							}
						}
					}
				?>
				</div>
				<input type="submit" name="btn-suivant" class="btn-suiv-joueur" value="suivant" id="checked">
				<input type="submit" name="btn-precedent" class="btn-prec-joueur" value="precedent" id="prec">
			</form>
		</div>
		<div class="TopScorer">
			<div class="colonne"><a href="index.php?controlPage=jeux&verifier=top">Top scores</a></div>
			<div class="colonne"><a href="index.php?controlPage=jeux&verifier=moi">Mon meilleure score</a></div>
			<?php
				if (isset($_GET['verifier'])) 
				{
					$verifier = $_GET['verifier'];
					switch ($verifier) 
					{
						case 'top':
							top5_players($TopScorers);
						break;
						case 'moi': ?>
							<div class="first-name"><?php echo $_SESSION['joueur']['nom']; ?></div>
						    <div class="first-name"><?php echo $_SESSION['joueur']['prenom']; ?></div>
						    <div class="first-name"><?php if(isset($_SESSION['id'])){ echo $players['joueurs'][$idjoueur]['score'];} ?></div> <?php
						break;
					}
				}
				else
				{
					top5_players($TopScorers);
				}
			?>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
document.getElementById('checked');
var position = document.getElementById('position').value;
var limit = document.getElementById('limit').value;
var btn_terminer = document.createElement('input');
var formulaire = document.getElementById('form');
if (position==limit-1) 
{
	btn_terminer = document.getElementById('checked');
	btn_terminer.setAttribute('value','terminer');
	btn_terminer.setAttribute('style','background-color:#0c57e6eb;color:white');
}

/*//validation des inputs de type texte
document.getElementById('checked').addEventListener('click',function(e){
	var error = false;
	const texts = document.getElementsByTagName('input');
	for (text of texts) {
		if (text.hasAttribute('error')) {
			var span = text.getAttribute('error');
			if (!text.value) {
				document.getElementById(span).innerText = "ce champ est obligatoire";
				error = true;
			}
		}
	}
	if (error) {
		e.preventDefault();
	}
	return false;
});
//controle de saisie for input checkbox
var type = document.getElementById('type').value;
if (type == 'choixM') {
	$(function(){
		$('#checked').click(function(){
			var checkbox = $("input[type='checkbox']:checked").length;
			if (checkbox < 1) {
				alert('veuillez cochez au moins une reponse');
				return false;
			}
		});
	});
//controle de saisie for input checkbox
}else if (type == 'choixS') {
	$(function(){
		$('#checked').click(function(){
			var radio = $("input[type='radio']:checked").val();
			if (!radio) {
				alert('veuillez repondre si vous voulez continuez');
				return false;
			}
		});
	});
}*/
</script>
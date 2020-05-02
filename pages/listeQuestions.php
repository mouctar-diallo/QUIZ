<?php
$pageActuelle = "";
$liste = getData('questions');
$questionsParPage = 5;
$total = count($liste);
$nombrePage = ceil($total/$questionsParPage);
if (isset($_POST['suivant'])) 
{
	$pageActuelle = $_POST['pageActuelle'];
	$pageActuelle++;
	if ($pageActuelle> $nombrePage) 
	{
		$pageActuelle = $nombrePage;
	}
}
else
{
	$pageActuelle = 1;
}
$depart = ($pageActuelle-1)*$questionsParPage;
//END PAGINATION
if (isset($_POST['ok'])) 
{
	if (!empty($_POST['nombreQuestions'])) 
	{
		$nombre = $_POST['nombreQuestions'];
		$data = getData('nombreQuestion');
		$data['nombre'] = $nombre;
		saveData($data,'nombreQuestion');
	}
}

?>
<!-- contenue liste questions-->
<link rel="stylesheet" type="text/css" href="css/checkbox.css">
<form method="POST" action="">
	<input type="number" name="nombreQuestions" class="form-ok" id="nbre">
	<input type="submit" name="ok" class="btn-ok" value="OK" id="ok">
	<input type="hidden" name="pageActuelle" value="<?= $pageActuelle; ?>">
	<div class="text-nbre-question">Nbre de question/jeu</div>
	<div class="liste">
		<?php listeQuestions($depart,$questionsParPage); ?>
	</div>
	<input type="submit" name="suivant" value="suivant" class="btn-suivt">
</form>
<!-- end -->
<script type="text/javascript">
	document.getElementById('ok').addEventListener('click',function(e){
		var ok =  document.getElementById('nbre').value;
		if(!ok){
			alert('remplissez le champ svp');
		}else{ 
			alert('enregistré avec succes');
		}
	});
</script>


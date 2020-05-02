<?php
$ErrorQuestion = $ErrorNbpoints = $ErrorType = $type=$nbpoints=$question= $noReponse="";
$reponses_vraie = array();
$reponses = array();
if (isset($_POST['enregister'])) {
	$question = $_POST['question'];
	$nbpoints= $_POST['nombrePoints'];
	$type= $_POST['type'];
	$nbreReponse = $_POST['nbreReponse'];
	if (!empty($nbpoints) && $nbpoints<=1) 
	{
		$ErrorNbpoints = "le nombre de points doit etre superieur a 1";
	}
	if (empty($question)) { 
		$ErrorQuestion = "la question est obligatoire";
	}else if(empty($nbpoints)){
		$ErrorNbpoints = "champ obligatoire";
	}else if(empty($type)){
		$ErrorType = "choisissez le type de reponse";
	}else if(!empty($_POST['champs'])){
	    $data = getData('questions');
	    $questions = array();
	    $questions['question'] = $question;
	    $questions['nombrePoints'] = $nbpoints;
	    $questions['type'] = $type;
	    for ($i=1; $i <= $nbreReponse ; $i++) {
	    	if (!empty($_POST['champs'.$i])) {
	    		$reponses[] = $_POST['champs'.$i];
	    	}else{
	    		$reponses[] = $_POST['champs'];
	    	}
	    }
	    $test = array(); $text = array();
	    $reponses_vraie = $_POST['champs'];
	    for ($i=0; $i < $nbreReponse; $i++) { 
	    	$questions['reponses']['valeur'.$i] = $reponses[$i];
	    	$test[] =  'champ'.($i+1);
	    	$text[] =  'champs';
	    	if (in_array($test[$i], $reponses_vraie) || (!empty($reponses_vraie) && $reponses_vraie == 'champs')){
	    		$questions['reponses']['result'.$i] = true;
	    	}else{
	    		$questions['reponses']['result'.$i] = false;
	    	}
	    }
	    $data[] = $questions;
	    saveData($data,'questions');
	    header('location:index.php?controlPage=accueil&p=addQ');
	}
}
?>

<strong>PARAMETRER VOTRE QUESTION</strong>
<div class="questionnaire">
<form method="POST" action="" id="form-question">
	<input type="hidden" name="nbreReponse" id="nbre">
	<label>Questions</label>
	<span id="error-q"><?= $ErrorQuestion ?></span>
	<textarea name="question" id="error-q"><?php if(isset($question)) echo $question;?></textarea>
	<label>Nbre des points</label><br>
	<span id="error-nbpoints"><?= $ErrorNbpoints ?></span>
	<input type="number" name="nombrePoints" error="error-nbpoints" class="form" value="<?= $nbpoints ?>">
	<label>type de réponse</label><br>
	<span id="error-type"><?= $ErrorType ?></span>
	<select name="type" id="type" error ="error-type">
		<option value="0">selectionner le type de reponse</option>
		<option value="choixM">choix multiple</option>
		<option value="choixS">choix simple</option>
		<option value="choixT">choix texte</option>
	</select>
	<input type="button" name="add" class="btn-add"  id="add">
	<span><?= $noReponse ?></span>
	<div class="dynamique" id="dynamique">
	
	</div>
	<input type="submit" name="enregister" value="enregister" class="btn-enregistrer" id="checked">
</form>
</div>

<script type="text/javascript">
	document.getElementById('add').addEventListener('click',function(e){
		dynamique();
	});

	document.getElementById('type').addEventListener('change',function(e){
		ifChange();
	});

	document.getElementById('form-question').addEventListener('submit',function(e){
		var erreur = false;
		const inputs = document.getElementsByTagName('input');
		for (input of inputs) {
			if (input.hasAttribute('error')) {
				var span = input.getAttribute('error');
				if(!input.value){
					document.getElementById(span).innerText = "champ obligatoire";
					erreur = true;
				}else{
					document.getElementById(span).innerText= "";
				}
			}
		}
		if (erreur) {
			e.preventDefault();
		}
		return false;
	});
</script>

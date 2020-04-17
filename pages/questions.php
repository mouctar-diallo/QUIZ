<?php
$ErrorQuestion = $ErrorNbpoints = $ErrorType = $type=$nbpoints=$question= $noReponse="";
$reponses_vraie = array();
$reponses = array();
if (isset($_POST['enregister'])) {
	$question = $_POST['question'];
	$nbpoints= $_POST['nombrePoints'];
	$type= $_POST['type'];
	$nbreReponse = $_POST['nbreReponse'];
	if (empty($_POST['question'])) { 
		$ErrorQuestion = "la question est obligatoire";
	}else if(empty($_POST['nombrePoints'])){
		$ErrorNbpoints = "entrer le nombre de points";
	}else if(empty($type)){
		$ErrorType = "choisissez le type de reponse";
	}else if(!empty($_POST['champs'])){
		$fichier = 'test.json';
	    $data = file_get_contents($fichier);
	    $data = json_decode($data,true);
	    for ($i=1; $i <= $nbreReponse ; $i++) {
	    	if (!empty($_POST['champs'.$i])) {
	    		$reponses[] = $_POST['champs'.$i];
	    	}
	    }
	    $reponses_vraie = $_POST['champs'];
	    $questions = array();
	    $questions['reponses'] = $reponses;
	    $questions['question'] = $_POST['question'];
	    $questions['nombrePoints'] = $_POST['nombrePoints'];
	    $questions['type'] = $_POST['type'];
	    $questions['reponses_vraie'] = $reponses_vraie;
	  
	    $data['questions'][] = $questions;
	    $data = json_encode($data);
	    file_put_contents($fichier, $data);
	    echo "la question a bien ete enregistrer";
	}else{
		 $noReponse = "entrer quelque reponses";
	}
}
?>

<strong>PARAMETRER VOTRE QUESTION</strong>
<div class="questionnaire">
<form method="POST" action="">
	<input type="hidden" name="nbreReponse" id="nbre">
	<label>Questions</label>
	<span><?= $ErrorQuestion ?></span>
	<textarea name="question"><?php if(isset($question)) echo $question;?></textarea>
	<label>Nbre des points</label>
	<span><?= $ErrorNbpoints ?></span>
	<input type="number" name="nombrePoints" class="form" value="<?= $nbpoints ?>">
	<label>type de réponse</label>
	<span><?= $ErrorType ?></span>
	<select name="type" id="type">
		<option value="0">selectionner le type de reponse</option>
		<option value="choixM">choix multiple</option>
		<option value="choixS">choix simple</option>
		<option value="choixT">choix texte</option>
	</select>
	<input type="button" name="add" class="btn-add"  id="add" onclick="dynamique()">
	<span><?= $noReponse ?></span>
	<div class="dynamique" id="dynamique">
	
	</div>
	<input type="submit" name="enregister" value="enregister" class="btn-enregistrer">
</form>
</div>

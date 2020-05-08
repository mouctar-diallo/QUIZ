<?php
$ErrorQuestion = $ErrorNbpoints = $ErrorType = $type=$nbpoints=$question= $noReponse="";
$reponses_vraie = array();
 $data = getData('questions');

 if (isset($_GET['pos'])) 
 {
 	$position = $_GET['pos'];
 }
$reponses = array();
if (isset($_POST['modifier'])) {
	$question = $_POST['question'];
	$nbpoints= $_POST['nombrePoints'];
	$type= $_POST['type'];
	$nombreChamps = $_POST['nbreReponse'];
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
	    $data[$position]['question'] = $question;
	    $data[$position]['nombrePoints'] = $nbpoints;
	    //$data[$position]['type'] = $type;
	    for ($i=0; $i < $nombreChamps ; $i++) {
	    	if (!empty($_POST['champs'.$i])) {
	    		$reponses[] = $_POST['champs'.$i];
	    	}else{
	    		$reponses[] = $_POST['champs'];
	    	}
	    }
	    $test = array(); $text = array();
	    $reponses_vraie = $_POST['champs'];
	    for ($i=0; $i < $nombreChamps; $i++) { 
	    	$data[$position]['reponses']['valeur'.$i] = $reponses[$i];
	    	$test[] =  'champ'.$i;
	    	$text[] =  'champs';
	    	if (in_array($test[$i], $reponses_vraie) || (!empty($reponses_vraie) && $reponses_vraie == 'champs')){
	    		$data[$position]['reponses']['result'.$i] = true;
	    	}else{
	    		$data[$position]['reponses']['result'.$i] = false;
	    	}
	    }
	    $datas = $data;
	    saveData($datas,'questions');
	    header('location:index.php?controlPage=accueil&p=listq');
	}
}
?>

<strong>MODIFICATION QUESTION</strong>
<div class="questionnaire">
<form method="POST" action="" id="form-question">
	<label>Questions</label>
	<span id="error-q"><?= $ErrorQuestion ?></span>
	<textarea name="question" id="error-q"><?php if(isset($position)){ echo $data[$position]['question']; }?></textarea>
	<label>Nbre des points</label><br>
	<span id="error-nbpoints"><?= $ErrorNbpoints ?></span>
	<input type="number" name="nombrePoints" error="error-nbpoints" class="form" value="<?php if(isset($position)){ echo $data[$position]['nombrePoints'];}?>">
	<label>type de réponse</label><br>
	<span id="error-type"><?= $ErrorType ?></span>
	<select name="type" id="type" error ="error-type">
		<option value="<?php if(isset($position)){ echo $data[$position]['type'];}?>"><?php if(isset($position)){ echo $data[$position]['type'];}?></option>
	</select>
	<input type="button" name="add" class="btn-add"  id="add">
	<span><?= $noReponse ?></span>
	<div class="dynamique" id="dynamique">
		<?php
			$nombreChamps = 0;
			for ($i=0; $i < (count($data[$position]['reponses'])/2) ; $i++) {
				$nombreChamps++ ?>
				<div id="line<?= $i ?>"> 
				<span id="error<?= $i ?>"></span><?php
				if ($data[$position]['type'] == 'choixM') {?>
					<input type="text" class="form-dynamique" error="error<?= $i ?>" name="champs<?php echo $i ?>" value="<?php echo $data[$position]['reponses']['valeur'.$i];  ?>">
					<?php
					if ($data[$position]['reponses']['result'.$i]) {?>
						<input type="checkbox" name="champs[]" value="champ<?= $i ?>" checked><?php
					}else{?>
						<input type="checkbox" name="champs[]" value="champ<?= $i ?>"><?php
					}
				}else if($data[$position]['type'] == 'choixS'){?>
					<input type="text" error="error<?= $i ?>" class="form-dynamique" name="champs<?= $i ?>" value="<?php echo $data[$position]['reponses']['valeur'.$i];  ?>">
					<?php
					if ($data[$position]['reponses']['result'.$i]) {?>
						<input type="radio" name="champs[]" value="champ<?= $i ?>" checked><?php
					}else{?>
						<input type="radio" name="champs[]" value="champ<?= $i ?>"><?php
					}
				}else{?>
						<input type="text" error="error<?= $i ?>" name="champs" class="form-dynamique" value="<?php echo $data[$position]['reponses']['valeur'.$i];  ?>" ><?php
				}?>
				<input type="button" class="btn-delete" name="supprimer<?= $i ?>"  id="sup<?= $i ?>" onclick="deleteChamp('<?= $i ?>');">
				</div><?php
			}
		?>
	</div>
	<input type="hidden" name="nbreReponse" value="<?= $nombreChamps ?>" id="nbre">
	<input type="submit" name="modifier" value="modifier" class="btn-enregistrer" id="checked">
</form>
</div>

<script type="text/javascript">
	var nbreReponse = document.getElementById('nbre').value;
	for (var i = 0; i < nbreReponse; i++) {
		document.getElementById('sup'+i).addEventListener('click',function(e){
			nbreReponse--;
			document.getElementById('nbre').value=nbreReponse;
		});
	}
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

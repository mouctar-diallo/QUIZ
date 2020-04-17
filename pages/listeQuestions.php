<?php

function listeQuestions()
{
	$json = 'test.json';
	$liste = file_get_contents($json);
	$liste = json_decode($liste,true);
	for ($i=0; $i < count($liste['questions']) ; $i++) { 
		
		if ($liste['questions'][$i]['type'] == 'choixM') {
			echo $i ."- ". $liste['questions'][$i]['question'];
			for ($j=0; $j < count($liste['questions'][$i]['reponses']); $j++) { ?>
				<li>
					<input type="checkbox" name="champs<?=$j+1?>">
					<?php echo $liste['questions'][$i]['reponses'][$j]; ?>
				</li><?php
			}
		}else if ($liste['questions'][$i]['type'] == 'choixS') {
			echo $i ."- ". $liste['questions'][$i]['question'];
			for ($j=0; $j < count($liste['questions'][$i]['reponses']); $j++) { ?>
				<li>
					<input type="radio" name="champs<?=$j+1?>">
					<?php echo $liste['questions'][$i]['reponses'][$j]; ?>
				</li><?php
			}
		}else {
			echo $i ."- ". $liste['questions'][$i]['question']; ?>
			<li>
				<input type="text" name="champs">
			</li><?php
		}
	}
}
?>

<!-- contenue liste questions-->
<form method="POST" action="">
	Nbre de question/jeu
	<input type="number" name="nombreQuestions" class="form">
	<input type="submit" name="ok" class="btn-ok" value="OK">

	<div class="liste">
		<?php listeQuestions(); ?>
	</div>
	<input type="submit" name="suivant" value="suivant" class="btn-suivt">
</form>
<!-- end -->

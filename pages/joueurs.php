<?php 
$fichier = 'fichier.json';
$fichier = file_get_contents($fichier);
$players = json_decode($fichier,true);
$_SESSION['joueurs'] = $players['joueurs'];
//trions le tableau sur le score avant de le paginer
$_SESSION['joueurs'] = triDecroissant($_SESSION['joueurs']);
$joueurParPage = 4;
$totalJoueurs = count($_SESSION['joueurs']);
$nombrePages = ceil($totalJoueurs/$joueurParPage);

if (isset($_POST['suivant'])) 
{
	$pageActuelle = intval($_POST['pageActuelle']);
	$pageActuelle++;
	if ($pageActuelle>$nombrePages) 
	{
		$pageActuelle = $nombrePages;
	}
}
else
{
	$pageActuelle=1;
}
$debut = ($pageActuelle-1)*$joueurParPage;
?>

<strong>LISTE DES JOUEURS PAR SCORE</strong>
<div class="listeJoueur">
	<div class="colonne">Nom</div>
	<div class="colonne">Prénom</div>
	<div class="colonne">Score</div>
    <?php
	    for ($i=$debut; $i < ($debut+$joueurParPage) ; $i++) 
		{ 
			if ($i == count( $_SESSION['joueurs'])) 
			{
			 	break;
			}?> 
			<div class="first-name"><?php echo  $_SESSION['joueurs'][$i]['nom']; ?></div>
			<div class="first-name"><?php echo  $_SESSION['joueurs'][$i]['prenom']; ?></div>
			<div class="first-name"><?php echo  $_SESSION['joueurs'][$i]['score']; ?> pts</div> <?php
		}
	?>		
</div>
<form  method="POST" action="">
	<input type="hidden" name="pageActuelle" value="<?php echo $pageActuelle; ?>">
	<input type="submit" name="suivant" value="suivant" class="btn-suivant">
</form>

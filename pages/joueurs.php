<strong>LISTE DES JOUEURS PAR SCORE</strong>
<div class="listeJoueur">
	<div class="colonne">Nom</div>
	<div class="colonne">Prénom</div>
	<div class="colonne">Score</div>
    <?php
		$fichier = 'fichier.json';
		$fichier = file_get_contents($fichier);
		$players = json_decode($fichier,true);
		foreach ($players['joueurs'] as $joueur) { ?>
			<div class="first-name"><?php echo  $joueur['nom']; ?></div>
			<div class="first-name"><?php echo  $joueur['prenom']; ?></div>
			<div class="first-name">0 pts</div> <?php
		} ?>
</div>
<input type="submit" name="suivant" value="suivant" class="btn-suivant">

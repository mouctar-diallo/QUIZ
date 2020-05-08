<?php 

$players = getData();

$_SESSION['joueurs'] = $players['joueurs'];
//trions le tableau sur le score avant de le paginer
$_SESSION['joueurs'] = triDecroissant($_SESSION['joueurs']);
$joueurParPage = 7;
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
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<strong>LISTE DES JOUEURS PAR SCORE</strong>
<div class="listeJoueur">
 <table class="table table-striped table-bordered table-hover" id="datatables-example">
    <thead>
        <tr>
            <th class="col-md-3 col-md-offset-3 btn btn-primary">nom</th>
            <th class="col-md-3 col-md-offset-3 btn btn-primary">prenom</th>
            <th class="col-md-3 col-md-offset-3 btn btn-primary">score</th>
            <th class="col-md-3 col-md-offset-3 btn btn-primary">action</th>
        </tr>
    </thead>
        <tbody>
            <?php
            	for ($i=$debut; $i < ($debut+$joueurParPage) ; $i++) 
				{ 
					if ($i == count($_SESSION['joueurs'])) 
					{
					 	break;
					}
            ?>
            <tr>
                <td><?php echo  $_SESSION['joueurs'][$i]['nom'];?></td>
                <td><?php echo  $_SESSION['joueurs'][$i]['prenom'];?></td>
                <td><?php echo  $_SESSION['joueurs'][$i]['score'];?></td>
            <td>
                <a href="#" class="btn btn-danger btn-circle glyphicon glyphicon-trash" title="supprimer"></a>
                <a href="pages/edit.php?login=<?php echo $_SESSION['joueurs'][$i]['Login'] ?>" class="btn btn-info btn-circle glyphicon glyphicon-pencil" title="modifier"></a>
            </td>

            <?php
                }
             ?>
            </tr>
        </tbody>
 	</table>
</div>
<form  method="POST" action="">
	<input type="hidden" name="pageActuelle" value="<?php echo $pageActuelle; ?>">
	<input type="submit" name="suivant" value="suivant" class="btn-suivant">
</form>
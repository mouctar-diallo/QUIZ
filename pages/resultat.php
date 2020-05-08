<?php
  include('../fonction.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
  <div class="pageAuth">
    <div class="hautAuth">
      <div class="logo"><img src="../images/logoQuiz.png"></div>
      <h2 class="align1">Le plaisir de jouer</h2>
      <a href="../index.php?controlPage=jeux">
        <input class="btn-deconnexion" type="submit" value="retour page jeu"></input>
      </a>
    </div>
    <button type="button" class="SCORE" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">CLIQUEZ ICI</button>
  </div>
<div class="CompteUser">
      

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="btn btn-primary">RECAPITULATIF</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2>VOTRE SCORE: <?php if(!empty($_SESSION['questions'])){ echo Score($_SESSION['questions']);} ?> pts</h2>
        <h2>SCORE TOTAL : <?php if(!empty($_SESSION['questions'])){ echo totalScoreParjeu($_SESSION['questions']);} ?> pts</h2><br>
        <h3 class="btn btn-success">QUESTIONS TROUVES</h3><br>
        <?php
          $recap = Recap($_SESSION['questions']);
          for ($i=0; $i < count($recap); $i++) { ?>
            <li class="btn btn-success btn-circle glyphicon glyphicon-trash"></li>
            <?php echo $recap[$i]. '<br>'; ?><?php
          }
        ?>
     <br>
      <h3 class="btn btn-danger">QUESTIONS NON TROUVES</h3><br>
        <?php
          $recap = Recap($_SESSION['questions']);
          for ($i=0; $i < count($_SESSION['questions']); $i++) { 
              if (!in_array($_SESSION['questions'][$i]['question'],$recap)) {?>
                 <li class="btn btn-danger btn-circle glyphicon glyphicon-trash"></li>
                <?php echo $_SESSION['questions'][$i]['question']. '<br>'; ?><?php
              }
          } 
        ?>
      </div><br>
      <div class="col-lg-3 col-lg-offset-1">
        MERCI ! 
      </div>
      <div class="modal-footer">
        <h2>&copy; Copiright mouctar 2020</h2>
        <button type="button" class="btn btn-danger" data-dismiss="modal">fermer</button>
      </div>
    </div>
    </div>
  </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
<script type="text/javascript">
	$('#exampleModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) 
	  var recipient = button.data('whatever')
	  var modal = $(this)
	  /*modal.find('.modal-title').text('New message to ' + recipient)
	  modal.find('.modal-body input').val(recipient)*/
	})
</script>
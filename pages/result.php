<?php
  include('../fonction.php');
  if (empty($_SESSION['questions'])) 
  {
    header('location:../index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <style type="text/css">
      @media only screen and (max-width: 768px) {
        .btn-retour{
          margin-top: -15%;
          background-color: #0086b3;
          color: #fff;
          border-color: #0086b3;
          opacity: 0.9;
        }
        .align1{
          font-size: 15px;
          margin-right: 15%;
        }
      }
    </style>
</head>
<body>
  <div class="pageRep">
    <div class="hautAuth">
      <div class="logo"><img src="../images/logoQuiz.png"></div>
      <h2 class="align1">Le plaisir de jouer</h2>
      <a href="../index.php?controlPage=jeux">
        <input class="btn-retour" type="submit" value="retour page jeu"></input>
      </a>
    </div>
        <div class="container">
          <div class="Resultat">
            <div class="score">
              VOTRE SCORE : <?php echo Score($_SESSION['questions']);?> pts <br>  
               SCORE TOTAL : <?php  echo totalScoreParjeu($_SESSION['questions']);?> pts 
            </div>

            <div class="vosReponses">
              <div class="recaputiltatif">RESULTAT</div><br>
            <?php
            $faux = '<div class="ic"><h3 class="btn btn-danger btn-circle glyphicon glyphicon-remove"></h3></div>';
            $vraie = '<div class="ic"><h3 class="btn btn-success btn-circle glyphicon glyphicon-ok"></h3></div>';
            $verifie = array();
            $compare = array();
              for ($i=0; $i < count($_SESSION['questions']); $i++) 
              { 
                if ($_SESSION['questions'][$i]['type']=='choixM') 
                {?>
                  <h3><?php echo ($i+1) ."- ". $_SESSION['questions'][$i]['question'];?></h3><?php
                  for ($f=0; $f < (count($_SESSION['questions'][$i]['reponses'])); $f++) 
                  { 
                    if (!empty($_SESSION['questions'][$i]['answer'])) 
                    {
                      if (isset($_SESSION['questions'][$i]['reponses']['result'.$f]) && $_SESSION['questions'][$i]['reponses']['result'.$f]==true) 
                      {
                        $compare[] = 'result'.$f;
                        if (count($compare) == count($_SESSION['questions'][$i]['answer'])) 
                        {
                          for ($k=0; $k < count($compare) ; $k++) 
                          { 
                            if ($compare[$k] == $_SESSION['questions'][$i]['answer'][$k]) 
                            {
                              $verifie[] = $k;
                            }
                          }
                        }
                      }
                    }
                  }
                  if (!empty($_SESSION['questions'][$i]['answer']) && count($verifie) == count($compare)) 
                  {
                    echo $vraie;
                    $compare = [];
                    $verifie=[];
                  }else{
                    echo $faux;
                  }
                  for ($j=0; $j < (count($_SESSION['questions'][$i]['reponses'])/2); $j++) 
                  {
                    if (!empty($_SESSION['questions'][$i]['answer']) && in_array('result'.$j, $_SESSION['questions'][$i]['answer'])) 
                    {?>
                      <li>
                        <input type="checkbox" checked name="result[]" value="result<?=$j?>">
                        <?php echo $_SESSION['questions'][$i]['reponses']['valeur'.$j];?>
                      </li><br><?php
                    }else{?>
                      <li>
                        <input type="checkbox" name="result[]" value="result<?=$j?>">
                        <?php echo $_SESSION['questions'][$i]['reponses']['valeur'.$j];?>
                      </li><br><?php
                    }
                  }
                }
                else if ($_SESSION['questions'][$i]['type']=='choixS') 
                {
                 ?>
                  <h3><?php echo ($i+1) ."- ". $_SESSION['questions'][$i]['question'];?></h3><?php
                   if (empty($_SESSION['questions'][$i]['answer'])) {
                    echo $faux;
                  }
                  for ($j=0; $j < (count($_SESSION['questions'][$i]['reponses'])/2); $j++) 
                  {
                    if (!empty($_SESSION['questions'][$i]['answer']) && in_array('result'.$j, $_SESSION['questions'][$i]['answer'])) 
                    {
                      $aide = 'result'.$j;
                      if ($aide == $_SESSION['questions'][$i]['reponses'][$aide]) {
                        echo $vraie;
                      }else{
                        echo $faux;
                      }
                      ?>
                      <li>
                        <input type="radio" checked name="result<?php echo $i?>">
                        <?php echo $_SESSION['questions'][$i]['reponses']['valeur'.$j];?>
                      </li><br><?php
                    }else{?>
                    <li>
                      <input type="radio"  name="result<?php echo $i?>">
                      <?php echo $_SESSION['questions'][$i]['reponses']['valeur'.$j];?>
                      </li><br><?php
                    }
                  }
                }
                else
                {?>
                  <h3><?php echo ($i+1) ."- ". $_SESSION['questions'][$i]['question'];?></h3><?php
                  for ($j=0; $j < (count($_SESSION['questions'][$i]['reponses'])/2); $j++) 
                  {
                    if (!empty($_SESSION['questions'][$i]['answer'])) 
                    {
                      if ($_SESSION['questions'][$i]['answer'] == $_SESSION['questions'][$i]['reponses']['valeur0']) {
                        echo $vraie;
                      }
                      else{
                        echo $faux;
                      }?>
                      <li>
                        <input type="text"  name="result" value="<?php echo $_SESSION['questions'][$i]['answer'];?>">
                        </li><br><?php
                    }else{
                       echo $faux;
                      ?>
                      <li>
                        <input type="text"  name="result" error="error">
                        <span id="error"></span>
                      </li><br><?php
                    }
                  }
                }
              }
            ?>
          </div>
  </div>
</body>
</html>
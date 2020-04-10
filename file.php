
<?php
// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0)
{
  // Testons si le fichier n'est pas trop gros
  if ($_FILES['image']['size'] <= 1000000)
  {
    // Testons si l'extension est autorisée
    $infosfichier = pathinfo($_FILES['image']['name']);
    $extension_upload = $infosfichier['extension'];
    //les extensions autorises
    $extensions_autorisees = array('jpg','png');
    if (in_array($extension_upload, $extensions_autorisees))
    {
      // On peut valider le fichier et le stocker définitivement
      move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . basename($_FILES['image']['name']));
    }
  }else{
    echo "la taille de l'image est trop grande";
  }
} 
//https://www.chiny.me/exercice-verification-des-champs-de-formulaire-en-php-7-9.php
?> 

 
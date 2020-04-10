<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title> - jsFiddle demo</title>
   
  <script type='text/javascript' src='//code.jquery.com/jquery-1.9.1.js'></script>
   
   
   
  <style type='text/css'> 
  </style>
   
 
 
<script type='text/javascript'>//<![CDATA[
$(window).load(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
             
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
             
            reader.readAsDataURL(input.files[0]);
        }
    }
     
    $("#imgInp").change(function(){
        readURL(this);
    });
});//]]> 
 
</script>
 
 
</head>
<body>
      <form id="form1" runat="server">
        <input type='file' id="imgInp" />
        <img id="blah" src="#" alt="your image" />
    </form>
   
</body>
 
 
</html>

+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
<input type="file" accept="image/*" onchange="loadFile(event)">
<img id="output"/>
<script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>

<?php

function moyenne($N)
{
  $som=0;
  $cpt = 0;
  for ($i=0; $i < $N ; $i++) 
  { 
    $som = $som+$i;
    $cpt++;
  }

  return $som/$cpt;
}
$n=10;
$x = moyenne($n);
echo $x;


       $json = file_get_contents('fichier.json');
      $json = json_decode($json, true);
      function UniqueLogin($login){
        foreach($login['joueurs'] as $j){
   
              if ($j['Login'] == $Login) {
                echo "<center><strong>ce login est dejà utilisé</center></strong>";
              }
          }
      }
      

?>

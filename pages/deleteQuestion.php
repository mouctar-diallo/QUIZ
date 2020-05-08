<?php 
include('../fonction.php');

$json = file_get_contents('../data/questions.json');
$json = json_decode($json,true);
if (isset($_GET['pos'])) 
{
	$position = $_GET['pos'];
    //unset($json[$position]);
   	array_splice($json, $position);
    $json = json_encode($json);
	file_put_contents('../data/questions.json', $json);
	header('location:../index.php?controlPage=accueil&p=listq');
}
?>
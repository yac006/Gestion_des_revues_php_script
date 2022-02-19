<?php 
// revues.php
include ("mysql.inc.php");
include ("revues.inc.php");
/*************************/

if(isset($_POST['op']))
{  

     switch($_POST['op'])
     { 
       case "Modifier": 	ModifierRevues($_POST['revueid'],$_POST['nom']); break;
       case "Supprimer": 
       case "Delete":		SupprimerRevues($_POST['revueid']); break;
       case "Add":
       case "Ajouter": 			AjouterRevue($_POST['nom']); break;
       default:  			break;
     }
}

if (isset($_GET['OP'])){
     
     SupprimerRevues($_GET['RevueId']);
}

 listerrevues();
 menurevues();
 ?>
 
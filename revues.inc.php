<?php
//revues.inc.php
require('config.inc.php');
/*************************/


  function AjouterRevue($nomRevue)
  { 
      $retour = false; 

	    if (Isset($nomRevue) && !Empty($nomRevue))
	    {
	        $db=connecterBase();
  
          $table = "revues";
          $insert = "INSERT INTO $table VALUES('', '$nomRevue')";
          $result = @mysqli_query($GLOBALS['connect'] , $insert);

          if ($result)
          {
            $retour = true;
            echo '<div style="width:80%; height:40px; padding-top:18px; background-color:#e6ffe6; text-align:center; position:relative; left:140px; border-radius: 10px " >';
            echo 'Le Revue a été ajouter avec succée ...';
            echo '</div>';
          }
          else
          {
            $error = "erreur mysql_query(\"$insert\")n°".mysqli_connect_error()." : " .mysqli_connect_error();
        	  die($error);	    
          }

          FermerBase($db);
      }

      Return $retour;
  }

  /*------------------------------------------*/

  function SupprimerRevues($RevueId)
  { 
      $retour = false; 

	    if (Isset($RevueId) && !Empty($RevueId))
	    {
	        $db=connecterBase();
  
          $table = "revues";
          $delete = "Delete from $table where RevueId = $RevueId" ;
          $result = @mysqli_query($GLOBALS['connect'] , $delete);

          if($result)
          {
            $retour = true;
            echo '<div style="width:80%; height:40px; padding-top:18px; background-color:#e6ffe6; text-align:center; position:relative; left:140px; border-radius: 10px " >';
            echo "Le Revue a été supprimer avec succée ...." ;
            echo '</div>';
            
          }
          
          else
          {
            $error = "erreur mysql_query(\"$delete\")n°".mysqli_connect_error()." : ".mysqli_connect_error();
        	    
        	   die($error);	    
          }
          FermerBase($db);
      }

      Return $retour;
  }

  /*------------------------------------------*/

  function ModifierRevues($RevueId, $nomRevue)
  { 
      $retour = false; 

	    if ((Isset($RevueId) && !Empty($RevueId)) && (Isset($nomRevue) && !Empty($nomRevue)))
	    {
        	$db=connecterBase();
          $table = "revues";
          $update = "update $table set nom='$nomRevue' where RevueId='$RevueId'";
          $result = mysqli_query($GLOBALS['connect'] , $update);

          if ($result)
          {
            $retour = true;
            echo '<div style="width:80%; height:40px; padding-top:18px; background-color:#e6ffe6; text-align:center; position:relative; left:140px; border-radius: 10px " >';
            echo("Le Revue a été modifier avec succée ....");
            echo '</div>';
          }
          else
          {
            $error = "erreur mysql_query(\"$update\")n°".mysqli_connect_error()." : " .mysqli_connect_error(); 
        	  die($error);	

          }
           FermerBase($db);
       }
       Return $retour;
  }

   /*------------------------------------------*/ 

  function ListerRevues()
  {
      GLOBAL $PHP_SELF;
      $retour = false;
      $db= connecterBase();
      $table="revues";
      $select="SELECT * FROM $table" ;
      $result = @mysqli_query($GLOBALS['connect'] ,$select);

      if($result) 
      {
          $nb=0;
          echo '<div style="width:80%; height:330px; background-color: #d1d1e0; padding-top:55px; padding-bottom:70px; border-radius:30px; position:relative;  top:50px; left:140px">';
          echo'<table Border=0 BGCOLOR=#FFFFFF CELLPADING=1 CELLSPACING=0 ALIGN=CENTER VALIGN=TOP WIDTH=80% >';	
          echo "<tr><td>";
          echo "<table Border=0 BGCOLOR=#FFFFFF CELLPADING=5 CELLSPACING=1  WIDTH=100%>";
          echo "<tr><td style='padding:5px' colspan = 3 bgcolor=#666699><fontcolor=white><B>Liste Des Revues disponible</b></font><br></td><tr>\n";

          while($ligne= @mysqli_fetch_assoc($result))
          {
              $RevueId=$ligne['RevueId'];
              $NomRevue = $ligne['Nom'];

              if($nb%2)
              {
                echo "<tr>"	;
                echo "<td width=10% bgcolor=#E2E8F7 ALIGN=CENTER>$RevueId</td>";
                echo "<td width=40% bgcolor=#E2E8F7>$NomRevue</td>";
                echo "<td width=50% bgcolor=#E2E8F7><a href=\"".basename($PHP_SELF)."?OP=Delete&RevueId=$RevueId\">Supprimer</a></td>";
                echo "</tr>";
              }
              else 
              {
                echo "<tr>";
                echo "<td width=10% bgcolor=#C7D3EF ALIGN=CENTER>$RevueId</td>";
                echo "<td width=40% bgcolor=#C7D3EF>$NomRevue</td>";
                echo "<td width=50% bgcolor=#C7D3EF><a href=\"".basename($PHP_SELF)."?OP=Delete&RevueId=$RevueId\">Supprimer</a></td>";
                echo "</tr>";
              }

              $nb++;	
          }
          echo "</table>";
          echo "</td></tr></table>";
      }
      else
      {
          $error = "erreur mysql_query(\"$select\")n°".mysqli_connect_error()." : ".mysqli_connect_error(); 
        	die($error);	
      }

      FermerBase($db);
      Return $retour;
  }

 /*------------------------------------------*/

  function menurevues() 
  {
    	global $php_self;
      
      
    	echo"<br />";
      echo"<table Border=0 BGCOLOR=#FFFFFF CELLPADING=1 CELLSPACING=0 ALIGN=CENTER VALIGN=TOP WIDTH=80% >";	
      echo "<tr><td>";
      echo "<table Border=0  CELLPADING=5 CELLSPACING=1  WIDTH=100%>";
      echo "<tr><td style='padding:4px' bgcolor=#666699><fontcolor=white><B>Menu</b></font><br></td><tr>\n";

      echo "<form method=post>";
      echo '<tr><td bgcolor=#e2e8f7 style="padding:5px">Id : <input type=text name=revueid></td></tr>';
      echo '<tr><td bgcolor=#c7d3ef style="padding:5px">Nom de la revue : <input type=text name=nom></td></tr>';
      echo '<tr><td bgcolor=#e2e8f7 style="padding:8px"><input style="width:95px" type=submit name=op value=Ajouter>&nbsp;
      <input style="width:80px" type=submit name=op value= Modifier>&nbsp;
      <input style="width:80px" type=submit name=op value= Supprimer>&nbsp;</td></tr>';
      echo "</form>";


      echo "</table>";
      echo "</td></td></table>";
      echo "</div>";
     
  }



  
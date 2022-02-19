<?php
 //mysql.inc.php



	  function connecterbase()
	  { 

			    require('config.inc.php');   

				if (!$connect)  
				{
					$error = "error mysql_connect() : impossible de ce connecter au server";
					die ($error);
				} 

				$db = mysqli_select_db($connect,$database);

				if(!$db)
				{
					$error="error mysql_select_db()n°".mysqli_errno()." : ".mysqli_error();
					die($error);
				}
	
				return $db;
	  }


	  /*---------------------------*/



	  function FermerBase($db)
	  {
		  @mysqli_close($db);
		  
	  }

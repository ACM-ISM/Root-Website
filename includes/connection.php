<?php require("constants.php") ?>
<?php 
	$connection = mysql_connect(DB_HOST,DB_USER,DB_PASS);
	if(!$connection){
		die("Database query failed :" . mysql_error());
	}
 ?>
 <?php 
 	$db_select = mysql_select_db(DB_NAME,$connection);
 	if(!$db_select){
		die("Database query failed :" . mysql_error());
	}
 ?>
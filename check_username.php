<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/form_functions.php"); ?>
<?php
	if(isset($_POST["username"]))
	{
		//check if its ajax request, exit script if its not
		if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
			die();
		}
		$username =  mysql_prep($_POST["username"]);
		$query = "SELECT id FROM users WHERE username='{$username}'";
		$results = mysql_query($query,$connection);
		$username_exist = mysql_num_rows($results);
		if($username_exist>0) {
			die('<img src="img/not-available.png" /><p>Username not available.</p>');
		}else{
			die('<img src="img/available.png" /><p>Username available.</p>');
		}
		
	}
	if(isset($_POST["email"]))
	{
		//check if its ajax request, exit script if its not
		if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
			die();
		}
		$email =  mysql_prep($_POST["email"]);
		$query = "SELECT id FROM users WHERE email='{$email}'";
		$results = mysql_query($query,$connection);
		$username_exist = mysql_num_rows($results);
		if($username_exist>0) {
			die('<img src="img/not-available.png" /><p>Email already in use.</p>');
		}
	}
	if(isset($_POST["member"]))
	{
		//check if its ajax request, exit script if its not
		if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
			die();
		}
		if(is_null(find_member($_POST['member']))) {
			die('<img src="img/not-available.png" /><p>Invalid member number.</p>');
		}
		$member =  mysql_prep($_POST["member"]);
		$query = "SELECT id FROM users WHERE member='{$member}'";
		$results = mysql_query($query,$connection);
		$username_exist = mysql_num_rows($results);
		if($username_exist>0) {
			die('<img src="img/not-available.png" /><p>Member number is used.</p>');
		}
	}
?>
<?php mysql_close(); ?>


<?php require_once("includes/functions.php"); ?>
<?php
	session_start();
	$_SESSION = array();
	if(isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-50000, '/');
	}
	session_destroy();
	redirect_to("staff_login.php?logout=1");
?>
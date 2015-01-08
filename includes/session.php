<?php require_once("includes/functions.php"); ?>
<?php
	session_start(); 
	function confirm_staff_login(){
		if(!isset($_SESSION['staff_id'])) {
			redirect_to("staff_login.php");
		}
	}
	function restricted_area_authentication() {
		if(!isset($_SESSION['staff_id'])) {
			redirect_to("index.php");
		}
	}
	function confirm_login(){
		if(isset($_SESSION['staff_id']) || isset($_SESSION['user_id'])) {
		} else {
			redirect_to("index.php");
		}
	}

	function check_login(){
		if(isset($_SESSION['staff_id']) || isset($_SESSION['user_id'])) {
			return 1;
		} else {
			return NULL;
		}
	}
?>
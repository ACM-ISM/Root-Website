<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/form_functions.php"); ?>
<?php require_once("includes/header.php"); ?>
<?php confirm_staff_login(); ?>
<?php
	if(isset($_POST['submit'])) {
		$username = mysql_prep($_POST["username"]);
		$password = mysql_prep($_POST["password"]);
		$hashed_password = sha1($password);
		$query = "INSERT INTO staff (
				username, hashed_password
				) values (
				'{$username}', '{$hashed_password}'
				)";
		if(mysql_query($query, $connection)) {
			redirect_to("staff_login.php");
		} else {
			echo "<p>Could not create user</p>";
		}
	}
?>
<div class="content clearfix">
   	<div class="chapter display clearfix">
		<form class="bootstrap-frm" method="POST" action="new_staff.php">
			<h1>Staff Sign Up Form</h1>
			<label>
				<span>Username:</span>
			    <input type="text" name="username" placeholder="Username">
			</label>
			<label>
				<span>Password:</span>
			    <input type="password" name="password" placeholder="Password">
			</label>
			<label>   
			    <input type="submit" name="submit" value="Make Staff" class="button">
			</label>
		</form>
	</div>
</div>
<?php include("includes/footer.php"); ?>
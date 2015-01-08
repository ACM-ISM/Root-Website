<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/form_functions.php"); ?>
<?php
	if(isset($_POST['submit'])) {
		$password = mysql_prep($_POST['password']);
		$verification_link = urlencode(random_string());
		$hashed_password = sha1($password);
		$query = "UPDATE users SET
				hashed_password = '{$hashed_password}',
				verification_link = '{$verification_link}',
				verified = 1
				WHERE verification_link = '{$_GET['link']}'";
		mysql_query($query, $connection);
		if(mysql_affected_rows() == 1) {
			redirect_to("login.php?log=301");
		} else {
			echo "Could not update password.";
		}
	} elseif(isset($_GET['link'])) {
		$verification_link = $_GET['link'];
		$query = "SELECT username
				FROM users
				WHERE verification_link = '{$verification_link}'
				LIMIT 1";
		$user_set = mysql_query($query, $connection);
		confirm_query($user_set);
		if(mysql_num_rows($user_set) == 0) {
			redirect_to("login.php");
		} else {
			$user = mysql_fetch_array($user_set);
		}
	} else {
		redirect_to("login.php");
	}
?>
<?php require_once("includes/header.php") ?>
<div class="content clearfix">
	<div class="chapter display alpha clearfix">
		<form class="bootstrap-frm" action="verification.php?link=<?php echo $verification_link; ?>" onsubmit="return validate_login(this)" method="POST">
			<h1>Set Your Password, <?php echo $user['username']; ?></h1>
			<label>
				<span>Password:</span>
			    <input type="password" name="password" id="password" placeholder="Password">
			</label>
			<label>   
			    <input type="submit" name="submit" value="Set Password" class="button">
			</label>
		</form>
	</div>
<?php include("includes/footer.php") ?>
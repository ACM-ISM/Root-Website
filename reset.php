<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/form_functions.php"); ?>
<?php
	if(isset($_POST['submit'])) {
		$email = mysql_prep($_POST['email']);
		$verification_link = random_string();
		$verification_link_send = urlencode($verification_link);
		$idiot_link = urlencode(random_string());
		$query = "UPDATE users SET
				verification_link = '{$verification_link}'
				WHERE email = '{$email}'
				LIMIT 1";
		mysql_query($query, $connection);
		if(mysql_affected_rows() == 1) {
			$query = "SELECT username
					FROM users
					WHERE email = '{$email}'
					LIMIT 1";
			$user_set = mysql_query($query, $connection);
			$user = mysql_fetch_array($user_set);
			$to      = $email;
			$subject = "Reset Your Password";
			$message = "Hi, {$user['username']}" . "\n" . "\n" .
						"Click the link below to set your password." . "\n" .
						"http://www.acmism.org/verification.php?id={$idiot_link}&link={$verification_link_send}". "\n" .
						"Thank you for joining us,". "\n" .
						"Team ACM.";
			$headers = 'From: ACM ISM Student Chapter <local_activities@acmism.org>' . "\r\n" .
			    		'Reply-To: ACM ISM Student Chapter <local_activities@acmism.org>';
			mail($to, $subject, $message, $headers);
			redirect_to("login.php?log=201");
		} else {
			redirect_to("reset.php?log=401");
		}
	}
?>
<?php require_once("includes/header.php") ?>
<div class="content clearfix">
	<div class="chapter display alpha clearfix">
		<?php if(isset($_GET['log']) && $_GET['log']=401) {
			echo "<p>We cannot find your email. please <a href=\"login.php\">sign up</a></p>";} ?>
		<form class="bootstrap-frm" action="reset.php" onsubmit="return validate_login(this)" method="POST">
			<h1>Enter Your Email</h1>
			<label>
				<span>Email:</span>
			    <input type="text" name="email" id="email" placeholder="email">
			</label>
			<label>   
			    <input type="submit" name="submit" value="Set Password" class="button">
			</label>
		</form>
	</div>
<?php include("includes/footer.php") ?>
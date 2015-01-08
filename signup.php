<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/form_functions.php"); ?>
<?php
	echo mysql_error();
	if(isset($_POST['submit'])) {
		$errors = array();
		$required_fields = array('name', 'username', 'email', 'spoj', 'codechef', 'hackerrank', 'admission', 'member', 'batch', 'phone_number', 'branch');
		foreach ($required_fields as $fieldname) {
			if(!isset($_POST[$fieldname]) || (empty($_POST[$fieldname]) && $_POST[$fieldname] != 0))
			{
				$errors[] = $fieldname;
			}
		}
		$fields_with_length = array('name' => 20, 'username' => 14, 'spoj' => 14, 'codechef' => 14, 'hackerrank' => 16, 'phone_number' => 10);
		foreach ($fields_with_length as $fieldname => $maxlength) {
			if(strlen(mysql_prep($_POST[$fieldname])) > $maxlength) {
				$errors[] = $fieldname;
			}
		}
		$field_patterns = array('name' => '/^[a-zA-Z ]{3,20}$/', 'username' => '/^[a-z]{1}[a-z0-9_]{3,13}$/',
								'spoj' => '/^[a-z]{1}[a-z0-9_]{2,13}$/', 'codechef' => '/^[a-z]{1}[a-z0-9_]{3,13}$/',
								'hackerrank' => '/^[a-zA-Z0-9_]{5,16}$/', 
								'phone_number' => '/^[7-9]{1}[0-9]{9}/', 'email' => '/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/', 
								'admission' => '/^[2]{1}[0-1]{2}[0-9]{1}[a-zA-Z]{2}[0-9]{4}$/');
		foreach ($field_patterns as $fieldname => $pattern) {
			if(preg_match($pattern, $_POST[$fieldname]) == 0) {
				$errors[] = $fieldname;
			}
		}
		if(!is_null(find_user_exist($_POST['username']))) {
			$errors[] = 'username';
		}
		if(!is_null(find_email($_POST['email']))) {
			$errors[] = 'email';
		}
		if(is_null(find_member($_POST['member']))) {
			$errors[] = 'member';
		}
		if(!is_null(find_member_exist($_POST['member']))) {
			$errors[] = 'member';
		}
		if(!empty($errors)) {
			//print_r($errors) ;
			redirect_to("login.php");
		} else {
			$username = mysql_prep($_POST["username"]);
			$verification_link = random_string();
			$verification_link_send = urlencode($verification_link);
			$idiot_link = urlencode(random_string());
			$email = mysql_prep($_POST['email']);
			$name = mysql_prep($_POST['name']);
			$to      = $email;
			$subject = "Set Your Password";
			$message = "Hi {$username}," . "\n" . "\n" .
						"Click the link below to set your password." . "\n" .
						"http://www.acmism.org/verification.php?id={$idiot_link}&link={$verification_link_send}". "\n" .
						"Thank you for joining us,". "\n" .
						"Team ACM.";
			$headers = 'From: ACM ISM Student Chapter <local_activities@acmism.org>' . "\r\n" .
			    		'Reply-To: ACM ISM Student Chapter <local_activities@acmism.org>';

			mail($to, $subject, $message, $headers);
			$password = random_string();
			$spoj = mysql_prep($_POST['spoj']);
			$codechef = mysql_prep($_POST['codechef']);
			$hackerrank = mysql_prep($_POST['hackerrank']);
			$admission = mysql_prep($_POST['admission']);
			$member = mysql_prep($_POST['member']);
			$batch = mysql_prep($_POST['batch']);
			$branch = mysql_prep($_POST['branch']);
			$phone_number = mysql_prep($_POST['phone_number']);
			$hashed_password = sha1($password);
			$query = "INSERT INTO users (
					name, username, hashed_password, email, spoj_id, codechef_id, hackerrank_id, admission, member,  batch, branch, phone_number, verification_link
					) values (
					'{$name}', '{$username}', '{$hashed_password}', '{$email}', '{$spoj}', '{$codechef}', '{$hackerrank}', '{$admission}', '{$member}', '{$batch}', '{$branch}', '{$phone_number}', '{$verification_link}'
					)";
			if(mysql_query($query, $connection)) {
				redirect_to("login.php?log=201");
			} else {
				echo "<p>Could not create user</p>";
				//echo mysql_error();
			}
		}
	} else {
		redirect_to("login.php");
	}
?>
<?php mysql_close($connection); ?>
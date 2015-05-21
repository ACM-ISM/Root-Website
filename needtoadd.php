//Never run this script unless you want to add some users via csv file.
<?php require_once("includes/connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php require_once("includes/form_functions.php") ?>
<?php
	function add_member() {
		global $connection;
		if (($handle = fopen("data/Needtoadd.csv", "r")) !== FALSE) {
		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		    	$username = mysql_prep($data[5], 1, -1);
				$verification_link = random_string();
				$verification_link_send = urlencode($verification_link);
				$idiot_link = urlencode(random_string());
				$email = mysql_prep($data[8], 1, -1);
				$name = mysql_prep($data[0], 1, -1);
				$to      = $email;
				$subject = "Set Your Password";
				$message = "Hi {$username}," . "\n" . "\n" .
							"Click the link below to set your password." . "\n" .
							"http://www.acmism.org/verification.php?id={$idiot_link}&link={$verification_link_send}". "\n" .
							"Thank you for joining us,". "\n" .
							"Team ACM.";
				$headers = 'From: ACM ISM Student Chapter <local_activities@acmism.org>' . "\r\n" .
				    		'Reply-To: ACM ISM Student Chapter <local_activities@acmism.org>';

				
				$password = random_string();
				$spoj = mysql_prep($data[5], 1, -1);
				$codechef = mysql_prep($data[6], 1, -1);
				$hackerrank = mysql_prep($data[7], 1, -1);
				$admission = mysql_prep($data[2], 1, -1);
				$member = mysql_prep($data[1], 1, -1);
				$batch = mysql_prep($data[3], 1, -1);
				$branch = mysql_prep($data[4], 1, -1);
				$phone_number = mysql_prep($data[9], 1, -1);
				$hashed_password = sha1($password);
				$query = "INSERT INTO users (
						name, username, hashed_password, email, spoj_id, codechef_id, hackerrank_id, admission, member,  batch, branch, phone_number, verification_link
						) values (
						'{$name}', '{$username}', '{$hashed_password}', '{$email}', '{$spoj}', '{$codechef}', '{$hackerrank}', '{$admission}', '{$member}', '{$batch}', '{$branch}', '{$phone_number}', '{$verification_link}'
						)";
				if(mysql_query($query, $connection)) {
					mail($to, $subject, $message, $headers);
					echo "Done " . mysql_prep($data[0], 1, -1);
				} else {
					echo "Left " . mysql_prep($data[0], 1, -1);
					echo mysql_error();
				}
			}
			fclose($handle);
		}
	}
?>
<?php add_member(); ?>
<?php mysql_close(); ?>

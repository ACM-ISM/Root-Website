<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/form_functions.php"); ?>
<?php require_once("includes/header.php"); ?>
<div class="content clearfix">
   	<div class="chapter display clearfix">
		<?php
			if(isset($_GET['logout']) && $_GET['logout']==1) {
				echo "<p>You have been succesfully logged out.</p>";
			}
			if(isset($_SESSION['user_id'])){
				redirect_to("index.php");
			}
			if(isset($_SESSION['staff_id'])){
				redirect_to("staff_area.php");
			}
			if(isset($_POST['submit'])){
				$username = mysql_prep($_POST["username"]);
				$password = mysql_prep($_POST["password"]);
				$hashed_password = sha1($password);
				$query = "SELECT id,username ";
				$query .= "FROM staff ";
				$query .= "WHERE username = '{$username}' ";
				$query .= "AND hashed_password = '{$hashed_password}' ";
				$query .= "LIMIT 1";
				$result_set = mysql_query($query,$connection);
				confirm_query($result_set);
				if($found_user = mysql_fetch_array($result_set)) {
					$_SESSION['staff_id'] = $found_user['id'];
					$_SESSION['username'] = $found_user['username'];
					redirect_to("staff_area.php");
				} else {
					echo "<p>Login failed!!</P>";
					//echo mysql_error();
				}
			}
		?>
		<form class="bootstrap-frm" action="staff_login.php" onsubmit="return validate_login(this)" method="POST">
			<h1>Staff Login Form</h1>
			<label>
				<span>Username:</span>
			    <input type="text" name="username" id="username" placeholder="Username">
			</label>
			<label>
				<span>Password:</span>
			    <input type="password" name="password" id="password" placeholder="Password">
			</label>
			<label>   
			    <input type="submit" name="submit" value="Log in" class="button">
			</label>
		</form>
	</div>
</div>
<?php include("includes/footer.php"); ?>
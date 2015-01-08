<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php require_once("includes/form_functions.php") ?>
<?php require_once("includes/header.php") ?>
<div class="content clearfix">
	<div class="chapter grid_6 alpha clearfix">
		<?php
			if(isset($_GET['log']) && $_GET['log'] ==101 ) {
				$output = "<p>You have been succesfully logged out.</p>";
			}
			if(isset($_GET['log']) && $_GET['log'] ==201 ) {
				$output = "<p>A mail has been sent to you to set your password. Check your mail & spam folders.</p>
							<p>If you did not recieve any mail please <a href=\"reset.php\">Reset</a></p>";
			}
			if(isset($_GET['log']) && $_GET['log'] ==301 ) {
				$output = "<p>Your password has been updated.</p>";
			}
			if(isset($_GET['log']) && $_GET['log'] ==501 ) {
				$output = "<p>Invalid username/password combination!!</p>";
			}
			if(!is_null(check_login())) {
				redirect_to("index.php");
			}
			if(isset($_POST['submit'])){
				$username = mysql_prep($_POST["user_name"]);
				$password = mysql_prep($_POST['password']);
				$hashed_password = sha1($password);
				$query = "SELECT id,username ";
				$query .= "FROM users ";
				$query .= "WHERE username = '{$username}' ";
				$query .= "AND hashed_password = '{$hashed_password}' ";
				$query .= "LIMIT 1";
				$result_set = mysql_query($query,$connection);
				confirm_query($result_set);
				if($found_user = mysql_fetch_array($result_set)) {
					$_SESSION['user_id'] = $found_user['id'];
					$_SESSION['username'] = $found_user['username'];
					redirect_to("index.php");
				} else {
					redirect_to("login.php?log=501");
				}
			}
		?>
		<form class="bootstrap-frm" action="signup.php" onsubmit="return validate_signup(this)" method="POST">
			<h1>Member Signup</h1>
			<label>
				<span>Name:</span>
			    <input type="text" name="name" id="name" placeholder="Enter your name">
			</label>
			<label>
				<span>Username:</span>
			    <input type="text" name="username" id="username" placeholder="Username">
			    <div id="user-result"></div>
			</label>
			<label>
				<span>Email:</span>
			    <input type="text" name="email" id="email" placeholder="Email">
			    <div id="email-result"></div>
			</label>
			<label>
				<span>Spoj ID:</span>
			    <input type="text" name="spoj" id="spoj" placeholder="Spoj ID">
			</label>
			<label>
				<span>Codechef ID:</span>
			    <input type="text" name="codechef" id="codechef" placeholder="Codechef ID">
			</label>
			<label>
				<span>HackerRank ID:</span>
			    <input type="text" name="hackerrank" id="hackerrank" placeholder="HackerRank ID">
			</label>
			<label>
				<span class="extra">Admission Number:</span>
			    <input type="text" name="admission" id="admission" placeholder="Admission Number">
			</label>
			<label>
				<span class="extra">ACM Member Number:</span>
			    <input type="text" name="member" id="member" placeholder="ACM Member Number">
			    <div id="member-result"></div>
			</label>
			<label>
				<span>Batch:</span>
				<select name="batch" id="batch">
				    <option value="Ist Year Undergraduate">Ist Year Undergraduate</option>
			    	<option value="IInd Year Undergraduate">IInd Year Undergraduate</option>
			    	<option value="IIIrd Year Undergraduate">IIIrd Year Undergraduate</option>
			    	<option value="IVth Year Undergraduate">IVth Year Undergraduate</option>
			    	<option value="Vth Year Dual Degree/Integrated">Vth Year Dual Degree/Integrated</option>
			    	<option value="Ist Year Postgraduate">Ist Year Postgraduate</option>
			    	<option value="IInd Year Postgraduate">IInd Year Postgraduate</option>
			    	<option value="Research Fellow">Research Fellow</option>
		    	</select>
			</label>
			<label>
				<span class="extra">Branch:</span>
			    <input type="text" name="branch" id="branch" placeholder="Branch">
			</label>
			<label>  
			<label>
				<span class="extra">Phone Number:</span>
			    <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number">
			</label>
			<label>   
			    <input type="submit" name="submit" value="Sign up" class="button">
			</label>
		</form>
	</div>
   	<div class="chapter grid_6 omega clearfix">
		<?php if(isset($_GET['log'])){echo "<p>{$output}</p>";} ?>
		<form class="bootstrap-frm" action="login.php" onsubmit="return validate_login(this)" method="POST">
			<h1>Member Login</h1>
			<label>
				<span>Username:</span>
			    <input type="text" name="user_name" id="user_name" placeholder="Username">
			</label>
			<label>
				<span>Password:</span>
			    <input type="password" name="password" id="password" placeholder="Password">
			</label>
			<label>   
			    <input type="submit" name="submit" value="Log in" class="button">
			</label>
		</form>
		<p><a href="reset.php">Need Help!</a></p>
		
	</div>
</div>

<?php include("includes/footer.php") ?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#username").keyup(function (e) {
			//removes spaces from username
			$(this).val($(this).val().replace(/\s/g, ''));
			var username = $(this).val();
			var usernameRegex = /^[a-z]{1}[a-z0-9_]{3,13}$/;
			if(username.length < 4){$("#user-result").html('');return;}
			if(!username.match(usernameRegex)) {
				$("#user-result").html('');
				return ;
			}
			if(username.length >= 4){
				$("#user-result").html('<img src="img/ajax-loader.gif" /> <p>Checking availability.</p>');
				$.post('check_username.php', {'username':username}, function(data) {
				  $("#user-result").html(data);
				});
			}
		});	
	});
	$(document).ready(function() {
		$("#email").keyup(function (e) {
			//removes spaces from username
			$(this).val($(this).val().replace(/\s/g, ''));
			var email = $(this).val();
			var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
			if(email.match(emailRegex)){
				$("#email-result").html('<img src="img/ajax-loader.gif" /> <p>Checking..</p>');
				$.post('check_username.php', {'email':email}, function(data) {
				  $("#email-result").html(data);
				});
			}
		});	
	});
	$(document).ready(function() {
		$("#member").keyup(function (e) {
			//removes spaces from username
			$(this).val($(this).val().replace(/\s/g, ''));
			var member = $(this).val();
			var emailRegex = /^[0-9]{4,8}$/;
			if(member.match(emailRegex)){
				$("#member-result").html('<img src="img/ajax-loader.gif" /> <p>Checking..</p>');
				$.post('check_username.php', {'member':member}, function(data) {
				  $("#member-result").html(data);
				});
			}
		});	
	});
</script>
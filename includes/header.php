<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ACM ISM | Home</title>
		<link rel="shortcut icon" type="image/x-icon" href="http://www.acmism.org/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
		<link type="text/css" href="css/menu.css" rel="stylesheet" />
		<script type="text/javascript" src="js/form.js"></script>
		<script src="js/jquery-1.9.0.min.js"></script>
		<!--<script src="jquery.snow.js"></script>
		<script>
			$(document).ready( function(){
			        $.fn.snow();
			});
		</script>
		Just in case any body wanted snowfall-->
</head>

<body>
	<div class="container_box clearfix"><!--this div ends in footer-->
	<div class="header">
		<div class="acmlogo">
				<img src="img/acm.jpg" alt="ACM Logo" />
		</div>
		<?php 
			if(!is_null(check_login())) {
				echo "<div class =\"profile\">
					<a href=\"#\">
					<span>Hi, {$_SESSION['username']}</span>
					</a><span>|</span>
					<a href=\"logout.php\">
					<span>Logout</span>
					</a></div>";
			} else {
				echo "<div class =\"profile\">
					<a href=\"login.php\">
					<span>Sign up</span>
					</a><span>|</span>
					<a href=\"login.php\">
					<span>Login</span>
					</a></div>";
			}
		?>
		<?php include("includes/navigation.php") ?>
	</div>
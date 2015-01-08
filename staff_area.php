<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_staff_login(); ?>
<?php require_once("includes/header.php"); ?>
<div class="content clearfix">
   	<div class="chapter display clearfix">
		<p><a href="new_event.php">+ Create Event</a></p>
		<p><a href="new_problem.php">+ Add Problems</a></p>
		<p><a href="new_staff.php">+ Create Staff</a></p>
		<p><a href="staff_logout.php">- Logout</a></p>
	</div>
</div>
<?php include("includes/footer.php"); ?>
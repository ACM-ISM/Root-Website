<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php require_once("includes/header.php") ?>
	<div class="content clearfix">
       	<div class="chapter display clearfix">
       		<h2>ACM Chapter Members</h2>
       		<?php print_all_chap_member(); ?>
       	</div>
    </div>
<?php include("includes/footer.php") ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php require_once("includes/header.php") ?>
<div class="content clearfix">
    	<?php
    	if(!is_null(check_login())) {
    		$output = "<div class=\"chapter stop_padding display\">";
			$output .= "<p>Please select an event to join the discussion.</p>";
			$output .= "</div>";
			echo $output;
    		$query = "SELECT *
				FROM events
				ORDER BY id DESC";
			$event_set = mysql_query($query, $connection);
			confirm_query($event_set);
			while($event = mysql_fetch_array($event_set)) {
				$output = "<div class=\"chapter stop_padding display\">";
				$output .= "<a href=\"event.php?eve=" . urlencode($event['id']) . 
							"\">";
				$output .= "<p>{$event['name']} | {$event['occured_in']}</p>";
				$output .= "</a></div>";
				echo $output;
			}
    	} else {
    		redirect_to("login.php");
    	}
    	?>
</div>

<?php include("includes/footer.php") ?> 
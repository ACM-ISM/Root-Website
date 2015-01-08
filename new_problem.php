<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/form_functions.php"); ?>
<?php confirm_staff_login(); ?>
<?php
	if(isset($_POST['submit'])) {
		$name = mysql_para_prep($_POST["name"]);
		$event = $_POST["event"];
		$code = $_POST["code"];
		$content = mysql_para_prep($_POST["content"]);
		$year = date("Y");
		$query = "INSERT INTO questions (
				name, year_id, event_id, content, code
				) values (
				'{$name}', {$year}, {$event}, '{$content}', '{$code}'
				)";
		if(mysql_query($query, $connection)) {
			redirect_to("staff_area.php");
		} else {
			//echo mysql_error();
			echo "<p>Could not edit event</p>";
		}
	}
?>
<?php require_once("includes/header.php"); ?>
<div class="content clearfix">
   	<div class="chapter display clearfix">
   		<?php echo mysql_error(); ?>
		<form action="new_problem.php" method="POST" class="bootstrap-frm" enctype="multipart/form-data">
		    <h1>Question Form 
		        <span>Please fill all the texts in the fields.</span>
		    </h1>
		    <label>
		        <span>Question Name :</span>
		        <input id="name" type="text" name="name" placeholder="Event Name" />
		    </label>
		    <label>
		        <span>Code Name :</span>
		        <input id="code" type="text" name="code" placeholder="Code Name" />
		    </label>
		    <label>
		    	<span>Event :</span>
		    	<select name="event" id="event">
		    	<?php
		    		$event_set = get_all_events(date("Y"));
		    		while($event = mysql_fetch_array($event_set)) {
		    			echo "<option value=\"{$event['id']}\">{$event['name']}</option>";
		    		}
		    	?>
		    	</select>
		    </label>
		    <label>
		        <span>Content :</span>
		        <textarea id="content" name="content" placeholder="<?php 
		        	echo "<p>Your description here</p>";
		        	echo "<p>Rules & Regulation</p>";
		        	echo "<ul>";
		        	echo "<li>your rules here</li>";
		        	echo "</ul>";
		        	echo "<p>Prizes</p>";
		        	echo "<ul>";
		        	echo "<li>your prize details here</li>";
		        	echo "</ul>";
		        ?>"></textarea>
		    </label>   
		    <label>
		        <span>&nbsp;</span> 
		        <input type="submit" name="submit" class="button" value="Post the question" /> 
		    </label>    
		</form>
	</div>
</div>
<?php include("includes/footer.php"); ?>
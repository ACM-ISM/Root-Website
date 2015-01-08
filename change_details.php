<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/form_functions.php"); ?>
<?php confirm_staff_login(); ?>
<?php
	if(isset($_POST['submit'])) 
	{
		$id = $_SESSION['event_id'];
		$name = mysql_para_prep($_POST['name']);
		$year = mysql_para_prep($_POST['year']);
		$content = mysql_para_prep($_POST['content']);
		$details = mysql_para_prep($_POST['details']);
		$winners = mysql_para_prep($_POST['winners']);
		$pic_link = mysql_para_prep($_POST['pic_link']);
		$editorials = mysql_para_prep($_POST['editorials']);
		$finish = $_POST['finish'];
		$online = $_POST['online'];
		$query = "UPDATE events SET
					name = '{$name}', 
					occured_in = '{$year}',
					content = '{$content}', 
					details = '{$details}', 
					winners = '{$winners}', 
					editorials = '{$editorials}', 
					finish = {$finish}, 
					online = {$online}
					WHERE id = {$id}";
		mysql_query($query, $connection);
		if(mysql_affected_rows() == 1) {
			redirect_to("staff_area.php");
		} else {
			echo "<p>Event Edit failed!!</p>";
			//echo mysql_error();
		}
	}
?>
<?php get_selected_event(); ?>
<?php $_SESSION['event_id'] = $sel_event['id']; ?>
<?php require_once("includes/header.php"); ?>
<div class="content clearfix">
   	<div class="chapter display clearfix">
		<form action="change_details.php" method="POST" class="bootstrap-frm" enctype="multipart/form-data">
		    <h1>Event Form 
		        <span>Please fill all the texts in the fields.</span>
		    </h1>
		    <label>
		        <span>Event Name :</span>
		        <input id="name" type="text" name="name" placeholder="Event Name" value="<?php echo htmlspecialchars_decode($sel_event['name']); ?>" />
		    </label>
		    <label>
		        <span>Year :</span>
		        <input id="year" type="text" name="year" placeholder="Current Year" value="<?php echo $sel_event['occured_in']; ?>" />
		    </label>
		    <label>
		        <span>Image :</span>
		        <input id="year" type="text" name="pic_link" placeholder="" value="<?php echo $sel_event['pic_link']; ?>" />
		    </label>
		    <label>
		        <span>Content :</span>
		        <textarea id="content" name="content"><?php echo htmlspecialchars_decode($sel_event['content']); ?></textarea>
		    </label> 
		    <label>
		        <span>Details :</span>
		        <textarea id="details" name="details" ><?php echo htmlspecialchars_decode($sel_event['details']); ?></textarea>
		    </label> 
		    <label>
		        <span>Winners :</span>
		        <textarea id="winners" name="winners"><?php echo htmlspecialchars_decode($sel_event['winners']); ?></textarea>
		    </label> 
		    <label>
		        <span>Editorials :</span>
		        <textarea id="editorials" name="editorials" ><?php echo htmlspecialchars_decode($sel_event['editorials']); ?></textarea>
		    </label> 
		     <label>
		        <span>Finished :</span>
		        <input type="radio" name="finish" value="0" <?php if($sel_event['finish'] == 0){ echo " checked"; } ?>>No
		        <input type="radio" name="finish" value="1" <?php if($sel_event['finish'] == 1){ echo " checked"; } ?>>Yes
		    </label>
		    <label>
		        <span>Online :</span>
		        <input type="radio" name="online" value="0" <?php if($sel_event['online'] == 0){ echo " checked"; } ?>>No
		        <input type="radio" name="online" value="1" <?php if($sel_event['finish'] == 1){ echo " checked"; } ?>>Yes
		    </label>   
		     <label>
		        <span>&nbsp;</span> 
		        <input type="submit" name="submit" class="button" value="Edit Event" /> 
		    </label>    
		</form>
	</div>
</div>
<?php include("includes/footer.php"); ?>
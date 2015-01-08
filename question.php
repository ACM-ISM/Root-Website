<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php require_once("includes/form_functions.php") ?>
<?php require_once("includes/header.php") ?>
<?php 
	if(is_null(check_login())){
		redirect_to("index.php");
	}
	$sel_event = get_event_by_id($_SESSION['event']);
	if(!isset($sel_event)) {
		redirect_to("index.php");
	}
?>
<?php 
	if (isset($_POST['submit'])) {
		if (isset($_POST['content']) && !empty($_POST['content'])) {
    		$content = mysql_comment_prep($_POST["content"]);
	  		$query = "INSERT INTO comments (
	  				user_id, question_id, content, date_id
	  				) values (
	  				{$_SESSION['user_id']}, {$_SESSION['question']}, '{$content}', now()
	  				)";
			if(mysql_query($query, $connection)) {
				redirect_to("question.php?qes={$_SESSION['question']}");
			} else {
				//echo mysql_error();
				echo "<p>Could not post!!</p>";
			}
		}
  	}
  	
	
?>
<div class="content clearfix">
	<div class="chapter grid_8 alpha">
		<?php
			if(!intval($_GET['qes'])) {
				redirect_to("event.php");
			}
			if(isset($_GET['qes'])) {
				$question_id = $_GET['qes'];
				$_SESSION['question'] = $question_id;
			} elseif(isset($_SESSION['question'])) {
				$question_id = $_SESSION['question'];
			} else {
				redirect_to("event.php");
			}
			if(!is_null(get_question_by_id($question_id))) {
				$question = get_question_by_id($question_id);
				echo "<h2>";
				echo htmlspecialchars_decode($question['name']);
				echo "</h2>";
				echo htmlspecialchars_decode($question['content']);
			} else {
				redirect_to("event.php");
			}
		?>
	</div>
	<div class="event grid_4 omega">
        <?php get_upcoming_event(); ?>
    </div>
	<div class="chapter grid_8 alpha">
		<?php
			$comments_set = get_comments_by_question_id($question_id);
			if(mysql_num_rows($comments_set) == 0) {
				echo "<p>No one commented.</p>";
			}
			while($comment = mysql_fetch_array($comments_set)) {
				$output = "<div class=\"comment\">";
				$user = get_user_by_id($comment['user_id']);
				$output .= "<h2>{$user['username']}<span> @ {$comment['date_id']}<span></h2>";
				$output .= "<p>{$comment['content']}</p>";
				$output .= "</div>";
				echo $output;
			}
		?>
	</div>
	<div class="event grid_4 omega">
        <p>Please don't get carried away or I will have to personally meet you.</p>
    </div>
	<div class="chapter grid_8 alpha">
		<form action="question.php?qes=<?php echo urlencode($_GET['qes']); ?>" method="POST" class="bootstrap-frm">
			<h1>Comment Below</h1>
			<label>
		        <textarea id="content" name="content" placeholder="Write your comment. Please don't insert code."></textarea>
		    </label> 
		    <label>
		        <input type="submit" name="submit" class="button" value="Submit" /> 
		    </label>
		</form>
	</div>
	
</div>
<?php include("includes/footer.php") ?>
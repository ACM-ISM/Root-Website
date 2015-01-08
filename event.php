<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php require_once("includes/header.php") ?>
<?php
  if(isset($_GET['eve'])) {
    if(!intval($_GET['eve'])) {
      redirect_to("index.php");
    }
  } 
?>
<?php get_selected_event(); ?>
	<div class="content clearfix">
       	<div class="chapter grid_8 alpha">
    			<?php 
    				if(isset($sel_event)) {
              $_SESSION['event'] = $sel_event['id'];
              $event_name = htmlspecialchars_decode($sel_event['name']);
    					$output = "<img src=\"{$sel_event['pic_link']}\">";
    					$output .= "<h2>{$event_name}</h2>";
    					$output .= htmlspecialchars_decode($sel_event['content']);
    					//**Please enter the content into database as html.
    					echo $output;
    				} elseif(isset($_SESSION['event'])) {
              $sel_event = get_event_by_id($_SESSION['event']);
              $output = "<img src=\"{$sel_event['pic_link']}\">";
              $output .= "<h2>{$sel_event['name']}</h2>";
              $output .= htmlspecialchars_decode($sel_event['content']);
              echo $output;
    				} else {
              redirect_to("index.php");
            }
    			?>
        </div>
       	
       	
        <div class="event grid_4 omega">
        	<?php 
					echo htmlspecialchars_decode($sel_event['details']);
					//**Please enter the content into database as html.
        	?>
        </div>
        <?php
          if($sel_event['finish'] == 1) {
            echo "<div class=\"event grid_4 omega\">";
  					if($sel_event['winners']){
  						echo htmlspecialchars_decode($sel_event['winners']);
  					} else {
  						echo "<p>No Winners Yet!!</p>";
  					}
  					//**Please enter the content into database as html.
            echo "</div>";
          }
        ?>
        <?php
            if(!is_null(check_login())) {
              if($sel_event['online'] == 1) {
                $output = "<div class=\"chapter grid_8 alpha\">";
                $output .= "<h2>Problems</h2>";
                $output .= "<table class=\"prob_table\"><thead><tr>";
                $output .= "<th>Name</th><th>Code</th><th class=\"align_center\">Total Comments</th></tr></thead><tbody>";
                $question_set = get_question_by_event_year($sel_event['id'], $sel_event['occured_in']);
                while($question = mysql_fetch_array($question_set)) {
                  $total_commnets = mysql_num_rows(get_comments_by_question_id($question['id']));
                  $output .= "<tr><td><a href=\"question.php?qes=" . 
                        urlencode($question['id']) . 
                        "\">{$question['name']}</td><td>{$question['code']}</td><td class=\"align_center\">";
                  $output .= "{$total_commnets}</td></tr></a>";
                }
                $output .= "</tbody></table></div>";
                echo $output;
              }
            }
          ?>
    	<?php
        if(!is_null(check_login())) {
          if($sel_event['finish'] == 1) {
             echo "<div class=\"event grid_4 omega\">";
             if($sel_event['editorials']){
                echo htmlspecialchars_decode($sel_event['editorials']);
             } else {
                echo "<p>No Tutorials Available!!<p>";
             }
        echo "</div>";
          }
        } 
        //**Please enter the content into database as html.
      ?>
    </div>
<?php include("includes/footer.php") ?> 
<?php 
	
	function confirm_query($result_set){
		if(!$result_set){
			//redirect_to("index.php");
			//die();
			die("Database query failed :" . mysql_error());
		}
	}

	function get_all_years(){
		global $connection;
		$query = "SELECT * 
				FROM year  
				ORDER BY id DESC";
		$year_set = mysql_query($query,$connection);
		confirm_query($year_set);
		return $year_set;
	}

	function get_year_by_id($year_id) {
		global $connection;
		$query = "SELECT * 
				FROM year
				WHERE year_id = {$year_id}
				LIMIT 1";
		$result_set = mysql_query($query,$connection);
		confirm_query($result_set);
		if($year = mysql_fetch_array($result_set)) {
			return $year;
		} else {
			return NULL;
		}
	}

	function get_all_events($year_id){
		global $connection;
		$query = "SELECT *
				FROM events
				WHERE occured_in = {$year_id}
				ORDER BY id DESC";
		$event_set = mysql_query($query, $connection);
		confirm_query($event_set);
		return $event_set;
	}

	function get_event_by_id($event_id) {
		global $connection;
		$query = "SELECT * ";
		$query .= "FROM events ";
		$query .= "WHERE id=" . $event_id . " ";
		$query .= "LIMIT 1";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		if($event = mysql_fetch_array($result_set)) {
			return $event;
		} else {
			return NULL;
		}
	}

	function get_event_by_finish_point($finish) {
		global $connection;
		$query = "SELECT * ";
		$query .= "FROM events ";
		$query .= "WHERE finish=" . $finish . " ";
		$query .= "ORDER BY id DESC";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		return $result_set;
	}

	function get_selected_event(){
		global $sel_event;
		if (isset($_GET['eve'])) {
			$sel_event = get_event_by_id($_GET['eve']);
		} else {
			$sel_event=NULL;
		}
	}

	function get_all_team() {
		global $connection;
		$query= "SELECT * 
				FROM team
				ORDER BY id ASC";
		$team_set = mysql_query($query,$connection);
		confirm_query($team_set);
		return $team_set;
	}

	function print_all_chap_member() {
		$row = 1;
				if (($handle = fopen("data/members.csv", "r")) !== FALSE) {
				    
				    echo "<table border=\"1\" class=\"mem_table\">";
				    
				    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				        $num = count($data);
				        if ($row == 1) {
				            echo "<thead><tr>";
				        }else{
				            echo "<tr>";
				        }
				        for ($c=0; $c < $num; $c++) {
				            if(empty($data[$c])) {
				               $value = "&nbsp;";
				            }else{
				               $value = $data[$c];
				            }
				            if ($row == 1) {
				                echo "<th>{$value}</th>";
				            }else{
				            	$value = substr($value, 1, -1);
				                echo "<td>{$value}</td>";
				            }
				        }
				        if ($row == 1) {
				            echo "</tr></thead><tbody>";
				        }else{
				            echo "</tr>";
				        }
				        $row++;
				    }
				    echo "</tbody></table>";
				    fclose($handle);
				}
	}

	function get_team_by_year($year){
		global $connection;
		$query = "SELECT *
				FROM team
				WHERE worked_in = {$year}
				ORDER BY id ASC";
		$team_set = mysql_query($query);
		confirm_query($team_set);
		return $team_set;
	}

	function get_selected_team() {
		global $sel_team;
		if(isset($_GET["year"])) {
			$sel_team = get_team_by_year($_GET["year"]);
		} else {
			$sel_team = NULL;
		}
	}

	function get_upcoming_event() {
				echo "<h2>Upcoming Events</h2>";
              	$up_event_set = get_event_by_finish_point(0);
              	if(mysql_num_rows($up_event_set)) {
                  	echo "<ul>";
                  	while($event = mysql_fetch_array($up_event_set)) {
                    	echo "<li>";
                    	echo "<a href=\"event.php?eve=" . urlencode($event['id']) . 
                    	"\"><span>{$event['name']}</span></a></li>";
                  	}
                  	echo "</ul>";  
              	} else {
                	echo "<p>More Events Coming Soon!!</p>";
              	}
	}

	function redirect_to($location){
		//header will only in case there is no output
		if (!empty($location)){
   			die("<script>location.href = 'http://localhost/ACM/{$location}'</script>");
		}
		//header("Location : {$location}");
	}

	function get_question_by_event_year($event, $year) {
		global $connection;
		$query = "SELECT *
				FROM questions
				WHERE event_id = {$event}
				AND year_id = {$year}
				ORDER BY id ASC";
		$question_set = mysql_query($query, $connection);
		confirm_query($question_set);
		return $question_set;
	}

	function get_question_by_id($id) {
		global $connection;
		$query = "SELECT *
				FROM questions
				WHERE id = {$id}
				LIMIT 1";
		$question_set = mysql_query($query, $connection);
		confirm_query($question_set);
		if($question = mysql_fetch_array($question_set)) {
			return $question;
		} else {
			return NULL;
		}
	}

	function get_comments_by_question_id($question_id) {
		global $connection;
		$query = "SELECT *
				FROM comments
				WHERE question_id = {$question_id}
				ORDER BY id ASC";
		$comments_set = mysql_query($query, $connection);
		confirm_query($comments_set);
		return $comments_set;
	}

	function get_user_by_id($user_id) {
		global $connection;
		$query = "SELECT id,username
				FROM users
				WHERE id = {$user_id}
				LIMIT 1";
		$user_set = mysql_query($query, $connection);
		confirm_query($user_set);
		if($user = mysql_fetch_array($user_set)) {
			return $user;
		} else {
			return NULL;
		}
	}
	function find_user_exist($username) {
		global $connection;
		$query = "SELECT id
				FROM users
				WHERE username = '{$username}'
				LIMIT 1";
		$user_set = mysql_query($query, $connection);
		confirm_query($user_set);
		if($user = mysql_fetch_array($user_set)) {
			return 1;
		} else {
			return NULL;
		}		
	}

	function find_email($email) {
		global $connection;
		$query = "SELECT id
				FROM users
				WHERE email = '{$email}'
				LIMIT 1";
		$user_set = mysql_query($query, $connection);
		confirm_query($user_set);
		if($user = mysql_fetch_array($user_set)) {
			return 1;
		} else {
			return NULL;
		}	
	}
	function find_member($id) {
		if (($handle = fopen("data/only_members.csv", "r")) !== FALSE) {
		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		    	//print_r(substr($data[0], 1, -1));
		    	if($id == substr($data[0], 1, -1)) {
		    		return 1;
		    	}
		    }
		    fclose($handle);
		}
		return NULL;
	}

	function find_member_exist($member) {
		global $connection;
		$query = "SELECT id
				FROM users
				WHERE member = '{$member}'
				LIMIT 1";
		$user_set = mysql_query($query, $connection);
		confirm_query($user_set);
		if($user = mysql_fetch_array($user_set)) {
			return 1;
		} else {
			return NULL;
		}	
	}

?>
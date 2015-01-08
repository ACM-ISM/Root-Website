<div id="menu">
    <ul class="menu">
    	<li><a href="index.php" class="parent"><span>Home</span></a></li>
    	<li>
			<a href="aboutus.php" class="parent"><span>About Us</span></a>
		</li>
		<li>
			<a href="#" class="parent"><span>Team</span></a>
			<div>
				<ul>
					<?php 
						$year_set = get_all_years();
						while($year = mysql_fetch_array($year_set)) {
							echo "<li><a href=\"team.php?year=" . urlencode($year['year_id']) . "\"><span>";
							echo "{$year['menu_name']}</span></a></li>";
						}
					?>
				</ul>
			</div>
		</li>
		<li><a href="#" class="parent"><span>Events</span></a>
			<div>
				<ul>
					<?php $up_event_set = get_event_by_finish_point(0);
						$output = "<li><a href=\"#\"";
						if(mysql_num_rows($up_event_set)) {
							$output .= " class=\"parent\" ";
						}
						$output .= "><span>Upcoming Events</span></a>";
						echo $output;
						echo "<div><ul>";
						if(isset($_SESSION['staff_id'])) {
							while($event = mysql_fetch_array($up_event_set)) {
								echo "<li>";
								echo "<a href=\"change_details.php?eve=" . urlencode($event['id']) . 
								"\"><span>{$event['name']}</span></a></li>";
							}
						} else {
							while($event = mysql_fetch_array($up_event_set)) {
								echo "<li>";
								echo "<a href=\"event.php?eve=" . urlencode($event['id']) . 
								"\"><span>{$event['name']}</span></a></li>";
							}
						}
						echo "</ul></div>";	
					?>
					</li>
						<?php
							$year_set = get_all_years();
							while($year = mysql_fetch_array($year_set)) {
							echo "<li><a href=\"#\" class=\"parent\"><span>";
							echo "{$year['name']}";
							echo "</span></a>";
							echo "<div><ul>";
							$event_set = get_all_events($year['year_id']);
								if(isset($_SESSION['staff_id'])) {
								while($event = mysql_fetch_array($event_set)) {
									echo "<li>";
									echo "<a href=\"change_details.php?eve=" . urlencode($event['id']) . 
									"\"><span>{$event['name']}</span></a></li>";
								}
							} else {
								while($event = mysql_fetch_array($event_set)) {
									echo "<li>";
									echo "<a href=\"event.php?eve=" . urlencode($event['id']) . 
									"\"><span>{$event['name']}</span></a></li>";
								}
							}
							echo "</ul></div>";
						}
						echo "</li>";
					?>
				</ul>
			</div>
		</li>
		<li>
			<a href="members.php" class="parent"><span>Members</span></a>
		</li>
		<?php
			if(check_login()) {
				echo "<li><a href=\"forum.php\" class=\"parent\"><span>Forum</span></a></li>";
			} else {
				echo "<li><a href=\"login.php\" class=\"parent\"><span>Join Us</span></a></li>";
			}
		?>
		<?php
			if(isset($_SESSION['staff_id'])) {
				echo "<li><a href=\"staff_area.php\" class=\"parent\"><span>Staff Area</span></a></li>";
			}
		?>    
	</ul>
</div>
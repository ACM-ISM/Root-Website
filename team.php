<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php require_once("includes/header.php") ?>
<?php
	if(!isset($_GET['year'])) {
		redirect_to("index.php");
	}
	if(!intval($_GET['year'])) {
		redirect_to("index.php");
	}
?>
<?php get_selected_team(); ?>
		<div class="content clearfix">
			<div class="chapter display clearfix">
				<?php
					$year = get_year_by_id($_GET["year"]);
					echo "<h2>ACM Team {$year["menu_name"]}</h2>";
					if(mysql_num_rows($sel_team) != 0)
					{
						$count = 1;
						while($member = mysql_fetch_array($sel_team)) {
							$put = "";
							if($count==1) {
								$put = "<div class=\"fac_container clearfix\">";
								$put .= "<h2>Faculty Advisors</h2>";
							} else if($count==4) {
								$put = "</div>";
								$put .= "<div class=\"core_container clearfix\">";
								$put .= "<h2>Core Team</h2>";
							} else if($count==9) {
								$put = "</div>";
								$put .= "<div class=\"promo_container clearfix\">";
								$put .= "<h2>Promotional Team</h2>";
							}
							if($count==4 || $count==9) {
								$output = "<div class=\"contain_stud alp\">";
							}else if($count>3 && $count!=7) {
								$output = "<div class=\"contain_stud\">";
							} else if($count==7) {
								$output = "<div class=\"contain_stud omeg\">";
							} else if($count==1){
								$output = "<div class=\"contain_fac alp\">";
							} else {
								$output = "<div class=\"contain_fac\">";
							}
							$output .= "<div class=\"cuvimg\">";
							$output .= "<a href=\"{$member["facebook"]}\">
										<img src=\"{$member['pic_link']}\" alt=\"try\" /></a>";
							$output .= "</div>";
							$output .= "<span>{$member['name']}</span>";
							$output .= "<p>{$member['position']}</p>";
							$output .= "<p>{$member['department']}</p>";
							$output .= "<p>{$member['position_in']}</p>";
							if(!is_null(check_login())) {
								$output .= "<p>{$member['phone']}</p>";
							}
							$output .= "<p>{$member['email']}</p>";
							$output .= "</div>";
							$count +=1;
							echo $put;
							echo $output;
						}
					} else {
						redirect_to("index.php");
					}
						
				?>
		</div>
	</div>
<?php include("includes/footer.php") ?>


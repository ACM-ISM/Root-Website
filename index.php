<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php require_once("includes/header.php") ?>
		<div class="flexslider">
          <ul class="slides">
            <?php
              $query = "SELECT id,pic_link
                      FROM events
                      ORDER BY id DESC";
              $result_set = mysql_query($query, $connection);
              confirm_query($result_set);
              $i=1;
              while($result = mysql_fetch_array($result_set)) {
								if(strlen($result['pic_link'])!=0)
								{
									if($i<=4) {
										echo "<li><a href=\"event.php?eve={$result['id']}\"><img src=\"{$result['pic_link']}\" /></a></li>";
									}
									$i += 1;
								}
              }
            ?>
          </ul>
    </div>
        <div class="content clearfix">
        	<div class="chapter grid_8 alpha">
        		<h2>About ACM</h2>
        		<p class="space">
              ACM, the Association of Computing Machinery,
               is the world’s largest educational and scientific
                computing society, uniting computing educators,
                 researchers and professionals to inspire dialogue,
                  share resources and address the field’s challenges.
            </p> <br>
        			<p class="space">
                ACM strengthens the profession’s collective voice through
                 strong leadership, promotion of the highest standards, and
                  recognition of technical excellence. ACM supports the professional
                   growth of its members by providing opportunities for life-long learning,
                    career development, and professional networking.
                    <a href="aboutus.php">[Read More...]</a>
              </p><br>
        	</div>
        	<div class="event grid_4 omega">
            <?php get_upcoming_event(); ?>
        	</div>
          <?php
            if(!is_null(check_login())) {
              echo "<div class=\"event grid_4 omega\">";
              echo "<p>Please select an event to join the discussion</p>";
              echo "</div>";
            }
          ?>
        </div>
	<script defer src="js/jquery.flexslider.js"></script>
	<script type="text/javascript">
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
    </script>
<?php include("includes/footer.php") ?>

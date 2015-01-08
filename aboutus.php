<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/header.php"); ?>
		<div class="content clearfix">
        	<div class="chapter grid_8 alpha">
        		<h2>What is ACM? </h2>
				<p> World’s largest ‘Educational & Scientific Computing Society’ having more than 100,000 students & professionals. Established in 1947 with the creation of the first stored-program digital computer.
				</p>
				<p> Motto: “Advancing Computing as a Science & Profession”. 
				</p>
				<p> Goal: To help the world fully realise the real potential of the ‘Science of Computing’.
				</p></br>
				<h2>What is ACM Student Chapter, ISM Dhanbad? </h2>
				<p class="space">The ISM Dhanbad Student Chapter of the ACM was established in 2011 to address the needs of the ISM Dhanbad computing community. The chapter organizes talks and workshops on different subjects by speakers who are well known in their area.</p>
				<p class="space">These talks give students opportunities
					 to learn about advanced research subjects. Regular coding 
					 competition are also organized to develop healthy competitive
					  environment among the students. It serves as a dynamic hub of 
					  activity where those that are passionate about computing come to meet,
					   interact, and learn from one another.</p></br>
				<h2>Benefits of ACM Student Chapter </h2>
				<p> Provides an opportunity to members to participate more actively in the activities of ACM like ACM-ICPC, world’s largest computer programming contest.</p>
				<p>Allows members to exercise leadership abilities, communicational skills, teamwork skills & organisational skills through various events.
				</p>
				<p> Provides a platform to enhance your coding skills, computational skills and knowledge through various competitions & workshops.
				</p>
				<p> Helps in developing ‘Professional Connections’.
				Provides career & professional development opportunities.</P>
				<p>Distinguished Speakers Program – ACM provides an opportunity to organise talks with top Technology Leaders & Innovators, also contributing to the cost of organising such events.</p>
				<p>Receipt of ACM’s Popular E-Newsletters like membernet.</P></br>
        	</div>
        	<div class="event grid_4 omega">
        		<?php get_upcoming_event(); ?>
        	</div>
        </div>
<?php include("includes/footer.php"); ?>        	

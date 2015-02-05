<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/form_functions.php"); ?>
<?php confirm_staff_login(); ?>
<?php
	if(isset($_POST['submit'])) {
		$name = mysql_para_prep($_POST['name']);
		$year = mysql_para_prep($_POST['year']);
		$content = mysql_para_prep($_POST['content']);
		$details = mysql_para_prep($_POST['details']);
		$winners = mysql_para_prep($_POST['winners']);
		$editorials = mysql_para_prep($_POST['editorials']);
		$finish = $_POST['finish'];
		$online = $_POST['online'];
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		$file_name = $name . $year. "." . $extension;
		$pic_link = "img/". $file_name;
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 1000000)
		&& in_array($extension, $allowedExts)) {
			if ($_FILES["file"]["error"] > 0) {
			    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
			} else {
			    echo "Upload Image: " . $_FILES["file"]["name"] . "<br>";
			    echo "Image Type: " . $_FILES["file"]["type"] . "<br>";
			    echo "Image Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
			    if (file_exists("upload/" . $_FILES["file"]["name"])) {
			      	echo $_FILES["file"]["name"] . " already exists. ";
			    } else {
			      	move_uploaded_file($_FILES["file"]["tmp_name"],
			      	"img/" . $file_name);
			      	echo "Stored in: " . "img/" . $file_name;
			    }
			}
		} else {
		  	echo "Invalid file";
		}
		$query = "INSERT INTO events (
					name, occured_in, pic_link, content, details, winners, editorials, finish, online
					) values (
					'{$name}', {$year}, '{$pic_link}', '{$content}', '{$details}','{$winners}', '{$editorials}', {$finish}, {$online}
					)";
		if(mysql_query($query, $connection)) {
			header("Location: staff_area.php");
		} else {
			//echo mysql_error();
			echo "<p>Event creation failed!!</p>";
		}
	}
?>
<?php require_once("includes/header.php"); ?>
<div class="content clearfix">
   	<div class="chapter display clearfix">
		<form action="new_event.php" method="POST" class="bootstrap-frm" enctype="multipart/form-data">
		    <h1>Event Form
		        <span>Please fill all the texts in the fields.</span>
		    </h1>
		    <label>
		        <span>Event Name :</span>
		        <input id="name" type="text" name="name" placeholder="Event Name" />
		    </label>
		    <label>
		        <span>Year :</span>
		        <input id="year" type="text" name="year" placeholder="Current Year" />
		    </label>
		    <label>
		    	<span>Image :</span>
		    	<input id="file" type="file" name="file" >
		    </label>

		    <label>
		        <span>Content :</span>
		        <textarea id="content" name="content" placeholder="<?php
		        	echo nl2br("<p>Your description here</p>\n");
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
		        <span>Details :</span>
		        <textarea id="details" name="details" placeholder="<?php
		        	echo "<h2>Schedule &Timings</h2>";
		        	echo "<ul>";
		        	echo "<li>Shedule it</li>";
		        	echo "</ul>";
		        ?>"></textarea>
		    </label>
		    <label>
		        <span>Winners :</span>
		        <textarea id="winners" name="winners" placeholder="<?php
		        	echo "<h2>Winners</h2>";
		        	echo "<ol>";
		        	echo "<li>Name of winners</li>";
		        	echo "</ol>";
		        ?>"></textarea>
		    </label>
		    <label>
		        <span>Editorials :</span>
		        <textarea id="editorials" name="editorials" placeholder="<?php
		        	echo "<p>Clic here to download</p>";
		        	echo "<a href="."></a>";
		        ?>"></textarea>
		    </label>
		     <label>
		        <span>Finished :</span>
		        <input type="radio" name="finish" value="0">No
		        <input type="radio" name="finish" value="1">Yes
		    </label>
		    <label>
		        <span>Online :</span>
		        <input type="radio" name="online" value="0">No
		        <input type="radio" name="online" value="1">Yes
		    </label>
		     <label>
		        <span>&nbsp;</span>
		        <input type="submit" name="submit" class="button" value="Enter into Database" />
		    </label>
		</form>
	</div>
</div>
<?php include("includes/footer.php"); ?>

<?php

	function mysql_para_prep($data) {
		$data = trim($data);
		$data = htmlspecialchars($data);
		$data = mysql_real_escape_string($data);
		return $data;
	}

	function mysql_prep($data) {
		$data = trim($data);
		$data = mysql_real_escape_string($data);
		return $data;
	}

	function mysql_comment_prep($data) {
		$data = trim($data);
		$data = htmlspecialchars($data);
		$data = nl2br($data);
	  	$data = mysql_real_escape_string($data);
	  	return $data;
	}

	function random_string()
	{
	    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    $randstring = " ";
	    for ($i = 0; $i < 18; $i++) {
	        $randstring[$i] = $characters[rand(0, strlen($characters)-1)];
	    }
	    return $randstring;
	}
	
?>
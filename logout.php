<?php 
	session_start();
	if(isset($_SESSION['mybook_userid'])) {
		unset($_SESSION['mybook_userid']);
	}
	
	header("Location: login.php");
	die;
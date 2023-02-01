<?php
	include("autoload.php");
	
	#Check the login of the user
	$login = new Login();
	$user_data = $login->check_login($_SESSION['mybook_userid']);
	
	$ERROR = "";
	if(isset($_GET['id'])) {
		$Post = new Post();
		$row = $Post->get_one_post($_GET['id']);
		
		if(!$row) {
			$ERROR = "No such post was found!";
		}
	} else {
		$ERROR = "No such post was found!";
	}
?>
<html>
	<head>
		<title> MyBook | Delete </title>
		<link href="index.css" rel="stylesheet">
	</head>
	<body>
		<br>
		<!-- Top Bar -->
		<?php include("header.php"); ?>
		
		<!-- Cover Area -->
		<div id="cover_area">
			
			<!-- Below Cover Area -->
			<div style="display: flex;">
				
				<!-- Posts Area -->
				<div style="min-height: 400px; flex: 2.5; padding: 20px; padding-right: 0px;">
					<div id="create_post">
						<h2> Delete Post </h2>
						<form method="post">
							Are you sure you want to delete this post? <br>
							<hr>
								<?php 
									echo $row['post']; 
								?>
							<hr>
							<input id="post_button" type="submit" value="Delete"> <br>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
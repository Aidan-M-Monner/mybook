<?php
	include("autoload.php");
	
	#Check the login of the user
	$login = new Login();
	$user_data = $login->check_login($_SESSION['mybook_userid']);
	
	#Friends Profiles
	if(isset($_GET['id']) && is_numeric($_GET['id'])) { #is_numeric is used for whitelisting, keeps users from breaking program through typing 
		$profile = new Profile();
		$profile_data = $profile->get_profile($_GET['id']);
		
		if(is_array($profile_data)) {
			$user_data = $profile_data[0];
		}
	}
	
	#Check if something has been posted
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$post = new Post();
		$id = $_SESSION['mybook_userid'];
		$result = $post->create_post($id, $_POST, $_FILES);
		
		if($result == "") {
			header("Location: profile.php");
			die;
		} else if ($result != "") {
			echo "<div stle='text-align: center; font-size: 12px; color: white; background-color: grey'>";
			echo "<br> The following errors occured: <br><br>";
			echo $result;
			echo "</div>";
		}
	}
	
	#Collect posts
	$post = new Post();
	$id = $user_data['userid'];
	$posts = $post->get_posts($id);
	
	#Collect Friends 
	$user = new User();
	$friends = $user->get_friends($id);
	
	$image_class = new Image();
?>

<html>
	<head>
		<title> MyBook | Profile </title>
		<link href="profile.css" rel="stylesheet">
	</head>
	<body>
		<br>
		<!-- Top Bar -->
		<?php include("header.php"); ?>
		
		<!-- Cover Area -->
		<div id="cover_area">
			<div id="image_area">
				<?php 
					$image = "images/cover_image.jpg";
					if(file_exists($user_data['cover_image'])) {
						$image = $image_class->get_thumb_cover($user_data['cover_image']);
					}
				?>
				<img src="<?php echo $image ?>" style="width: 100%;">
				<span style="font-size: 12px;">
					<?php 
						$image = "images/user_male.jpg";
						if($user_data['gender'] == "Female") {
							$image = "images/user_female.jpg";
						}
						if(file_exists($user_data['profile_image'])) {
							$image = $image_class->get_thumb_profile($user_data['profile_image']);
						}
					?>
					<img src="<?php echo $image ?>" id="profile_pic"><br>
					<!-- Query strings used to define which image we want changed, while using same page -->
					<a href="change_profile_image.php?change=profile" style="text-decoration: none; color: #f0f;"> Change Profile Image </a> | 
					<a href="change_profile_image.php?change=cover" style="text-decoration: none; color: #f0f;"> Change Cover Image </a>
				</span><br>
				<div style="font-size: 20px;"> <?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?> </div><br>
				<a href="index.php"><div id="menu_buttons"> Timeline </div></a>
				<div id="menu_buttons"> About </div> 
				<div id="menu_buttons"> Friends </div> 
				<div id="menu_buttons"> Photos </div>
				<div id="menu_buttons"> Settings </div>
			</div>
			
			<!-- Below Cover Area -->
			<div style="display: flex;">
				<!-- Friends Area -->
				<div style="min-height: 400px; flex: 1;">
					<div id="friends_bar">
						<?php 
							if($friends) {
								foreach($friends as $FRIEND_ROW) {
									include("user.php");
								}
							}
						?>
					</div>
					
				</div>
				
				<!-- Posts Area -->
				<div style="min-height: 400px; flex: 2.5; padding: 20px; padding-right: 0px;">
					<div id="create_post">
						<form method="post" enctype="multipart/form-data">
							<textarea name="post" placeholder="What's on your mind?"></textarea><br>
							<input type="file" name="file">
							<input id="post_button" type="submit" value="Post"> <br>
						</form>
					</div>
					
					<!-- Posts -->
					<div id="post_bar">
						<?php 
							if($posts){
								foreach($posts as $ROW) {
									$user = new User();
									$ROW_USER = $user->get_user($ROW['userid']);
									include("post.php");
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
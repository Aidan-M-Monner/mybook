<?php
	session_start();
	include("classes/connect.php");
	include("classes/login.php");
	include("classes/user.php");
	include("classes/post.php");
	include("classes/image.php");
	
	#Check the login of the user
	$login = new Login();
	$user_data = $login->check_login($_SESSION['mybook_userid']);
	
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
			#Check to make sure the type is correct
			if($_FILES['file']['type'] == "image/jpeg") {
				
				#Check size as you do not want overly large files added.
				#1024 * 1024 is the avergae MB size
				$allowed_size = 1024 * 1024 * 3;
				if($_FILES['file']['size'] <= $allowed_size) {
					#Everything is fine!
					
					#Creating a folder to hold images
					$folder = "uploads/" . $user_data['userid'] . "/";
					if(!file_exists($folder)) {
						mkdir($folder, 0777, true);
					}
					
					$image = new Image();
					$filename = $folder . $image->generate_filename(15) . ".jpg";
					move_uploaded_file($_FILES['file']['tmp_name'], $filename);
					
					$change = "profile";
					#Check for image being replaced
					if(isset($_GET['change'])) {
						$change = $_GET['change'];
					}
					
					if($change == "cover") {
						#Delete former cover image
						if(file_exists($user_data['cover_image'])) {
							unlink($user_data['cover_image']);
						}
						
						$image->resize_image($filename, $filename, 1500, 1500);
					} else {
						#Delete former profile image
						if(file_exists($user_data['profile_image'])) {
							unlink($user_data['profile_image']);
						}
						
						$image->resize_image($filename, $filename, 800, 800);
					}
					
					if(file_exists($filename)) {
						$userid = $user_data['userid'];
						
						if($change == "cover") {
							$query = "update users set cover_image = '$filename' where userid = '$userid' limit 1";
							$_POST['is_cover_image'] = 1;
						} else {
							$query = "update users set profile_image = '$filename' where userid = '$userid' limit 1";
							$_POST['is_profile_image'] = 1;
						}
						
						$DB = new Database();
						$DB->save($query);
						
						#Create a post 
						$post = new Post();
						$post->create_post($userid, $_POST, $filename);
						
						header(("Location: profile.php"));
						die;
					}
				} else {
					echo "<div stle='text-align: center; font-size: 12px; color: white; background-color: grey'>";
					echo "<br> The following errors occured: <br><br>";
					echo "Only images of size 3MB or lower are allowed.";
					echo "</div>";
				}
			} else {
				echo "<div stle='text-align: center; font-size: 12px; color: white; background-color: grey'>";
				echo "<br> The following errors occured: <br><br>";
				echo "Please add a valid image";
				echo "</div>";
			}
	
		} else {
			echo "<div stle='text-align: center; font-size: 12px; color: white; background-color: grey'>";
			echo "<br> The following errors occured: <br><br>";
			echo "Please add a valid image";
			echo "</div>";
		}
	}
?>
<html>
	<head>
		<title> MyBook | Change Profile Image </title>
		<link href="change_profile_image.css" rel="stylesheet">
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
					<form method="post" enctype="multipart/form-data">
						<div id="create_post">
							<input type="file" name="file">
							<input id="post_button" type="submit" value="Change"> <br><br>
							
							<div style='text-align: center'>
								<br>
								<?php
									$change = "profile";
									
									#Check for mode
									if(isset($_GET['change']) && $_GET['change'] == "cover") {
										$change = "cover";
										echo "<img src='$user_data[cover_image]' style='max-width: 500px;'>";
									} else {
										echo "<img src='$user_data[profile_image]' style='max-width: 500px;'>";
									}
								?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
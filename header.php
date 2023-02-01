<!-- Top Bar -->
	<?php
		$corner_image = "images/user_male.jpg";
		if($user_data['gender'] == "Female") {
			$image = "images/user_female.jpg";
		}
		if(file_exists($user_data['profile_image'])) {
			$image_class = new Image();
			$corner_image = $image_class->get_thumb_profile($user_data['profile_image']);
		}
	?>
		<div id="blue_bar">
			<div id="blue_bar2">
				<a href="index.php" style="text-decoration: none; color: white;"> MyBook </a>
				&nbsp &nbsp
				<input type="text" id="search_box" placeholder="Search for People">
				<a href="profile.php">
					<img src="<?php echo $corner_image ?>" style="width: 50px; float: right;">
				</a>
				<a href="logout.php">
					<span style="font-size:11px; float: right; margin: 10px; color: white;"> Logout </span>
				</a>
			</div>
		</div>
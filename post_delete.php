<div id="posts">
	<div>
		<?php 
			$image = "";
			if($ROW_USER['gender'] == "Male") {
				$image = "images/user_male.jpg";
			} else if($ROW_USER['gender'] == "Female") {
				$image = "images/user_female.jpg";
			}
			
			if(file_exists($ROW_USER['profile_image'])) {
				$image = $image_class->get_thumb_profile($ROW_USER['profile_image']);
			}
		?>
		<img src="<?php echo $image ?>" style="width: 75px; margin-right: 4px; border-radius: 50%;">
	</div>
	<div style="width: 100%;">
		<div style="font-weight: bold; color: #405d9b;"> 
		<?php 
			echo $ROW_USER['first_name'] . " " . $ROW_USER['last_name']; 
			
			if($ROW['is_profile_image']) {
				$pronoun = "his";
				if($ROW_USER['gender'] == "Female") {
					$pronoun = "her";
				}
				echo "<span style='font-weight: normal; color: #aaa;'> updated $pronoun profile image </span>";
			}
			
			if($ROW['is_cover_image']) {
				$pronoun = "his";
				if($ROW_USER['gender'] == "Female") {
					$pronoun = "her";
				}
				echo "<span style='font-weight: normal; color: #aaa;'> updated $pronoun cover image </span>";
			}
		?> 
		</div>
		
		<?php echo htmlspecialchars($ROW['post']); ?> <!-- htmlspecialchars() is used to prevent the typing and site breaking of code. -->
		<br><br>
		<?php 
			if(file_exists($ROW['image'])) {
				$post_image = $image_class->get_thumb_post($ROW['image']);
				echo "<img src='$post_image' style='width: 80%;' />";
			}
		?>
		<br><br>
		
		<a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;"><?php echo $ROW['date']; ?></span>
		<span style="color: #999; float: right;"> 
			<a href="edit.php?<?php echo $ROW['postid']; ?>" style="text-decoration: none;"> Edit </a> . 
			<a href="delete.php?<?php echo $ROW['postid']; ?>" style="text-decoration: none;"> Delete </a> 
		</span>
	</div>
</div>
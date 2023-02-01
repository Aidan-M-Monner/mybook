<html>
	<head>
		<title> MyBook | Profile </title>
		<link href="timeline.css" rel="stylesheet">
	</head>
	<body>
		<br>
		<!-- Top Bar -->
		<div id="blue_bar">
			<div id="blue_bar2">
				MyBook 
				&nbsp &nbsp
				<input type="text" id="search_box" placeholder="Search for People">
				<img src="images\selfie.jpg" style="width: 50px; float: right;">
			</div>
		</div>
		
		<!-- Cover Area -->
		<div id="cover_area">
			
			<!-- Below Cover Area -->
			<div style="display: flex;">
				<!-- Friends Area -->
				<div style="min-height: 400px; flex: 1;">
					<div id="friends_bar">
						<img id="profile_pic" src="images/selfie.jpg"><br>
						Mary Banda
					</div>
				</div>
				
				<!-- Posts Area -->
				<div style="min-height: 400px; flex: 2.5; padding: 20px; padding-right: 0px;">
					<div id="create_post">
						<textarea placeholder="What's on your mind?"></textarea>
						<input id="post_button" type="submit" value="Post"> <br><br>
					</div>
					
					<!-- Posts -->
					<div id="post_bar">
						<div id="posts">
							<div>
								<img src="images/user1.jpg" style="width: 75px; margin-right: 4px;">
							</div>
							<div>
								<div style="font-weight: bold; color: #405d9b"> First User </div>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
								Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
								when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
								It has survived not only five centuries, but also the leap into electronic typesetting, 
								remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
								and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
								<br><br>
								<a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;"> May 20th 2022 </span>
							</div>
						</div>
						
						<div id="posts">
							<div>
								<img src="images/user2.jpg" style="width: 75px; margin-right: 4px;">
							</div>
							<div>
								<div style="font-weight: bold; color: #405d9b"> Second User </div>
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
								Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
								when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
								It has survived not only five centuries, but also the leap into electronic typesetting, 
								remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
								and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
								<br><br>
								<a href="">Like</a> . <a href="">Comment</a> . <span style="color: #999;"> May 20th 2022 </span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
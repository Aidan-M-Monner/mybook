<?php 
	session_start();
	
	include("classes/connect.php");
	include("classes/login.php");
	
	$email = "";
	$password = "";
	
	#Check if Submit has been clicked?
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$login = new Login();
		$result = $login->evaluate($_POST);
		
		if($result != ""){
			echo "<div style='text-align:center; font-size: 12px; color: white; background-color: grey;'>";
			echo "<br> The following errors occured: <br><br>";
			echo $result;
			echo "</div>";
		} else if ($result == "") {
			#redirect to profile page
			header("Location: profile.php");
			die;
		}
		
		$email = $_POST['email'];
		$password = $_POST['password'];
	}
?>
<html>
	<head>
		<title> MyBook | Login </title>
		<link rel="stylesheet" href="login.css"> 
	</head>
	<body>
		<div id="bar"> 
			<div style="font-size: 40px;"> MyBook Signup </div>
			<a href="signup.php"><div id = "signup_button"> Signup </div></a>
		</div>
		
		<div id="bar2">
			<form method="post">
				Login to MyBook <br><br>
				<input name="email" value="<?php echo $email ?>" type="text" id="text" placeholder="Email"><br><br>
				<input name="password" value="<?php echo $password ?>" type="password" id="text" placeholder="Password"><br><br>
				<input type="submit" id="button" value="Login"><br><br>
			</form>
		</div>
	</body>
</html>
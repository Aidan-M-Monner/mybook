<?php 
	include("classes/connect.php");
	include("classes/signup.php");
	
	$first_name = "";
	$last_name = "";
	$gender = "";
	$email = "";
	
	#Check if Submit has been clicked?
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$signup = new Signup();
		$result = $signup->evaluate($_POST);
		
		if($result != ""){
			echo "<div style='text-align:center; font-size: 12px; color: white; background-color: grey;'>";
			echo "<br> The following errors occured: <br><br>";
			echo $result;
			echo "</div>";
		} else if ($result == "") {
			#redirect to profile page
			header("Location: login.php");
			die;
		}
		
		$first_name = ucfirst($_POST['first_name']);
		$last_name = ucfirst($_POST['last_name']);
		$gender = $_POST['gender'];
		$email = $_POST['email'];
	}
?>

<html>
	<head>
		<title> MyBook | Signup </title>
		<link rel="stylesheet" href="signup.css" type="text/css"> 
	</head>
	<body>
		<div id="bar"> 
			<div style="font-size: 40px;"> MyBook Signup </div>
			<div id = "signup_button"> Login </div>
		</div>
		
		<div id="bar2">
			Signup to MyBook <br><br>
			<form method="post" action="">
				<input value="<?php echo $first_name ?>" name="first_name" type="text" id="text" placeholder="First Name"><br><br>
				<input value="<?php echo $last_name ?>" name="last_name" type="text" id="text" placeholder="Last Name"><br><br>
				<input value="<?php echo $gender ?>" name="gender" type="text" id="text" placeholder="Gender" list="genders"><br><br>
					<datalist id="genders">
						<option value="Male">
						<option value="Female">
					</datalist>
				<input value="<?php echo $email ?>" name="email" type="text" id="text" placeholder="Email"><br><br>
				<input name="password" type="password" id="text" placeholder="Password"><br><br>
				<input name="password2" type="password" id="text" placeholder="Retype Password"><br><br>
				<input type="submit" id="button" value="Signup"><br><br>
				</form>
		</div>
	</body>
</html>
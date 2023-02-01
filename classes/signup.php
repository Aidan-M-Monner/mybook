<?php 
	#Signing the user up
	class Signup {
		
		#Checks for errors
		private $error = "";
		
		
		#Evaluates the data
		public function evaluate($data){
			#Goes through each data piece looking at the key then taking in the value
			foreach($data as $key => $value){
				
				#Check if value is empty?
				if(empty($value)){
					#error is equal to error and previous errors.
					$this->error = $this->error . $key . " is empty! <br>";
				}
				
				#Check to make sure name has no numbers
				if($key == "first_name"){
					if(is_numeric($value)){
						$this->error = $this->error . "First name cannot be a number. <br>";
					}
					if(strstr($value, " ")){
						$this->error = $this->error . "First name cannot have spaces. <br>";
					}
				}
				
				if($key == "last_name"){
					if(is_numeric($value)){
						$this->error = $this->error . "Last name cannot be a number. <br>";
					}
					if(strstr($value, " ")){
						$this->error = $this->error . "Last name cannot have spaces. <br>";
					}
				}
				
				#Check to make sure of real gender.
				if($key == "gender"){
					if($value != "Male" && $value != "Female"){
						$this->error = $this->error . "Gender not accepted. <br>";
					}
				}
				
				#Check to make sure email is typed correctly
				if($key == "email"){
					if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value)){
						$this->error = $this->error . "invalid email address!<br>";
					}
				}
				
			}
			#Display error if one exists
			if($this->error == ""){
				#No error!
				$this->create_user($data);
			} elseif($this->error != ""){
				return $this->error;
			}
		}
		
		
		#Creates a user
		public function create_user($data){
			#Gather Data
			$first_name = $data['first_name'];
			$last_name = $data['last_name'];
			$gender = $data['gender'];
			$email = $data['email'];
			$password = $data['password'];
			
			#Create These
			$url_address = strtolower($first_name) . "." . strtolower($last_name);
			$userid = $this->create_userid();
			
			#Put all data into the database
			$query = "insert into users (userid, first_name, last_name, gender, email, password, url_address) values ('$userid', '$first_name', '$last_name', '$gender', '$email', '$password', '$url_address')";

			$DB = new Database();
			$DB->save($query);
		}
		
		private function create_userid(){
			#Length of the user id
			$length = rand(4, 19);
			$number = "";
			
			#Places numbers in each spot
			for ($i = 0; $i < $length; $i++) {
				$new_rand = rand(0,9);
				$number = $number . $new_rand;
			}
			return $number;
		}
		
		private function create_url(){
			
		}
	}
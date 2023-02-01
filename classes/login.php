<?php 
	class Login {
		
		#Checks for errors
		private $error = "";
		
		function evaluate($data) {
			#Gather Data
			# addslashes() allows for commas '. 
			$email = addslashes($data['email']);
			$password = addslashes($data['password']);
			
			#Put all data into the database
			$query = "select * from users where email = '$email' limit 1";

			$DB = new Database();
			$result = $DB->read($query);
			
			if($result) {
				$row = $result[0];
				if($this->hash_text($password) == $row['password']){
					#Create session data
					$_SESSION['mybook_userid'] = $row['userid']; #add mybook to specify the site logged in.
				} else if($this->hash_text($password) != $row['password']) {
					$this->error .= "Wrong email or password. <br>";
				}
			} else if(!$result) {
				$this->error .= "Wrong email or password. <br>";
			}
			return $this->error;
		}
		
		private function hash_text($text) {
			#Hash passwords so that they are unreadable in database.
			$text = hash("sha1", $text);
			return $text;
		}
		
		public function check_login($id) {
			#check if user is logged in.
			if(is_numeric($id)){
				#Check all data in database
				$query = "select * from users where userid = '$id' limit 1";

				$DB = new Database();
				$result = $DB->read($query);
				
				if($result){
					$user_data = $result[0];
					return $user_data;
				} else if(!$result) {
					header("Location: login.php");
					die;
				}
			} else if(!is_numeric($id)) {
				header("Location: login.php");
				die;
			}
		}
	}
<?php 
	class Database{
		
		private $host = "localhost";
		private $username = "root";
		private $password = "";
		private $db = "mybook_db";
	
		function connect() {
			$connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
			return $connection; #Exit the function
		}
		
		function read($query) {
			$conn = $this->connect();
			$result = mysqli_query($conn, $query);
			
			#Check T/F 
			if(!$result) {
				return false;
			} elseif($result) {
				$data = false;
				while($row = mysqli_fetch_assoc($result)){
					$data[] = $row;
				}
				return $data;
			}
		}
		
		function save($query) {
			$conn = $this->connect();
			$result = mysqli_query($conn, $query);
			
			#Check T/F 
			if(!$result) {
				return false;
			} elseif ($result) {
				return true;
			}
		}
	}
	
	#NOTES:
	#Selects all from query:
	#$query = "select * from users";
	
	# The query takes in the names of the colums after table name, in this case users, then the created functions after values.
	#$query = "insert into users (first_name, last_name) values ('$first_name', '$last_name')";
	
	#mysqli_query is used to put query in table, placing names in the data base. Must call connection.
	#mysqli_query($connection, $query);
	
	#To see errors use:
	#echo mysqli_error($connection);
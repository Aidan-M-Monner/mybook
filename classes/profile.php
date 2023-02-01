<?php 
	Class Profile {
		function get_profile($id) {
			$id = addslashes($id); #addcslashes helps in ensuring user does not break program through typing.
			$DB = new Database();
			$query = "select * from users where userid = '$id' limit 1";
			$data = $DB->read($query);
			return $data;
		}
	}
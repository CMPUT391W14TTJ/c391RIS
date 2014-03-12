<?php

	/*
	 * I am only building set functions as variables can be accessed 
	 * in such a fashion: 
	 * 	$instance->var
	 */
	class User {
		var $username;
		var $password;
		var $user_id;
		var $user_class;
		var $first_name;
		var $last_name;
		var $address;
		var $email;
		var $phone;
	
		function setUserInfo($username, $password) {
			$this->username = $username;
			$this->password = $password;
		}
	
		function setPersonalInfo($first_name, $last_name, $address, $email, $phone) {
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->address = $address;
			$this->email = $email;
			$this->phone = $phone;
		}

		function setUserID ($user_id) {
			$this->user_id = $user_id;
		}
		
		function setUserClass ($user_class) {
			$this->user_class = $user_class;
		}
		
		function setPassword ($password) {
			$this->password = $password;
		}

		function outputGarbage() {
			echo "this is the instance";
		}
	}
?>

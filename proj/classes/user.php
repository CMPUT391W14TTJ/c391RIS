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

		function setUsername ($username) {
			$this->username = $username;
		}

		function setFirstName ($first_name) {
			$this->first_name = $first_name;
		}

		function setLastName ($last_name) {
			$this->last_name = $last_name;
		}

		function setAddress ($address) {
			$this->address = $address;
		}

		function setEmail ($email) {
			$this->email = $email;
		}
		
		function setPhone ($phone) {
			$this->phone = $phone;
		}

	}
?>

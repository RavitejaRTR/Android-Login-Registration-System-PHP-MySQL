<?php
	class ServerScripting{

		/* variables specifying the host and db access values */
		private $host = '127.0.0.1:3306';
		private $dbname = 'application';
		private $username = 'root';				//db root username
		private $password = 'rootpass';		//db root password
		private $connection;
		
		/* Constructor */
		public function __construct(){				
			$this -> connection = mysqli_connect($this -> host, $this -> username, $this -> password, $this -> dbname);
			if (!$this -> connection) {
				die('Could not connect: ' . mysqli_error());
			}
			echo 'Connected successfully. Databases : <br>';
			
			$result = mysqli_query($this -> connection,"SHOW DATABASES");
			
			while($row = mysqli_fetch_array($result)){
				echo $row[0].'<br>';
			}
		}
		
		/* Password encrypting function */
		/* This is simple hashing. If you are wanting a more secured encryption you can modify to suit your requirements */
		public function hashPassword($password){
			$encrypt = sha1($password);
			return $encrypt;
		}
		
		/* Create a new user. My database has UNIQUE associated to username so no need to check for username exists or not. An email can have multiple accounts but different usernaes */
		public function create_user($username , $email, $password){
			$encrypted_password = $this -> hashPassword($password);
			$username = mysqli_real_escape_string($this -> connection, $username);
			$email = mysqli_real_escape_string($this -> connection, $email);

			$sql = "INSERT INTO users (username,email,encrypted_password) VALUES ('$username','$email','$encrypted_password')";


			if(!mysqli_query($this -> connection,$sql)){
				return mysqli_error($this -> connection);
			}
			return "success";
		}
		
		/* username, password validation */
		public function login($username, $password){
			$username = mysqli_real_escape_string($this -> connection, $username);
			$encrypt = $this -> hashPassword($password);
			
			$sql = "SELECT * FROM users WHERE username = '$username'";
			$result = mysqli_query($this -> connection,$sql);
			$data = $result -> fetch_object();
			
			if(empty($data)){						/* User exists or not*/
				echo 'Username not found <br>';
				return false;
			}
			
			if($encrypt == $data -> encrypted_password){	/* Password check*/
				return true;
			}
			else
				return false;
		}
	}

	$db = new ServerScripting();
	$t = $db->create_user('raviteja','anyemail@gmail.com','P@ssword');
	echo $t.'<br>';
	if($db->login('raviteja','P@ssword'))
		echo 'user logged in successfully';
	else
		echo 'invalid username/password';
?>

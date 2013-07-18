<?php
require_once "database.php";

class Login{
  const message = "Invalid username or password!";
	const redirect = "index.html";	
	//const delete_message = "Successfully deleted record!";
	public $user;
	public $pass;
	public $mysqli;

	public function __construct($user, $pass, $mysqli)
		{
			$this->user=$user;
			$this->pass=$pass;
			$this->mysqli=$mysqli;
			//$this->Login();
		}

	public function Login(){	
			$password_MD5=MD5($this->pass);
			$sql="SELECT id, firstname, lastname, name, password FROM users WHERE name='$this->user' AND password='$password_MD5' LIMIT 1";
			$res = $this->mysqli -> query($sql);
			$row=$res -> fetch_assoc();
	
		if(!$row) 
			{
				//header ("Location: login.html");
				return  self::message;
			} 
		else 
			{	
				$_SESSION["loggedIn"] = true;
				$_SESSION["username"] = $row["name"];
				$_SESSION["userId"] = $row["id"];
				$_SESSION["realname"] = $row["firstname"]." ".$row["lastname"]; 
				return  self::redirect;
				//header ("Location: index.html");
			}
		}
	public function Register($firstname, $lastname, $currentDate){
			$password_MD5 = MD5($this->pass);
			$sql = "INSERT INTO users (firstname, lastname, name, password, registrationDate)  
						VALUES ('$firstname', '$lastname', '$this->user', '$password_MD5', '$currentDate')";
			$db_record= $this->mysqli-> query($sql);
			if (!$db_record)
				{
					echo "record error";
								}
			else 
			{	
				header ("Location: login.html");
				exit;
			}
	}

}





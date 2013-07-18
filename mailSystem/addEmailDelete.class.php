<?php
require_once "database.php";
require_once "databaseaware.class.php";
require_once "maillist.class.php";

class AddEmailDelete extends DatabaseAware{
const succes_message = "Successful Record!";  
const delete_message = "Successfully deleted record!";	
public $listID;

public function __construct($database, $listID){
	parent::__construct($database);
	$this->listID=$listID;
}

public function addEmail($email){
	$sql = "INSERT INTO email(email, listID) VALUES('$email', '%s')";
	$sql = sprintf($sql, $this -> listID);
	$res = $this -> database -> query($sql);

	if(!$res) 
		{
			 return array("error" => $this -> database -> error);
		}
	else 
		{
			return self::succes_message;
		}
}

public function deleteEmail($arrEmails){
		foreach ($arrEmails as $value){ 
			//$email= element "$i" array $arrEmails
			$sql="DELETE FROM email	WHERE emailID = $value";
				if(!$sql)
						{
							die(mysql_error());
						}
				$res = $this -> database -> query($sql);
			}
		return self::delete_message;
	}

}

<?php

  class MailList extends DatabaseAware {
		
		public $userID;
		public $listName;

		public function __construct ($database, $listName, $userID) {
			parent::__construct($database);

			$this -> listName = $listName;
			$this -> userID = $userID;
		}

		public function save() {
			$sql = "INSERT INTO list(listName, userID) VALUES('%s', '%s')";
			$sql = sprintf($sql, $this -> listName, $this -> userID);

			$res = $this -> database -> query($sql);

			if(!$res) {
				 return array("error" => $this -> database -> error);
			}

			$result = array(
				"userID" => $this -> userID,
				"listName" => $this -> listName,
		
			);

			return $result;
		}

		public function get() {
			$sql = "SELECT listID, listName FROM list WHERE userID='%s'";
			$sql = sprintf($sql, $this -> userID);
			$res = $this -> database -> query($sql);
			
			$result = array();

			while($row = $res -> fetch_assoc()) {
				$result[] = $row;
			}
			return $result;	
		}

		public function delete($listID) {
			$sql = "DELETE FROM list WHERE listID = $listID";
		if (!$sql)
			{
				die (mysql_error);
			}
		$res=$this ->database -> query($sql);

		}


		public function getEmails($listID){
		$result=array();
		$sql="SELECT emailID, email FROM email WHERE listID=$listID"; 
		if (!$sql)
			{
				die(mysql_error());
			}
		$res = $this -> database -> query($sql);
		while ($row = $res -> fetch_assoc())
			{
				$result[]=$row;
			}
		echo  json_encode($result); 
		
		}


 	}

 	

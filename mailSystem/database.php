<?php
  $mysqli = new mysqli("localhost", "root", "", "mail_system");
	if($mysqli -> connect_error) {
		die("There is a problem:<br />" . $mysqli ->  connect_error);
	}

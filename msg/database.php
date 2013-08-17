<?php
	$link = mysql_connect("localhost", "root", "");
	define('DB_CHARSET', 'utf8');
	define('DB_COLLATE', '');
    //mysql_query("set names 'utf8'",$link);
	if(!$link) {
		die("There is a problem:<br />" . mysql_error());
	}
	
	if(!mysql_select_db("mymsg")) {
		die(mysql_error());
	}

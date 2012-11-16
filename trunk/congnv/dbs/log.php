<?php
	// include essentials
	include('sources/class.db.php');
	include('sources/config.php');
	
	// get data
	$usrName = $_POST['usr_name'];
	$pwd 	 = $_POST['pwd'];
	
	// login check
	// connect db
	$db= new db;
	$db->connectdb($host, $user, $pass, $db);
	
	// check usrname & pwd
	$sql= "SELECT * FROM users WHERE usr_name= '$usrName' AND pwd= '$pwd'";
	$query = $db->query($sql) or die(mysql_error());
	
	$numRows= $db->rowCount($query);
	echo $numRows;
	
	
	
?>
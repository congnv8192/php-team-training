<?php
	session_start();
	$con = mysql_connect("localhost","root","");
		if (!$con)
		{
		die("Could not connect: ".mysql_error());
		}
		
	mysql_select_db('ebook');

	if(isset($_POST['acc'])){
		$u_name=$_POST['acc'];
		$pwd=$_POST['pass'];
		$repwd=$_POST['passretype'];
		$e_mail=$_POST['mail'];	
	}
	else{
		echo 'Please input first';
	}
	$pwd = addslashes( $_POST['pass'] ) ;
	
	$e_mail = addslashes( $_POST['mail'] );
	
	// Check the information fullfill or not
	if ( ! $u_name || ! $_POST['pass'] || ! $_POST['passretype'] || ! $e_mail)
	{
		print "Please fullfill all the box!! <a href='javascript:history.go(-1)'>Click HERE to go back</a>";
		exit;
	}
	// Check user is OK or not
	if ( mysql_num_rows(mysql_query("SELECT account FROM user WHERE account='$u_name'"))>0)
	{
		print "Username is existed. Try with another account <a href='javascript:history.go(-1)'>Click HERE to go back</a>";
		exit;
	}
	if ( $pwd != $repwd )
	{
		print "Password is wrong during retyping!!Please retype password again. <a href='javascript:history.go(-1)'>Click HERE to go back</a>";
		exit;
	}
	else{
	//insert db
	$SQL="INSERT INTO user (account, password, email) VALUES ('".$u_name."','".$pwd."','".$e_mail."')";
	$QUERY= mysql_query($SQL);
	echo 'Successful Registration';
	}
?>
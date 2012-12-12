<?php
	$con = mysql_connect("localhost","root","");
		if (!$con)
		{
		die("Could not connect: ".mysql_error());
		}
		
	mysql_select_db('ebook');

	if(isset($_POST['username'])){
		$account=$_POST['username'];
		$password=$_POST['password'];
		
	}
	else{
		echo 'Please input first';
	}
	
	//select db
	$sql="SELECT * FROM user";
	$query= mysql_query($sql);
	
	while($data=mysql_fetch_array($query))
	{
		$db_account = $data['account'];
		$db_password = $data['password'];
	}
	/*check username from db
	*/
	if($db_account==$account && $db_password==$password)
		echo 'Welcome  ' .$account;
	else
		echo 'Wrong password or wrong ID';
	
?>
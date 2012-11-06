<?php
if (isset($_POST['u_name'])){
	$u_name=$_POST['u_name'];
	$pwd=$_POST['password'];
	
	
	//connect db
	$con = @mysql_connect("localhost","root","");
		if (!$con)
		    echo'can not connect database';
		mysql_select_db('conbo.com');
	
	//select data
	$sql="SELECT * FROM user";
	$query=mysql_query($sql);
	

	while($data=mysql_fetch_array($query)){
		$db_u_name= $data['u_name'];
		$db_pwd= $data['pwd'];
	}
	
	// check
	if (($db_u_name==$u_name) &&($db_pwd==$pwd))
		echo'welcome to my website';
	else
		echo'invalid username or password';
	
	}
else{
	echo 'Please input first!';
}

	 
?>
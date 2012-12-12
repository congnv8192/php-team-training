<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>M.I.A Profile Edit</title>
<link href="styleprofile.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php
// hien thi mac dinh
// ket noi voi database server
$con=@mysql_connect('localhost','root','');
if (!$con) {exit('<p> unable to connect to the dbank at this time</p>');
}

//dinh dang kieu font chu
mysql_query("SET character_set_results=utf8", $con);
mb_language('uni');
mb_internal_encoding('UTF-8');

//$db=mysql_select_db('ebook',$dbcnx));
$db=mysql_select_db('ebook',$con);

mysql_query("set names 'utf8'",$con);

if (!$db){
exit ('<p> unable to connect to the db at this time</p>');
}

?>

<?php 

include 'include/topheader.php';
include 'include/clear.php';
include 'include/morelinks.php';

?>
<div class="item">
  <h5>Profile</h5>
	<div class="price">
		  <p><span class="new">Welcome to </span><span class="old">M.I.A</span></p></br></br>
<?php

	$u_id=$_SESSION['uid'];
	
	$select=("SELECT `account`, `fullname`, `dob`, `email`, `address`, `phone_number`,`avatar` FROM `user` WHERE user_id=".$u_id);
	
	$query=mysql_query($select);
	
	while($array=mysql_fetch_array($query)){
		
		$account=$array['account'];
		$name=$array['fullname'];
		$C2=$array[2];
		$C3=$array[3];
		$C4=$array[4];
		$C5=$array[5];
		$C6=$array[6];

		 echo' <form action="updateprofile.php" method="post">
		 	<input type="hidden" name="user_id" value="'.$u_id.'">
			<input type="hidden" name="avalink" value="'.$C6.'">
            <div id="avatar">Avatar:</div> <div id="avatar1"><img src="'.$C6.'" width="55" height="72"/></div><br/>
			<div id="trai">Change avatar:<input type=button name="avatar" value="change"/>  </div><br/> </br>               
			<div id="trai">Account: </div><input type="text" name="username" value="'.$account.'"></br></br>
			<div id="trai">Full Name: </div><input type="text" name="fullname" value="'.$name.'"></br></br>
        	<div id="trai">Date of Birth: </div><input type="text" name="dob" value="'.$C2.'"/></br></br>
         	<div id="trai">Email Address: </div><input type="text" name="email"  value="'.$C3.'"/></br></br>
         	<div id="trai">Address: </div><input type="text" name="address" value="'.$C4.'"/></br></br>
         	<div id="trai">Phone Number: </div><input type="text" name="phoneno" value="'.$C5.'"/></br></br>                 
			<div id="trai"><input type="submit" value="Save" onclick="this.form.submit">
				<input type="button" value=" Cancel " ONCLICK="history.go(-1)""></br></br></div>
			<div id="trai"><a href="M.I.AUserManageEdit.php"> To Book Management</div>
            </form>
			';
	}
?>
	</div>
</div>

<?php include 'include/bottom.php' ?>

</body>
</html>

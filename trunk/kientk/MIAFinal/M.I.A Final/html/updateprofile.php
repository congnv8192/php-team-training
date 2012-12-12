<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title ><?php echo $_SESSION['acc'] ?> Profile Edit</title>
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
	//xu ly post tu profile edit	
		$u_id=$_POST['user_id'];
		$avatar=$_POST['avatar'];
		$account=$_POST['username'];
		$name=$_POST['fullname'];
		$dob=$_POST['dob'];
		$email=$_POST['email'];
		$address=$_POST['address'];
		$phone=$_POST['phoneno'];
		
	//update query to SQL db
	$update=("UPDATE user SET `account`='".$account."', `fullname`='".$name."', `dob`='".$dob."', `email`='".$email."', `address`='".$address."', `phone_number`=".$phone." WHERE user_id=".$u_id);
	mysql_query($update);

	// show edited data:		

		 echo'
            <div id="avatar">Avatar:</div> <div id="avatar1"><img src="'.$avatar.'" width="55" height="72"/></div></br>                 
			<div id="trai">Account: '.$account.'</div></br></br>
			<div id="trai">Full Name: '.$name.'</div></br></br>
        	<div id="trai">Date of Birth: '.$dob.'</div></br></br>
         	<div id="trai">Email Address: '.$email.'</div></br></br>
         	<div id="trai">Address: '.$address.'</div></br></br>
         	<div id="trai">Phone Number: '.$phone.'</div></br></br>
			
			<input type="button" onclick="javascript.parent.location="M.I.AHome.php" value="Click here to back to homepage"/>
			';
?>
	</div>
</div>

<?php include 'include/bottom.php' ?>
</body>
</html>

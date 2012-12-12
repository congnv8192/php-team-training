<?php	
	//connect to sever	
			mysql_connect("localhost","root","") 
			or die( 'Could not connect to  server: ' . mysql_error() );
			
	//select database to get data		
			mysql_select_db('ebook');
	
	// check available  input data  & assign variable for usename - password		
			if( isset($_POST['acc']) && isset($_POST['pass'])  ){
				$uname		= 	$_POST['acc'] ;
				$password	= 	$_POST['pass'];
	//get data users, passwords from database
				$select			= 	"SELECT user_id,account,`password`
										 FROM   user
										 WHERE	account	= '$uname' 
										 ";
				echo $select;
				$query			= 	mysql_query($select)
									or die( mysql_error() );				 
				$dbuser=mysql_fetch_array($query);
				$uid = $dbuser['user_id'];
				
				$seLECT = "SELECT user.user_id FROM user, is_admin WHERE user.user_id=is_admin.user_id AND user.user_id = $uid";

				$QUERY=mysql_query($seLECT) or die(mysql_error());

				
				//count the number of rows in  table  of database to  check data
				$usercount = mysql_num_rows($query);

				$admincount = mysql_num_rows($QUERY);

				//check login
				if( $usercount  ==  1){
					
					session_start();
					$_SESSION['acc']	=	$uname;
					$_SESSION['pass']	=	$password;
					$_SESSION['uid'] = $uid;
					
					header("location:user.php");
					
				}
				else {
					header("location:userloginwrong.php");
				}
			
			}
			else{
				header("location:usernormal.php");
				}
?>
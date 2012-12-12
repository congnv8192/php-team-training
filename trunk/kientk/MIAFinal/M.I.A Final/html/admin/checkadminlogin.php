<?php	
	//connect to sever	
			mysql_connect("localhost","root","") 
			or die( 'Could not connect to  server: ' . mysql_error() );
			
	//select database to get data		
			mysql_select_db('ebook');
	
	// check available  input data  & assign variable for usename - password		
			if( $_POST['adacc'] && $_POST['adpass']  ){
				$uname		= 	$_POST['adacc'] ;
				$password	= 	$_POST['adpass'];
				
	//get data users, passwords from database
				$select			= 	"SELECT * 
										 FROM   is_admin
										 WHERE	ad_account	=	'$uname' 
										 AND	ad_pass	=	'$password' ";
								 
				$query			= 	mysql_query($select)
									or die( mysql_error() );
				
				//count the number of rows in  table  of database to  check data
				$count			=	mysql_num_rows($query);
					
				//check login
				if( $count  ==  1 ){
					
					session_start();
					$_SESSION['adacc']	=	$uname;
					$_SESSION['adpass']	=	$password;
					header("location:admin.php");
					
				}
				else {
					header("location:adminloginwrong.php");
				}
			
			}
?>
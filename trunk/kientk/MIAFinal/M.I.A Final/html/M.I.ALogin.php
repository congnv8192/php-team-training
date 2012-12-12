<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>M.I.A Ebooks</title>
<link href="stylelog.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 

include 'include/topheader.php';
include 'include/clear.php';
include 'include/morelinks.php';

?>
<div class="item">
							<h5> Log In</h5>
							<div class="price">
								<p><span class="new">Welcome to </span><span class="old">M.I.A</span></p></br></br>

		<form action="checkuserlogin.php" method ="POST">
			Username: <input type="text" name="acc"></br></br>
			Password: <input type="password"name="pass"></br>
		</br>
                             
			<input type="submit" name="submit" value=" Log In ">
		
			<input type="reset" value=" Reset "></br></br>
			<a href= "M.I.ARegistration.php"><p>Click Here to Register an account!</p></a>
		</form>
							</div>
						</div>
					</div>
				</div>
<?php include 'include/bottom.php' ?>
</body>
</html>

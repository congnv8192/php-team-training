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
							<h5> Welcome to M.I.A eBooks</h5>
		<div class="price">
		  <p><span class="new">
          <?php 
		  if (isset($_SESSION['acc']))
		  	echo 'Welcome  </span><span class="old">'.$_SESSION['acc'].'  <a href="javascript:history.go(-2)">Click here to go back to your previous page</a>'; 
          else echo 'Your login was unsucessful or you have logout <a href="M.I.ALogin.php">Click here to login</a>'; ?>
          </span></p></br></br></br>
							</div>
						</div>
    </div>
				</div>
	  </div>
  </div>
  
  
  
 </div>
 
<?php include'include/bottom.php' ?>
 
</body>
</html>
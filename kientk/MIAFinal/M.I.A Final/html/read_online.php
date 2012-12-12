<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Processing Request</title>
</head>

<body>
<?php

	//$ROlink=$_GET['link'];
	$ROlink="resources/HarryPotter6.pdf";
	//$output='<p> link is:'.$ROlink.' </p>';
	echo "

	<form action='../web/viewer.html' method='get' >
		<!--<input type = 'hidden' name='rolink' value= ' $ROlink ' /> -->
        <input type = 'hidden' name='rolink' value= '../$ROlink' />
    	<input type= 'submit' onclick='this.form.submit' value = 'click here to read the book'/>
	</form>"
?>

</body>
</html>
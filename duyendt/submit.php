<html>
	<body>
		<?php
		echo'
		<form method="post" action="">
		  user name : <input type ="text" name="User name"><br>
		  pass : <input type="password" name="password">
		  <input type="submit" value="reset"/>
		  <input type="submit" value="submit">
		  <a href=""><p> you forget your password</p></a>
		</form>
		';
		$con=mysql_connect("localhost", "root", " ");
		if (!$con)
		    echo'can not connect database';
		mysql_select_db('conbo.com');
		
             
	?>
	</body>
</html>
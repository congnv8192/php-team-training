<html>
	<body>
		<?php
		if (isset($_POST['name'])){
			$name = $_POST['name'];
			$age= $_POST['age'];
			if (is_numeric($age)){
			
			$date = date("Y");
			$year = $date - $age;
			echo 'Hello '.$name." You was born in".$year;
			}
			else
				echo 'Nhap tuoi ngu nhu ***';
		}
		else{
			echo 'Hello world!';
			echo '
				<br/>
				<form method="post" action="">
					Your name:
					<input type="text" value="" name = "name"/>
					<br/>
					Age: 
					<input type="text" value="" name= "age"/>
					<input type="submit" value="Submit"/>
				</form>
			';
		}
		?>
	</body>
</html>
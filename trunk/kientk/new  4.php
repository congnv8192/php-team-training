<html>
	<body>
		<?php
			echo "Hajime mashite!";
			$time = date("H");
			$year = date("Y");
			echo $year;
			echo $time;
			if($time < 11)
			{
				echo "Ohayo gozaimasu";
			}
			elseif ($time > 11 and $time < 18)
			{
				echo "Konnichiwa";
			}
			else
			{
				echo "Kombanwa";
			}
		?>
	</body>
</html>

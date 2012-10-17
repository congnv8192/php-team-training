<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Magic Square</title>
</head>
<style>
	#header{
		text-align:center;
		width:800px;
		height:50px;
	}
	
	#body{
		background-image:url(images/background.jpg);
		width:800px;
		height: 530px;
	}
	
	#left{
		text-align:center;
		width:250px;
		float:left;
	}
	
	#right{
		text-align:left;
		width:550px;
		float:left;
	}
	
</style>
<body bgcolor="#D8F1F0">
<center>
	<?php 
		// DropDownMenu Builder
		// options here
		$opt = array(
			'3' => 3,
			'5' => 5,
			'7' => 7,
			'9' => 9,
			'Custom' => 10
		);
		// Generate selectmenu
		function selectGenerator($name = '', $options = array()){
			$html = '<select name = "'.$name.'" style="text-align:center">';
			foreach($options as $option => $value){
				$html.='<option value="'.$value.'">'.$option.'</option>';
			}
			$html .= '</select>';
			return $html;
		}
		
		$html = selectGenerator("Menu", $opt);
		
		// Magic Square Creater
		// init
		// input custom number
		function input(){
			?>
			<input type="text" name="inputDegree" value="11" >Input degree to display
			<?php
		}
		// get degree
		$degree = 0;
		if (isset($_POST['Menu']))
			$degree = $_POST['Menu'];
			
			
		function init($degree){
			if ($degree == 0)
				echo "Menu is available on the table! :D";
			else{
				if ($degree == 10)
					input();
				// init array
				$Arr = array();
				$num = 1;
				for ($i = 0; $i < $degree; $i++){
					for ($j = 0; $j < $degree; $j++){
						$Arr[$i][$j] = 0;
					}
				}
				// fill num 1
				$Arr[0][floor($degree/2)] = $num;
				return $Arr;
			}
		}
		
		// check if fullfilled
		function fullFilled($Arr= array()){
			global $degree;
			$flag = true;
			for ($i = 0; $i < $degree && $flag == true; $i++)
				for ($j = 0; $j < $degree; $j++)
					if ($Arr[$i][$j] == 0){
						$flag = false;
						break;
					}
			return $flag;
		}
		$initArr = init($degree);
		// fullfil
		function fullfill($Arr){
			global $degree;
			$num = 1;
			$horizon = 0;
			$vertical= floor($degree/2);
			while (!fullFilled($Arr)){
				$num++;
				$horizon--;
				$vertical++;
				
				if ($horizon < 0)
					if ($vertical >= $degree){
						$horizon += 2;
						$vertical--;
					}
					else
						$horizon = $degree - 1;
				else 
					if ($vertical >= $degree)
						$vertical = 0;
					else 
						if ($Arr[$horizon][$vertical] != 0){
							$horizon += 2;
							$vertical--;
						}	
				$Arr[$horizon][$vertical] = $num;
			}
		return $Arr;
		}
		$square = fullfill($initArr);
		// display square
		function disp($square = array()){
			global $degree;
			$disp = '<table border="1px" style="text-align:center">';
			for ($i = 0; $i < $degree; $i++){
				$disp .= '<tr>';
				for ($j = 0; $j < $degree; $j++){
					$disp .= '<td width="40px" height="40px">'.$square[$i][$j].'</td>';
				}
				$disp .= '</tr>';
			}
			$disp .= '</table>';
			return $disp;
		}
	?>
    <div id="header"><h1>MAGIC SQUARE</h1></div>
    <div id="body">
    	<div id="left">
        <div style="height: 460px"></div>
        <form method="post" action="">
            <?php echo $html; ?>
            <input type="submit" value="Display" />
        </form>
        </div>
        <div id="right">
        <?php 
        // display MS
            echo disp($square);
        ?>
        </div>
    </div>
</center>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php session_start(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Calender_ Demo</title>
</head>
<style type="text/css">

<!-- Code is complicated! Just to get familiar with PHP and CSS --!>
	body {
		font: 12px Arial, Helvetica, sans-serif;
		background: #ffffff url(images/main-bg.gif);
		padding: 0;
		margin: 0;
	}

	#container
	{
		width:960px;
		height:auto;
		margin:auto;
	}
	#header
	{
		width:98%;
		height:30px;
		margin-bottom:5px;
		padding:1%;
		border-bottom:2px solid #000;
		background-color: #666;
		text-align:center;
	}
	
	#left
	{
		width:20%;
		height:auto;
		margin:0;
		border-top:2px solid #000;
		float:left;
		padding:1%;
		background-color:#CCC;
	}
	
	#right
	{
		width:76%;
		height:auto;
		border-top:2px solid #000;
		padding:1%;
		float:left;
		background-color:#FFF;
	}
	
	#footer
	{
		width:98%;
		height:15px;
		padding:1%;
		margin-top:10px;
		border-top:2px solid #000;
		clear:both;
		background:#666;
		text-align:center;
	}
	
	#calender
	{
		width:550px;
		height:300px;
		padding:10px;
		border:1px solid #06C;
		border-radius:10px;
		-moz-border-radius:10px;
		-webkit-border-radius:10px;
	}
	
	#date
	{
		float:left;
		width:280px;
		height:260px;
		padding:10px;
		border:1px solid #999;
		border-radius:5px;
		-moz-border-radius:5px;
		-webkit-border-radius:5px;
	}
	
	#time
	{
		float:left;
		width:210px;
		height:260px;
		padding:10px;
		border:1px solid #999;
		border-radius:5px;
		-moz-border-radius:5px;
		-webkit-border-radius:5px;
	}
	
	h1 {
	font-size:24px;
	color: #0C0;
	line-height: 50px;
	margin:0px 20px 20px 20px;
	}
	
	.button{
		border:none;
		background-color: #FFF;
		font-size:10px;
		height:auto;
		width:32px;
	} 
</style>

<script language="javascript" type="text/javascript">
	function startTime()
	{
	var today=new Date();
	var h=today.getHours();
	var m=today.getMinutes();
	var s=today.getSeconds();
	// add a zero in front of numbers<10
	m=checkTime(m);
	s=checkTime(s);
	document.getElementById('dispTime').innerHTML=h+":"+m+":"+s;
	t=setTimeout('startTime()',500);
	}
	
	function checkTime(i)
	{
	if (i<10)
	  {
	  i="0" + i;
	  }
	return i;
	}
</script>
<body onLoad="startTime()">
	<center>
		<?php
		
		// read file for task
			$file = "data/Task.txt";
				if (file_exists($file)){
					$data = file($file);
					if (isset($data))
						foreach ($data as $line){
							$str = explode(":", $line);
							$task_day   = $str[0];
							$task_month = $str[1];
							$task_year  = $str[2];
							$task       = $str[3];
						}
				}
				else {
					die("Invalid file!");
				}
			
			// Set default date info
			
				$now = getdate();
				$Arr = array();
				$day = 0;
				$month = 0;
				$year = 0;
				$col = 0;
				$line = 0;
				$today_line = 0;
				$today_col = 0;
				$today = 0;
				
			// set hightlight current day
				$dispDay = $now["mday"];
				
				$dispMonth = intval($now["mon"]);
	
				$dispYear = $now['year'];
			
			// display month on the top
				function dispMonth($month){
					switch ($month){
						case 1:  echo "January";   break;
						case 2:  echo "February";  break;
						case 3:  echo "March";     break;
						case 4:  echo "April";     break;
						case 5:  echo "May";       break;
						case 6:  echo "June";      break;
						case 7:  echo "July";      break;
						case 8:  echo "August";    break;
						case 9:  echo "September"; break;
						case 10: echo "October";   break;
						case 11: echo "November";  break;
						case 12: echo "December";  break;
					}
				}
				
			// Set constraints
			
				// check day of month ---> return resetted day
				
				function checkDay(){
					global $day, $month, $col;
					//$month = $_SESSION['month'];
					$maxDay = get_maxDay($month);
								
					if ($day < 1){
						$month--; checkMonth();
						$maxDay = get_maxDay($month);
						$day = $maxDay;
						//------------------------
						unset($_SESSION['today_col_back']);
						$_SESSION['today_col_back'] = $col;
						//echo $col." ";
					}
					if ($day > $maxDay){
						$month++; checkMonth();
						$day = 1;
						//-------------------------
						unset($_SESSION['today_col_next']);
						$_SESSION['today_col_next'] = $col;
						//$_SESSION['today_next'] = $day;
					}
				}
				
				// check jday ---> Return resetted jday
				function checkCol(){
					global $col, $line;
					
					if ($col < 0){
						$line--;
						$col = 6;
					}
					if ($col > 6){
						$line++;
						$col = 0;
					}
				}
				
				// check month ---> return resetted month
				function checkMonth(){
					global $month, $year;
					if ($month < 1){
						$month = 12;
						$year--; if ($year < 40) $year = 40;
						//--------------------
						//unset($_SESSION['year']);
						//$_SESSION['year'] = $year;
					}
					if ($month > 12){
						$month = 1;
						$year++;
						//--------------------
						//unset($_SESSION['year']);
						//$_SESSION['year'] = $year;
					}
				}
				
			//--> Return max day of a month
				function get_maxDay($month){
					global $year;
					$year = $_SESSION['year'];
					
					switch ($month){
						case 1:
						case 3:
						case 5:
						case 7:
						case 8:
						case 10:
						case 12: return 31; 
								 break;
						case 4:
						case 6:
						case 9:
						case 11: return 30;
								 break;
						case 2: if(is_leapYear($year))
									 return 29;
								else 
									  return 28; 
								break;
								  
						// for debugging
						default: echo "is not numeric!"; break;
					}
				}
				
			// check if a leap year --> Return a boolean value
				function is_leapYear($year){
					if ($year % 4== 0)
						if ($year % 100 == 0)
							if ($year % 400 == 0)
								return true;
							else
								return false;
						else 
							return true;
					else 
						return false;	
				}
			
				// check for next
				if (isset($_POST['next'])){
						$year = $_SESSION['year']; 
						$month = $_SESSION['month']; 
						$month++; checkMonth(); 
						//------------------
						unset($_SESSION['month']);
						$_SESSION['month'] = $month;
						//------------------
						unset($_SESSION['year']);
						$_SESSION['year'] = $year;
						$today_col = $_SESSION['today_col_next']; 
						
						//------------------
						unset($_SESSION['today_col_next']);
						$_SESSION['today_col_next'] = $today_col;
						//echo $today_col;
						$today = 1;
						$today_line = 0;
						//$today_month = $_SESSION['today_month']; $_SESSION['today_month'] = $today_month;
				}
				else 
				// check for back
					if (isset($_POST['back'])){
							$year = $_SESSION['year']; 
							$month = $_SESSION['month']; 
							$month--; checkMonth(); 
							//echo $month;
							//------------------
							unset($_SESSION['month']);
							$_SESSION['month'] = $month;
							//------------------
							unset($_SESSION['year']);
							$_SESSION['year'] = $year;
							$today_col = $_SESSION['today_col_back']; 
							
							//------------------
							unset($_SESSION['today_col_back']);
							$_SESSION['today_col_back'] = $today_col;
							//echo $today_col;
							$maxDay = get_maxDay($month);
							$today = $maxDay;
							$today_line = 5;
							//$today_month = $_SESSION['today_month']; $_SESSION['today_month'] = $today_month;
					}
						// First run
						else {
							
							// get today_jday
							$jday_today = Date("D");
							//---> changing to column in table
							switch ($jday_today){
								case "Mon": $today_col= 0; break;
								case "Tue": $today_col= 1; break;
								case "Wed": $today_col= 2; break;
								case "Thu": $today_col= 3; break;
								case "Fri": $today_col= 4; break;
								case "Sat": $today_col= 5; break;
								case "Sun": $today_col= 6; break;
								
								// for debugging
								default: echo "input error!";
							}
						
						
							// get date info
							$today = $dispDay;
							
							$month = $dispMonth;
							
							//-----------------------
							$_SESSION['month'] = $month;
							$year = $dispYear;
							
							//-----------------------
							$_SESSION['year'] = $year;
							
							// find the jday of 1st of each month
							$st_col = ($today_col - ($today - 1) % 7) % 7;
							while ($st_col < 0){
								$st_col += 7;
							}
						
							// find the line of today
							$today_line = floor(($st_col + $today - 1)/7);
					}
				
		// Calculate Display

			// fill left side of today
			function fillLeft(){
				global $today_line, $today_col, $today, $Arr, $line, $col, $day;
				
				$line = $today_line;
				$col = $today_col; checkCol();
				$day = $today;
				
				//echo $today_line." ".$line." ".$col;
				while (!(($line == 0) && ($col == 0))){
					$Arr[$line][$col]= $day;
					$col--; checkCol();
					$day--; checkDay();
				}
				$Arr[0][0] = $day;
				
			}
			
			// fill right side of today
			
			function fillRight(){
				global $today_line, $today_col, $today, $Arr, $line, $col, $day;
				
				$line = $today_line;
				$col = $today_col + 1; checkCol();
				$day = $today + 1; checkDay();
				if ($line < 6){ // handle error on day 31 at line 5 col 6
					while (!(($line == 5) && ($col == 6))){
						$Arr[$line][$col]= $day;
						$col++; checkCol();
						$day++; checkDay(); 
					}
					$Arr[5][6] = $day;
				}
			}	
			
			// Implement
			fillLeft();
			$month = $_SESSION['month'];
			fillRight();
			$month = $_SESSION['month'];
			$year  = $_SESSION['year'];
			?>
 		
        <div id="container">
        	<div id="header">
				<h1>CALENDER</h1>
            </div>
            <br /><br />
            <div id="left">
            	<h3 style="font-family:Arial, Helvetica, sans-serif"> Note </h3>
                <form>
                <div style="background-color:#FFC; height:200px; width:80%">
                	<input type="text" style="width:95%"/>hehe
                </div>
                	<input type="submit" value="Add" />
                	<input type="submit" value="Delete" />
                </form>
            </div>
            <div id="right">
            	<div id="calender">
                	<center>
                    <div id="date">
                        <form action="" method="post">
                            <p> <input type="submit" name="back" value="<" />
                                <?php echo dispMonth($month)." , ".$year; ?>
                                <input type="submit" name="next" value=">" />
                            </p>
                            <br />
                            <table border="0" cellpadding="2" cellspacing="2" align="center">
                            <tr style="background-color:#666; text-align:center; color:#FFF">
                                <td>M</td>
                                <td>T</td>
                                <td>W</td>
                                <td>T</td>
                                <td>F</td>
                                <td>S</td>
                                <td>S</td>
                            </tr>
                            <?php 
                            $i = 0;
                            $j = 0;
							$flag = true; // disable valid
                            for ($i = 0; $i < 6; $i++){
                                echo "<tr>"; 
								
								// disable button
                                for ($j = 0; $j < 7; $j++){
                                    if ($Arr[$i][$j] == 1) 
										if ($flag == true) 
											$flag = false; 
										else
											$flag = true;
                                    ?>
                                    <td><input type="button"
                                                class="button" 
												<?php
												
												// check for task--> colorize buttons
												 if ($task_day == $Arr[$i][$j] && $task_month == $month && $task_year == $year){
													 echo "style=\"color: #00F\"";
												 }
												 
												// check if current dd/mm/yyy
												if (isset($dispDay))
													if ($Arr[$i][$j] == $dispDay && $month == $dispMonth && $year == $dispYear && $flag == false)
														echo "style=\"background-color:#F00\""; 
													else
														echo "
															onmouseover=\"this.style.background='red'\" 
															onmouseout=\"this.style.background='transparent'\"
														";
														
												// disable button 
												if ($flag) echo "disabled"; ?> 
                                                 value="<?php echo $Arr[$i][$j]; ?>" /></td><?php
                                }
                                echo "</tr>";
                            }
							?>
                            </table>
                        </form>
                    </div>
                    <div id="time">
                    	<img height="190" width= "70%" src="images/About_shinichi_kudo.jpg" alt="Nguyen Van Cong">
                    	<img src="images/Clock.gif" width="90%" height="20">
                    	<div id="dispTime" style="text-align:center; font-size:27px; background-color: #33FFFF; width:90%"></div>
                    </div>
                   	</center>
                </div>
            </div>
        	<div id="footer"> By Little_Bee</div>
        </div>
        
	</center>
</body>
</html>

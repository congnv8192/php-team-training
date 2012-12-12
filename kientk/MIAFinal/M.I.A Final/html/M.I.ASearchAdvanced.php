<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>M.I.A Ebooks</title>
<link href="stylelog.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
// hien thi mac dinh
// ket noi voi database server
$con=@mysql_connect('localhost','root','');
if (!$con) {exit('<p> unable to connect to the dbank at this time</p>');
}

//dinh dang kieu font chu
mysql_query("SET character_set_results=utf8", $con);
mb_language('uni');
mb_internal_encoding('UTF-8');

$db=mysql_select_db('ebook',$con);

mysql_query("set names 'utf8'",$con);

if (!$db){
exit ('<p> unable to connect to the db at this time</p>');
}

mysql_query("set names 'utf8'",$con);

if (!$db){
exit ('<p> unable to connect to the db at this time</p>');
}


?>
<?php
include 'include/topheader.php';
include 'include/clear.php';
include 'include/morelinks.php';

//no error notice
error_reporting(E_ALL ^ E_NOTICE);

?>
						<div class="item">
							<h5>Search Advanced</h5>
							<div class="price">
							  <form action="M.I.ASearchAdvanced.php" method="get">
                              	  <div id="trai">Title: </div>
                              	  <input type="text" name="title" ></br></br>
									<div id="trai">Author: </div><input type="text" name="author" ></br></br>
        							<div id="trai">Category :</div>
										<input type="checkbox" name="Adventure" value='1'>Adventure
										<input type="checkbox" name="Romance" value='1'>Romance
										<input type="checkbox" name="Comic" value='1'>Comic
										<input type="checkbox" name="Detective" value='1'>Detective
										<input type="checkbox" name="Thriller" value='1'>Thriller
										<input type="checkbox" name="Novel" value='1'>Novel 
										<input type="checkbox" name="Drama" value='1'>Drama
										<input type="checkbox" name="Other" value='1'>Other</br>
                                    <div id="trai">Money(purchase) :</div>
                                    <select name="money">
                                    	<option value="1950-1990">5-10$</option>
										<option value="1991-1995">11-15$</option>
                                        <option value="1995-2000">15-20$</option>
                                        <option value="2001-2005">>20$</option>
                                    </select></br>
                                    <div id="trai">
                                    	<input type="submit" value="Search" onclick="this.form.submit" name="Submit1">
                                    </div><input type="reset" value=" Reset ">
                              </form></br>
                       		</div>
			    		  </div>
                      </div>
                    </div>

 
 <?php
 	//capture input
 	$firstcat=1;
 	$se_title=$_GET["title"];
	$se_author=$_GET['author'];
	$catck[0]=$_GET['Adventure'];
	$catck[1]=$_GET['Comic'];
	$catck[2]=$_GET['Detective'];
	$catck[3]=$_GET['Drama'];
	$catck[4]=$_GET['Novel'];
	$catck[5]=$_GET['Other'];
	$catck[6]=$_GET['Romance'];
	$catck[7]=$_GET['Thriller'];
	
	
	// get category
	$catname;
	$i=0;
	$catresult=mysql_query('SELECT category_alias FROM category');
	while ($catfetch=mysql_fetch_array($catresult)){
		$catname[$i]=$catfetch['category_alias'];

		$i++;
	}
	$i=0;
	$query='SELECT title,author,price,release_date,category_name FROM `book`,`fit_category(r)`,category WHERE ';
	if ($se_title!='')
	$query.='book.title LIKE \'%'.$se_title.'%\' AND ';
	
	if ($se_author!='') 
	$query.='book.author LIKE "%'.$se_author.'%" AND ';
	
	$query.='book.id=`fit_category(r)`.`book_id` AND category.category_alias=`fit_category(r)`.`category_alias`';

	
	for ($j=0; $j<8; $j++)
	{
		if ($catck[$j]==1)
			{
					if ($firstcat==1){
					
						$query .=" AND ( `fit_category(r)`.`category_alias`='".$catname[$j]."' ";
						$firstcat=0;
					
						}
					else $query.=" OR `fit_category(r)`.`category_alias`='".$catname[$j]."' ";
					$query.=')';
			}

	}
	$query.=' GROUP BY book.id';
	
	echo '<b> Echoed query is:'.$query.' </b>';
	$result=mysql_query($query);
	
	//query found book
	
	while ($row=mysql_fetch_array($result)){
			
			if ($se_title=$row['title']){
			echo '<br/>Result is'.$se_title;
			}
	}
	
	
	//$result=mysql_query();
?>
 
<?php include 'include/bottom.php' ?>
</body>
</html>

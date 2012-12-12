<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
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

//$db=mysql_select_db('ebook',$dbcnx));
$db=mysql_select_db('ebook',$con);

mysql_query("set names 'utf8'",$con);

if (!$db){
exit ('<p> unable to connect to the db at this time</p>');
}
 
 $user_id=$_GET['user_id'];
 
 $userrow=mysql_query('SELECT user_id, account FROM user WHERE user_id='.$user_id);

 $user=mysql_fetch_array($userrow);
 echo $user['account'];
 ?>'s favorite books</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>


<?php 

include 'include/topheader.php';
include 'include/clear.php';
include 'include/morelinks.php';

?>

<?php

error_reporting(E_ALL ^ E_NOTICE);

$categoryquery=('SELECT id,title,price,img_link,author,read_online_link, category.category_name FROM book LEFT JOIN `fit_category(r)` ON `fit_category(r)`.book_id=book.id LEFT JOIN category ON category.category_alias = `fit_category(r)`.category_alias ORDER BY book.title');



$result=mysql_query("SELECT book.id,title,price,img_link,author,read_online_link FROM book,`favorite_book_list(r)`,user WHERE user.user_id=".$user_id." AND book.id=`favorite_book_list(r)`.book_id");

if (!$result) die ('invalid query: '.mysql_error());

//$hasData=0;
if (mysql_fetch_array($result)=='') echo '<div clsss = "item"><h5 style="font-size:15px">You have no book in your favorite list. We are very sory for this inconvenience. Please consider getting a book to our site.</h5></div>';
else{
	mysql_data_seek($result,0);

	while ($row=mysql_fetch_array($result))
	{	
		//if (isset(mysql_fetch_array($result)['id'])){
		//$hasData=1;
		$bkid=$row[0];
		$title=$row['title'];
		$price=$row['price'];
		$img_link=$row['img_link'];
		$author=$row['author'];
		$ROlink=$row['read_online_link'];
		
	echo'
  			<div class="item">
							<h5>' . $title . '</h5>
							<div class="itemimage">
								<a href="M.I.ABookDetails.php?id='.$bkid.'"><img src="' .$img_link. '" alt="" width="150" height="159" /></a><br />
								<p class="more"><a href="M.I.ABookDetails.php?id='.$bkid.'">more info</a></p>
							</div>
							<div class="price">
								<p><span class="new">$'.$price.'</span><span class="old">'.$author.'</span></p><br />
								<p>';
	$row1query=mysql_query($categoryquery);

	while ($row1=mysql_fetch_array($row1query)){
		$idcatquery=$row1['id'];
		$cat=$row1['category_alias'];
		//echo 'catquery is: '.$idcatquery;
		if ($idcatquery == $bkid)// && !isset($cat))
		echo $row1['category_name'].", ";
	}
	echo												'<br />
								<form action="#" class="button">
									<a href="#"><img src="images/buy.png" alt="" width="53" height="23" /></a>
								</form>
                                <form action="#" class="button">
									<a href="../web/viewer.php?link=../'.$ROlink.'"> <img src="images/read online.png" alt="" width="53" height="23" /></a>
								</form>
                                <form action="#" class="button">
									<a href="LikeBook.php?bookid='.$bkid.'"><img src="images/addfavor.png" alt="" width="53" height="23" /></a>
								</form>
							</div>
						</div>';
		}
	}

?>
<?php include'include/bottom.php' ?>
</body>
</html>

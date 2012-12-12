<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>M.I.A Ebooks</title>
<link href="styleusermanage.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 

include 'include/topheader.php';
include 'include/clear.php';
include 'include/morelinks.php';

?>  		
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

//process data

$user_id=3;
$id=$_GET['bookid'];
$result=mysql_query("SELECT * FROM book WHERE book.id=".$id);

if (!$result) die ('invalid query: '.mysql_error());

while ($row=mysql_fetch_array($result))
	{
		//$book_id=$row['id'];
		/*
			Refer to the database ebook table book for details of order of fields
			noticeable fields order: 1:title, 6: publisher_alias
		*/
		$C1=$row[1];
		$C2=$row[2];
		$C3=$row[3];
		$C4=$row[4];
		$C5=$row[5];
		$C7=$row[7];
		$C9=$row[9];
		
		$publisherquery=mysql_query("SELECT publisher.alias,publisher.name FROM publisher,book WHERE publisher.alias=book.published_by AND publisher.alias = '$C5'");// ".$title);
		
		$categoryquery=('SELECT id, category.category_name FROM book LEFT JOIN `fit_category(r)` ON `fit_category(r)`.book_id=book.id LEFT JOIN category ON category.category_alias = `fit_category(r)`.category_alias ORDER BY book.title');
		
		$getpub=mysql_fetch_array($publisherquery);
		$getname=$getpub['name'];
		$C6=$row[6];
		echo '<div class="item">

			<h5>'.$C1.'</h5>
			<div class="itemimage">
			<a href=""><img src="'.$C9.'" alt="" width="150" height="159" /></a>
			</div>
			<div class="price">
            	<pre>	
Author:	'.$C2.'
Release Date:	'.$C3.'
Release Cert.:	'.$C4.'
Publisher:	'.$getname.'
Price:	$'.$C7.'
Upload Date:	'.$C6.'

                </pre>
You have liked this book.</div></div>';
	}
$insert="INSERT IGNORE INTO `favorite_book_list(r)`(`user_id`, `book_id`) VALUES ($user_id, $id);";
mysql_query($insert);
				?>
          <a style="color:#FF0; font-style:normal; text-decoration:none;" href='M.I.AHome.php'>Click here to return to home page</a> or press back on the browser to go back to the previous page

			</div>
  		</div>
  	  </div>		
    </div>

<?php include 'include/bottom.php' ?>

</body>
</html>

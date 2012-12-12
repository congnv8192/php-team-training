<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Remove Book: <?php echo $_GET['title'] ?></title>
<link href="stylebookdetail.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 

include 'include/topheader.php';
include 'include/clear.php';
include 'include/morelinks1.php';

?>
  		

<?php
// hien thi mac dinh
// ket noi voi database server
$con=@mysql_connect('localhost','root','');
if (!$con) {exit('<p> unable to connect to the dbank at this time</p>');
}

$user_id=$_SESSION['uid'];

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

$categoryquery=('SELECT id, category.category_name FROM book LEFT JOIN `fit_category(r)` ON `fit_category(r)`.book_id=book.id LEFT JOIN category ON category.category_alias = `fit_category(r)`.category_alias ORDER BY book.title');


$id=$_GET['bkid'];
$result=mysql_query("SELECT * FROM book WHERE book.id=".$id);
if (!$result) die ('invalid query: '.mysql_error());

while ($row=mysql_fetch_array($result))
	{

		$C1=$row[1];
		$C2=$row[2];
		$C3=$row[3];
		$C4=$row[4];
		$C5=$row[5];
		$C7=$row[7];
		$C9=$row[9];
		
		$publisherquery=mysql_query("SELECT publisher.alias,publisher.name FROM publisher,book WHERE publisher.alias=book.published_by AND publisher.alias = '$C5'");

		$getpub=mysql_fetch_array($publisherquery);
		
		$getname=$getpub['name'];
		
		$getcat=mysql_query($categoryquery);

		
		$C6=$row[6];
		echo '
		<div class="item">
			<h5>'.$C1.'</h5>
			<div class="itemimage">
			<a href=""><img src="'.$C9.'" alt="" width="150" height="159" /></a>
			</div>
			<div class="price">
            	<pre>	
Author:	'.$C2.'
Category:';
		while ($cat=mysql_fetch_array($getcat))
		{
			echo $cat['category_name'];
		}
echo'
Release Date:	'.$C3.'
Release Cert.:	'.$C4.'
Publisher:	'.$getname.'
Price:	$'.$C7.'
Upload Date:	'.$C6.'

<p>do you want to remove this book?
';
	}

?>

<!--	<script type="text/javascript">
		function RemoveBook(){
			if (document.getElementById('yes').value=1{

		}
	</script>--><input type="button" id="yes" value="Yes" onclick="location.href='deletebook.php?bkid=<?php echo $id ?>'"  /><input type="button" value="No" onclick="history.go(-1)'"  /></p>
                </pre>
				</div></div>

<?php include 'include/bottom.php' ?>

</body>
</html>

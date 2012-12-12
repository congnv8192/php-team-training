<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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

 $user_id=$_SESSION['uid'];
 
 $userrow=mysql_query('SELECT user_id, account FROM user WHERE user_id='.$user_id);

 $user=mysql_fetch_array($userrow);
?>
 
	<title> <?php echo $user['account']?>'s Bookshelf</title>
<link href="styleusermanage.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php 

include 'include/topheader.php';
include 'include/clear.php';
include 'include/morelinks1.php';

?>
  
<?php

// select category query
$categorybookquery=('SELECT id,title,category.category_name,category.category_alias FROM book LEFT JOIN `fit_category(r)` ON `fit_category(r)`.book_id=book.id LEFT JOIN category ON category.category_alias = `fit_category(r)`.category_alias ORDER BY book.title');

$catnamequery=("SELECT `category_alias`, `category_name` FROM `category`");

$bookshelfquery=mysql_query("SELECT id,title,price,img_link,author,read_online_link,release_date,upload_date,published_by,release_certificate FROM book,user,`bookshelf(r)` WHERE `bookshelf(r)`.user_id=user.user_id AND `bookshelf(r)`.book_id=book.id AND user.user_id=$user_id");

$privilegequery=mysql_query("SELECT user.`user_id`, `reupload`, `download`, `edit`, `remove`, `exchange_ownage` FROM `privilege(+r)`, user WHERE user.user_id = `privilege(+r)`.user_id AND user.user_id = $user_id");
//echo 'SELECT user.`user_id`, `reupload`, `download`, `edit`, `remove`, `exchange_ownage` FROM `privilege(+r)`, user WHERE user.user_id = `privilege(+r)`.user_id AND user.user_id = $user_id';

$privilege=mysql_fetch_array($privilegequery);
$download=$privilege['download'];
$reupload=$privilege['reupload'];
$edit=$privilege['edit'];
$remove=$privilege['remove'];
$exchange_ownage=$privilege['exchange_ownage'];

while ($array=mysql_fetch_array($bookshelfquery)){
		$id=$array['id'];
		$title=$array['title'];
		$price=$array['price'];
		$img_link=$array['img_link'];
		$author=$array['author'];
		$publisher=$array['published_by'];
		$read_online_link=$array['read_online_link'];
		$release_date=$array['release_date'];
		$release_cert=$array['release_certificate'];
		$upload_date=$array['upload_date'];
		
		$publisherquery=mysql_query("SELECT publisher.alias,publisher.name FROM publisher,book WHERE publisher.alias=book.published_by AND publisher.alias = '$publisher'");
			
		$getpub=mysql_fetch_array($publisherquery);
		
		$getname=$getpub['name'];
		
		$getbookcat=mysql_query($categorybookquery);

		
		$C6=$array[6];
		echo '
		<div class="item">
			<h5>'.$title.'</h5>
			<form action="M.I.AUserManageEdit.php" method="post">
				<div class="itemimage">
					<a href=""><img src="'.$img_link.'" alt="" width="150" height="159" /></a>
				</div>
				<div class="price">
            		<pre>	
Author:	<input type ="text" name="author" value="'.$author.'"/>
Category: ';
		$catnameget=mysql_query($catnamequery);
		while ($catlist=mysql_fetch_array($catnameget)){
			$catname=$catlist['category_name'];
			$catalias=$catlist['category_alias'];
			echo '<input type = "checkbox" name="'.$catname.'" value="'.$catalias.'"';
			while ($bookcat=mysql_fetch_array($getbookcat)){
				if ($id==$bookcat['id'] && isset($bookcat['category_alias'])&& $bookcat['category_alias']==$catalias)
						echo 'checked="checked"/>';
			}
			 echo('/>'.$catname);
		}
echo'
Release Date:	<input type ="text" width=\'100px\' name="author" value="'.$release_date.'"/>
Release Cert.:	<input type ="text" width=90% name="author" value="'.$release_cert.'"/>
Publisher:	<input type ="text" width=\'100px\' name="author" value="'.$getname.'"/>
Price:		<input type ="text" width=90% name="author" value="$'.$price.'"/>
Upload Date:	'.$upload_date.'
                </pre>';
	if ($download==1) echo'<input type="button" value="Download" onclick="window.location.href=\'../'.$read_online_link.'\'" />&nbsp;';
	else echo'<input type="button" value="Download" onclick="window.location.href=\'../'.$read_online_link.'\'" disabled />&nbsp;';
	
	if ($edit==1) echo'<input type="submit" value="Edit" onclick="this.form.submit"/>&nbsp;';
	else echo'<input type="submit" value="Edit" onclick="this.form.submit" disabled/>&nbsp;';

	if ($reupload==1) echo'<input type="submit" value="Reupload" />&nbsp;';
	else echo'<input type="submit" value="Reupload" disabled />&nbsp;';
	
	if ($remove==1) echo'<input type="button" value="Remove" onclick="window.location.href=\'RemoveBook.php?bkid='.$id.'&title='.$title.'\'" />&nbsp;';
	else echo'<input type="submit" value="Remove" disabled />&nbsp;';
	
	if ($exchange_ownage==1) echo'<input type="submit" value="Exchange Ownage">&nbsp;';
	else echo'<input type="submit" value="Exchange Ownage" disabled>&nbsp;';
/*                            <input type="submit" value="Edit" onclick="window.location.href=\'BookEdit.php?bkid='.$id.'\'">&nbsp;
                            <input type="submit" value="Remove">&nbsp;
                            <input type="submit" value="Exchange Ownage">&nbsp;*/
                            
	echo '</div></div>';
}
?>

<?php include'include/bottom.php' ?>
</body>
</html>

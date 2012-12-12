<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>M.I.A Ebooks</title>
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


$id=$_GET['id'];
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
                </pre>
				</div></div>';
	}
				?>
                
<?php
	
	$reviewquery=("SELECT `review`.`id`, user.user_id, user.avatar, `book_id`, user.fullname, `review`.`title`, `rating`, `content`, `review_date`  
				   FROM `review`,`reviewer`,`user` 
				   WHERE user.user_id = review.`reviewer_id` = reviewer.user_id AND book_id=$id ORDER BY review.id");
	$reviewarray=mysql_query($reviewquery);
	
	if (mysql_fetch_array($reviewarray)=='')
		echo 'This book currently has no review, please consider writing one yourself';
	else{
		mysql_data_seek($reviewarray,0);
		while ($review=mysql_fetch_array($reviewarray)){
			$rev_id=$review['id'];
			$rev_title=$review['title'];
			$rever_id=$review['user_id'];
			$rever_name=$review['fullname'];
			$rev_date=$review['review_date'];
			$content=$review['content'];
			$rev_rating=$review['rating'];
			$user_avatar=$review['avatar'];
			echo'
			<div class="item" style="height:auto">
			  <h5 style="width:700px;">'.$rev_title.'</h5>
				<div class="itemimage">
					<a href="#"><img src="'.$user_avatar.'" alt="" width="150" height="159" /></a><br />
				</div>
				<div class="price" style="padding-left:10px;">
						<div id="trai"><p style="color:#FFF">Reviewer:'.$rever_name.'</p></div></br></br>
                		<br/><div id="trai">Rating: '.$rev_rating.'/5</div>
							<div style="width:800px;">Content:
							<pre style="max-width:200px;">
'.$content.'
							</pre>
							</div>

					</p>
				</div>
			</div>';
		}
	}
?>
<?php

	$selectuser=mysql_query("SELECT `user_id`, `fullname`, `account`, `avatar` FROM `user` WHERE user_id=$user_id");
	$user=mysql_fetch_array($selectuser);
	$user_name=$user['fullname'];
	$account=$user['account'];

?>
  <div class="item">
  	<form>
		<h5>Your review: &nbsp <input type="text" value="Click here to name your review" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Click here to name your review':this.value;" style="height:20px; width:45%;background-color:transparent; color:#FFF" /></h5>
			<div class="itemimage">
				<a href="#"><img src="<?php echo $user['avatar'] ?>" alt="" width="150" height="159" /></a><br />
			</div>

			<div id="trai" style="padding-left:10px;font-size:14px">
            	<p style="color:#FFF">Author: <?php echo $user_name ?>(<?php echo $account ?>)</p></div>
	        <div id="trai">Rating :
		        <select name="Quantity">
					<option value="1/5">1/5</option>
					<option value="2/5">2/5</option>
            		<option value="3/5">3/5</option>
		            <option value="4/5">4/5</option>
    		        <option value="5/5">5/5</option>
        		</select></div>
	        Your Idea:<br />
			  	<textarea cols="70" name="MyTextBox" rows="4" wrap="on" style="background:#eee; color:#464646; border:1px #A0C4EA dashed;" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Write you comment here':this.value;">
Write your comment here
				</textarea>
			<br/>
            <input type="submit" value="  Add  " onclick="this.form.submit"></br></br>
	</form>

                         
                            
                            
							</div>
</div>


			</div>
  		</div>
  	  </div>		
    </div>

<?php include 'include/bottom.php' ?>

</body>
</html>

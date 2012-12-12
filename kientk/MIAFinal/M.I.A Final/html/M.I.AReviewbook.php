<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>M.I.A Ebooks</title>
<link href="styleusermanage.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
$dbcnx=@mysql_connect('localhost','root','');
if (!$dbcnx) {exit('<p> unable to connect to the db at this time</p>');
}
//$db=mysql_select_db('ebook',$dbcnx));
if (!mysql_select_db('ebook',$dbcnx)){
exit ('<p> unable to connect to the db at this time</p>');
}


$result=mysql_query("SELECT id,title,price,img_link,author,read_online_link FROM book,`fit_category(r)` WHERE `fit_category(r)`.book_id=book.id AND `fit_category(r)`.category_alias = ".$_GET['cat']);
?>

<form id="form1" name="form1" method="post" action="">
 <div id="topheader">
   <div class="topmenu_area"><a href="M.I.AHome.html" class="home">Home</a> <a href="#" class="about">About</a> <a href="M.I.ASearchAdvanced.html" class="search">Search</a> </div>
   <div class="banner_textarea">
     <p class="banner_head">
     
   </div>
   <div class="search_menu_banner">
     <div class="search_background">
       <div class="searchname">Search</div>
       <div class="searchbox">
         <label>
         <input name="textfield" type="text" class="searchtextbox" />
         </label>
       </div>
       <div class="searchbox">
         <div align="center"><a href="#" class="go">go</a></div>
       </div>
     </div>
     <div class="menu_area"><a href="M.I.AHome.html" class="addidea"> Home</a> <a href="#" class="loginhere">Read Online</a> <a href="#" class="comments">Category</a> <a href="M.I.ALogin.php" class="contact">Log In </a></div>
   </div>
 </div>
 <div id="body_area">
 
 <div id="main">

			<div class="clear"></div>

			<form>
				<div id="slide">					
					<input type="radio" id="image1" name="slide" class="input" checked/>
					<label for="image1" class="label" id="button1"></label><!--button 1-->

					
					<input type="radio" id="image2" name="slide" class="input"/>
					<label for="image2" class="label" id="button2"></label><!--button 2-->

					
					<input type="radio" id="image3" name="slide" class="input"/>
					<label for="image3" class="label" id="button3"></label><!--button 3-->

					
					<input type="radio" id="image4" name="slide" class="input"/>
					<label for="image4" class="label" id="button4"></label><!--button 4-->

					
					<div id="slide_wrap">
						<img src="images/alitreoftears.jpg" width="940" height="300" />
						<img src="images/rungnauy.jpg" width="940" height="300" />
						<img src="images/callofthewild.jpg" width="940" height="300" />
						<img src="images/khong gia dinh.jpg" width="940" height="300" />
					</div><!--slide--->
					
					<h1 id="text1">A Litre Of Tears</h1><!--text cho ?nh 1-->

					<h1 id="text2">Norwegian Wood</h1><!--text cho ?nh 2-->

					<h1 id="text3">The Call Of The Wild</h1><!--text cho ?nh 3-->

					<h1 id="text4">Sans Famille</h1><!--text cho ?nh 4-->
				</div>
			</form>		
		</div><!--main-->
  <div class="body_area1"><br/>
  <div id="center">
    <div id="items">
  		<div class="item">
        
<?php

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
			<h5>'.$C1.'</h5>
			<div class="itemimage">
			<a href=""><img src="'.$C9.'" alt="" width="150" height="159" /></a>
			</div>
			<div class="price">
            	<pre>	
Author:	'.$C2.'</br>
Category:';
		while ($cat=mysql_fetch_array($getcat))
		{
			echo $cat['category_name'];
		}
echo'
Release Date:	'.$C3.'</br>
Release Cert.:	'.$C4.'</br>
Publisher:	'.$getname.'</br>
Price:	$'.$C7.'</br>
Upload Date:	'.$C6.'
                </pre>';
	}
				?>

<?php
	echo'
			<h5>Tittle</h5>
				<div class="itemimage">
					<a href="#"><img src="images/memorial.jpg" alt="" width="150" height="159" /></a><br />
				</div>
				<div class="price">
					<p style="color:#FFF">Author</p></br></br>
                		<form action="M.I.AReviewbook.php"><div id="trai">Rating: </div>
							<select name="Quantity">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select> over 5 <br/>
							Comment:
							<textarea cols="70" name="MyTextBox" rows="4" wrap="on" style="background:#eee; color:#464646; border:1px #A0C4EA dashed;">
							</textarea>		<br/>
					
                			<input type="submit" value="  Add  " onclick="this.form.submit"></br></br>
                        </form>
					</p>
				</div>';
?>
</div>
    </div>
  </div>
							
    </div>
	</div>
</div>
  </div>
  
  
  
 </div>
 
 
 
 
<div class="body_areabackground">
<div id="body_area1">
  <div class="inner_tabarea">
    <div class="inner_menu">
      <div align="center"><a href="#" class="innermenu_hover">Lien He</a> <a href="#" class="innermenu">Quang Cao</a> <a href="#" class="innermenu">M.I.A Team</a>  </div>
    </div>
    <div class="tab_text">
      <p class="tab_head">ON 26th OCTOBER 2012</p>
      <p><span class="tab_head1">New Releases Free Online Reading</span><br />
        </p>
      </div>
    <div class="tab_readmore">
      <p align="right" class="tab_head"><a href="#" class="readmore">Read More </a></p>
      </div>
    <div class="tab_text">
      <p><span class="tab_head1">Free Upload Books</span><br />
        Share books with Friends</p>
    </div>
    <div class="tab_readmore">
      <p align="right" class="tab_head"><a href="#" class="readmore">Read More </a></p>
    </div>
  </div>
  <div class="login_area">
    <div class="login_head">Already a Member ?</div>
    <div class="login_textarea">
      <div class="login_name">Your Name </div>
      <div class="login_box">
        <label>
        <input name="textfield2" type="text" class="logintextbox" />
        </label>
      </div>
    </div>
    <div class="login_textarea">
      <div class="login_name">Password </div>
      <div class="login_box">
        <label>
        <input name="textfield22" type="password" class="logintextbox" />
        </label>
      </div>
    </div>
    <div class="login_textarea"><a href="#" class="register">Get Registration Now</a> <a href="#" class="login">Login</a> </div>
  </div>
  <div class="toolfree_area">
    <div class="call_free"><span class="callus">Call Us</span> <span class="callno">01244280086</span></div>
    <div class="bookmark">Add Books in Favorite</div>
    <div class="facing"></div>
  </div>
</div></div>
 <div id="fotter">
   <div id="fotter_1">
     <div class="fotter_leftarea">
       <div class="fotter_links">
         <a href="#" class="fotterlink">Home</a>  |  <a href="#" class="fotterlink">About Us</a>  |  <a href="#" class="fotterlink">M.I.A EBooks</a>  |  <a href="#" class="fotterlink">Category</a>  |  <a href="#" class="fotterlink">Drama</a>  |  <a href="#" class="fotterlink">Novel</a>  |  <a href="#" class="fotterlink">Thriller</a>  |  <a href="#" class="fotterlink">Detective</a> </div>
       <div class="fotter_designed">Designed by: <a href="#" class="fotter_designedlink">Kien - M.I.A</a> </div>
      </div>
     <div class="fotter_rightarea">
       <div class="fotter_validation"><a href="#" class="validation">Ebooks</a> <a href="#" class="validation">M.I.A</a></div>
       <div class="fotter_copyrights">Copyright 2012<br /> 
        Team M.I.A [Hai - leader]
<br/>
Km 9, Nguyen Trai, Thanh Xuan, Ha Noi        </div>
     </div>
   </div>
     </div>
</form>
</body>
</html>

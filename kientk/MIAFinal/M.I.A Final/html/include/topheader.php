<form id="form1" name="form1" method="post" action="">
 <div id="topheader">
   <div class="topmenu_area"><a href="M.I.AHome.php" class="home">Home</a> <a href="M.I.AAboutus.php" class="about">About</a> <a href="M.I.ASearchAdvanced.php" class="search">Search</a> </div>
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
<?php
error_reporting(E_ALL ^ E_NOTICE);

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

?>

<?php
	
	if (isset($_SESSION['acc'])){
    	echo '
		<div class="menu_area"><a href="M.I.AHome.php" class="addidea"> Home</a> <a href="M.I.AProfileEdit.php" class="loginhere">Manage</a>';
		//echo '<div class="menu_area"><a href="M.I.AHome.php" class="addidea"> Home</a> <a href="" class="loginhere">Manage</a>';
		$adminquery="SELECT user_id FROM is_admin WHERE user_id=".$_SESSION['uid'];
		
		$adminq=mysql_query($adminquery);
		$admin=mysql_fetch_array($adminq);
		if (mysql_num_rows($adminq)!=0){
			//echo '<a href="#" class="comments">Admin</a> <a href="userlogout.php">Log out</p> </a></div>';
			echo '<a href="#" class="comments">Admin</a>';

		
		}
		echo '<a href="userlogout.php" class="contact">Log out </a></div>';
	}
	else echo'
		<div class="menu_area"><a href="M.I.AHome.php" class="addidea"> Home</a> <a href="/favoritebook.php?user_id='.$_SESSION['uid'].'" class="loginhere">Read Online</a> <a href="#" class="comments">Category</a> <a href="M.I.ALogin.php" class="contact">Log In </a></div>';
	?>

   
	</div>
 </div>
 <div id="body_area">
 
 <div id="main">



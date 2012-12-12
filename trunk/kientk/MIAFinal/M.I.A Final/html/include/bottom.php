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
  <?php
  if (!isset($_SESSION['acc']))
  echo '
  <div class="login_area">
    <div class="login_head">Already a Member ?</div>
    <form action="checkuserlogin.php" method="post">
    <div class="login_textarea">
      <div class="login_name">Your Name </div>
      <div class="login_box">
        <label>
        <input name="acc" type="text" class="logintextbox" />
        </label>
      </div>
    </div>
    <div class="login_textarea">
      <div class="login_name">Password </div>
      <div class="login_box">
        <label>
        <input name="pass" type="password" class="logintextbox" />
        </label>
      </div>
    </div>
    <div class="login_textarea"><button onclick="this.form.submit" style="background-color:transparent; border:none; text-align:center"><a class="login" style="text-align:center"> Login </a></button><a href="M.I.ARegistration.php" class="register">Get Registration Now</a> </div>
  </div>'
  ?>
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
         <a href="../M.I.AHome.php" class="fotterlink">Home</a>  |  <a href="M.I.AAboutus.html" class="fotterlink">About Us</a></div>
       <div class="fotter_designed">Designed by: <a href="http://www.templateworld.com" class="fotter_designedlink">Kien - M.I.A</a> </div>
      </div>
     <div class="fotter_rightarea">
       <div class="fotter_validation"><a href="http://validator.w3.org/check?uri=referer" class="validation">Ebooks</a> <a href="http://jigsaw.w3.org/css-validator/check/referer" class="validation">M.I.A</a></div>
       <div class="fotter_copyrights">Copyright 2012<br /> 
        Team M.I.A [Hai - leader]
<br/>
Km 9, Nguyen Trai, Thanh Xuan, Ha Noi        </div>
     </div>
   </div>
     </div>
</form>
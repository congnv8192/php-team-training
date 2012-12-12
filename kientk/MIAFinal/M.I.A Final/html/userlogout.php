<?php

//1. find the session
session_start();

//4. destroy session
if(session_destroy()){
    //redirect
	header("location: M.I.ALogin.php");
}
else{
	echo 'Logout error. :=)) ';
}

?>
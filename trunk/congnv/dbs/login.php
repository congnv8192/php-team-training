<html>
	<head>
		<style>
			.errorMessage{
				color:red;
				border:none;	
				width: 100%;
			}
		</style>
	
		<script language= 'javascript' type= 'text/javascript'>
			function inputReset(src){
				with(document.frmLogin){
					src.value= '';
				}
			}
			function frmLoginCheck(){
				with(document.frmLogin){
					if(usr_name.value== '' || pwd.value== ''){
						errorMessage.value= 'Invalid Username or Password!';
						usr_name.focus();
						return false;
					}
				}
				//document.frmLogin.submit();
			}
		</script>
	</head>
	
	<body>
		<form name= 'frmLogin' method= 'post' action= 'log.php'>
			<input type= 'text'   name= 'errorMessage' value= '' class= 'errorMessage' readonly />
			</br>
			</br>
			<input type= 'text'   name= 'usr_name' value= 'Username' onFocus= 'inputReset(usr_name)'   />
			<input type= 'text'   name= 'pwd'      value= 'Password' onFocus= 'inputReset(pwd)'        />
			<input type= 'submit' name= 'submit'   value= 'Login'    onClick= 'frmLoginCheck()'        />
		</form>
	</body>
</html>
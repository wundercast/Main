<?php 
require "./inc/connect.inc.php";
phpinfo();
class Authenticate{
	function __construct($a,$b){
			$passowrd=$a;
			$username=$b;
			$attempts=0;
		}

function verifyCredentials($passowrd,$username){
	 $query="SELECT * FROM users WHERE password='$passowrd' AND (username='$username' OR email='$username' OR mobile='$username')";
	if(mysql_num_rows($query)==1){
		return TRUE;
		setSession($username);
	} 
	else {
		 return FALSE;
		$attempts++;
		if ($attempts>=3){
			enableCaptcha();
			
			}
		}
	} 	

function enableCaptcha(){
	
	
	}

function setSession($userName){
	$sessionName=$username;
	session_start();
	$_SESSION['username']=$sessionName;
	}
}

?>
<?php
    phpinfo();
	require_once 'registration_class.php';
	$items = array('firstName','secondName','displayName','email','password','passwordMatch','gender','phone_number');
	$error = false;
	foreach($items as $field) {
	  if (!(!empty($_POST[$field]) && isset($_POST[$field]))) 
  			  $error = true;
  	}
	if(!error) {
		
		$reg = new Registration($_POST['firstName'],$_POST['secondName'],$_POST['displayName'],$_POST['email'],$_POST['password'],$_POST['passwordMatch'],$_POST['gender'],$_POST['phone_number']);
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>
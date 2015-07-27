<?php


$user = '';     //database name
$pass = '';    //password_for_database
$dsn = ''; //destination of the_database
$db = ''; //name of database
$sql = new mysqli($dsn, $user, $pass, $db);



session_start();
$thisWipit = base64_decode($_SESSION['wipit']);

if (!isset($_SESSION['wipit']) || !isset($_SESSION['id'])) {
	echo  '<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp; <strong>Your session expired from inactivity. Please refresh your browser and continue.</strong>';
    exit();
}
// else if session id IS NOT EQUAL TO the posted variable for sender ID
else if ($_SESSION['id'] != $_POST['senderID']) {
	echo  '<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp;  <strong>Forged submission</strong>';
    exit();
}
// else if session wipit variable IS NOT EQUAL TO the posted wipit variable
else if ($sessWipit != $thisWipit) {
	echo  '<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp;  <strong>Forged submission</strong>';
    exit();
}
// else if either wipit variables are empty
else if ($thisWipit == "" || $sessWipit == "") {
	echo  '<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp;  <strong>Missing Data</strong>';
    exit();
}


$checkuserid = $_POST['senderID'];



// Process the message once it has been sent 
if (isset($_POST['message'])) { 
  // Escape and prepare our variables for insertion into the database 
  $to   = ($_POST['rcpntID']); 
  $from = ($_POST['senderID']);  
  $sub = htmlspecialchars($_POST['subject']); // Convert html tags and such to html entities which are safer to store and display
  $msg = htmlspecialchars($_POST['message']); // Convert html tags and such to html entities which are safer to store and display
  $sub  = mysql_real_escape_string($sub); // Just in case anything malicious is not converted, we escape those characters here
  $msg  = mysql_real_escape_string($msg); // Just in case anything malicious is not converted, we escape those characters here
  // Handle all pm form specific error checking here 
  if (empty($to) || empty($from) || empty($sub) || empty($msg)) { 
    echo '<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp;  Missing Data to continue';
	exit();
  } else { 

  // INSERT the data into your table now
    $sql_statement = "INSERT INTO private_messages (to_id, from_id, time_sent, subject, message) VALUES ('$to', '$from', now(), '$sub', '$msg')"; 
    if (!($sql->query($sql_statement))) { 
	    echo '<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp;  Could not send message! An insertion query error has occured.';
	    exit();
    } else { 	   
      
		echo '<img src="" alt="Success" width="31" height="30" /> &nbsp;&nbsp;&nbsp;<strong>Message sent successfully</strong>';
		exit();
    } 
  } 
} 
?>






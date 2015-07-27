<?php 

include("../app/inc/mailconfig.php");

class MailTo{
	
	function __construct($headers,$toemail,$to,$fromemail,$from,$subject,$body,$htmlbody,$attachments){
		$message = Swift_Message::newInstance()


  ->setSubject($subject)

  // Set the From address with an associative array
  ->setFrom(array($fromemail => $from))

  // Set the To addresses with an associative array
  ->setTo(array($toemail => $to))

  // Give it a body
	  ->setBody($body);
	
	if($htmlbody!=NULL){
  	
  // And optionally an alternative body
 
 $message ->addPart($htmlbody, 'text/html');

	}
  // Optionally add any attachments
if($attachments!=null){
  $message->attach(Swift_Attachment::fromPath($attachments));
}
		

	}
	
function sendMessage($message){
	$result=$mailer->send($message);
return $result;
	
}
	
}


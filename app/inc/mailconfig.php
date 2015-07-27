<?php 
require '../app/inc/connect.inc.php';
require_once '../vendor/swiftmailer/swiftmailer/lib/swift_init.php';
require_once '../vendor/swiftmailer/swiftmailer/lib/swift_required.php';

$transport = Swift_SmtpTransport::newInstance('smtp.example.org', 25)
  ->setUsername('your username')
  ->setPassword('your password')
  ;
  $mailer = Swift_Mailer::newInstance($transport);
?>
<?php
phpinfo();
require ("connect.inc.php");
require("MailTo.php");
class Registration {
	var $firstName, $secondName, $displayName, $email, $password, $passwordMatch, $gender,$uid,$phone_number;
	function __construct($a, $b, $c, $d, $e, $f, $g, $h) {
		$this -> firstName = mysqli_escape_string($a);
		$this -> secondName = mysqli_escape_string($b);
		$this -> displayName = mysqli_escape_string($c);
		$this -> email = mysqli_escape_string($d);
		$this -> password = mysqli_escape_string($e);
		$this -> passwordMatch = mysqli_escape_string($f);
		$this -> gender = mysqli_escape_string($g);
		$this -> phone_number = mysqli_escape_string($h);
		$this->uid = uniqid();
	}
	function verifyEmail() {
		if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $this -> email)) {
			return "Invalid Email Address";
		} else {
			
			$query = "SELECT * FROM TABLE WHERE EMAIL = '$this->email'";
		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) > 0)
			return "Email already taken";
		else
			{
			
			$factory = new RandomLib\Factory;
			$generator = $factory->getLowStrengthGenerator();
			$activation = $generator->generateString(32);
			$body='Hi, <br/> <br/> We need to make sure you are human. Please click <a href="http://wundercast.com/activation.php?code='.$activation.'">here </a>to verify your email and get started using your Website account. <br/> <br/>';
			$mail = new MailTo(null, $this -> email, $this -> firstName, "no-reply@wundercast.com", "Wundercast", "Accout Verification", $body, null, null);
			$mail->sendMessage();
			return "Email sent for validation";
			
			}
		}
	}
	public function matchPasswords() {
		if ($this -> password == $this -> passwordMatch)
			return true;
		else
			return false;
	}

	public function checkPassword() {
		$len = strlen($this -> password);
		$containsCaps = preg_match('/[A-Z]/', $this -> password);
		$containsDigit = preg_match('/\d/', $this -> password);
		$error = " ";
		if($len < 8)
			$error. "Your password is too short ";
		else if($len > 20)
			$error. "Your password is too long ";
		else if(!$containsCaps)
			$error. "Your password must contain at least one capital letter ";
		else if(!containsDigit)
			$error. "Your password must contain at least one number ";
		$error = explode(" ",$error);
		return $error; 
	}
	public function uploadCred() {
		$this->password = md5($this->password);
		$query = "INSERT INTO TABLE....";
		$result = mysqli_query($con, $query);
	}

}
?>
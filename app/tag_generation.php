<?php
    phpinfo();
	require("connect.inc.php");
	class tagGenerator {
		
		var $job_name,$job_location,$job_employer;
		var $tags;
		function __construct($name,$location,$employer) {
			
			$this->job_employer = $employer;
			$this->job_location = $location;
			$this->job_name = $name;
			$this->tags = array();
		}		
		function tagEmployer() {
			
			 $name = explode(" ",$this->job_employer);
			 $firstName = $name[0];
			 $lastName = $name[1];
			 array_push($this->tags,$firstName,$lastName);
			 $query1 = "INSERT INTO tags (tags,relTag) VALUES ('$firstName','$lastName') ON DUPLICATE KEY UPDATE relTag = CONCAT(relTag,' '.'$lastName')";
			 $query2 = "INSERT INTO tags (tags,relTag) VALUES ('$lastName','$firstName') ON DUPLICATE KEY UPDATE relTag = CONCAT(relTag,' '.'$firstName')";
			 $result1 = mysqli_query($con, $query1);
			 $result2 = mysqli_query($con, $query2);
			
		}
		function tagLocation() {
				
			$location = $this->job_location;
			$locArray = explode(' ',$location);
			$city = $locArray[0];
			$state = $locArray[1];
			$country = $locArray[2];
			array_push($this->tags,$city,$state,$country);
			$temp = $city.' '.$state;
			$queryCity = "INSERT INTO tags (tags,relTag) VALUES ('$city',' ') ON DUPLICATE KEY UPDATE tag = '$city'";
			$queryState = "INSERT INTO tags (tags,relTag) VALUES ('$state','$city') ON DUPLICATE KEY UPDATE relTag = CONCAT(relTag,' '.'$city')";
			$queryCountry = "INSERT INTO tags (tags,relTag) VALUES ('$country','$temp') ON DUPLICATE KEY UPDATE relTag = CONCAT(relTag,' '.'$temp')";
			
			
		}
		function tagJobName() {
			
			/*When job title is "Looking for abc xyz", 
			  I have no clue how to only create the 
			  tags abc and xyz
			*/
			
		}
		function linkTagToPost() {
					
				$tagString = "";
				foreach ($this->tags as $key) {
					
					$tagString = $tagString.' '.$key;
				}
				return $tagString;
		}
		
	}
?>
<?php
    phpinfo();
	require ("connect.inc.php");
	function getCommon($array,$occurance)
	{
  	 	 $array = array_reduce($array, function($a,$b) { $a = array_merge($a,explode(" ", $b)); return $a; },array());
    	return implode(" ",array_keys(array_filter(array_count_values($array),function($var)use($occurance) {return $var > $occurance ;})));
	}
	$keyphrase = $_GET['keyword_input'];
	$relTag = array();
	if(isset($keyphrase) && !empty($keyphrase))
	{
		$array = explode(" ",$keyphrase);
		foreach ($array as $key) {
			
			$query = "SELECT relTag FROM tags WHERE tag = '$key'";
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result) == 1) {
				$data = mysqli_fetch_array($result);
				array_push($relTag,$data);
			}
		}
		$occurance = sizeof($relTag) - 1;
		$commonTags = getCommon($relTag,$occurance);
		echo json_encode($commonTags);
		flush();
	}
?>
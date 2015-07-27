<?php 
$con= mysql_connect('160.153.57.40','wcphp','Healthywebsite1!') or die("Couldn't Connect to SQL server");
if ($con){ $connected=1;}
mysql_select_db('wundercast',$con) or die("Couldn't Select DB");
?>
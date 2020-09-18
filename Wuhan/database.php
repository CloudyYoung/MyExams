<?php


header("Content-Type:text/html;   charset=utf-8"); 

$mysql_server_name='';

$mysql_username='';

$mysql_password='';

$mysql_database='';


GLOBAL $conn;
$conn = mysqli_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting: ");

mysqli_query($GLOBALS['conn'], "set character set 'utf8'");
mysqli_query($GLOBALS['conn'], "set names 'utf8'");

mysqli_select_db($GLOBALS['conn'], $mysql_database);

?>
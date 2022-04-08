<?php 
// CONNECT DATABASE
$username = "postgres";
$password = "borneel1999";
$db = "database";

$conn = pg_connect("dbname=$db user=$username password=$password");
//$conn = pg_connect("host=$host dbname=$db user=$username password=$password");
?>

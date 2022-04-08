<?php 
// CONNECT DATABASE
//$host = "pgsql.hrz.tu-chemnitz.de";
//$username = "movie_database_rw";
//$password = "iMu7muchie";
//$db = "movie_database";

$username = "postgres";
$password = "borneel1999";
$db = "database";

$conn = pg_connect("dbname=$db user=$username password=$password");
//$conn = pg_connect("host=$host dbname=$db user=$username password=$password");
?>
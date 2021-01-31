<?

$kad="root";
$alan="localhost";
$parola="";
$vt_ad="haydar";

mysql_connect($alan,$kad,$parola);
mysql_select_db($vt_ad);
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION = 'utf8_turkish_ci'"); 

?>
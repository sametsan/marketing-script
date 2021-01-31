<?
/*
$kad="teknicom";
$adres="ftp.teknomodi.com";
$parola="tek12090";*/


$kad=ayar_al("ftp_kullanici");
$adres=ayar_al("ftp_adres");
$parola=ayar_al("ftp_parola");


$ftp = @ftp_connect($adres); 

if(!@ftp_login($ftp, $kad, $parola))
echo "Bağlantı başarısız!";


?>
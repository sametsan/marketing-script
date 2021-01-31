<?
require_once "1.php";
require_once "ftp.php";
print "<center>";



$dizin="../resimler/$get->no/";


if($get->islem=="yukle")
{



$dosya=$_FILES["dosya"];

$ftp_dizin="/httpdocs/resimler/$get->no/";


ftp_mkdir($ftp,$ftp_dizin);
ftp_chmod($ftp,0757,$ftp_dizin);


$tip=explode("/",$dosya["type"]);
$uzanti=$tip[1];
$ad=date("ymdHis").".$uzanti";
$tmp_ad=$dosya["tmp_name"];

echo "$ftp_dizin/$ad - ".$dosya["name"]."<br>";


$ftp_dizin.=$ad;

if(ftp_put($ftp,$ftp_dizin,$tmp_ad,FTP_BINARY))
echo "İşlem tamam.";


header("location:?no=$get->no&uyari=1");

}



if($get->islem=="sil")
{
unlink($get->ad);
header("location:?no=$get->no&uyari=1");
}

if($get->islem=="kapak")
{
mysql_query("UPDATE urunler SET resim='$get->ad' WHERE no='$get->no'");
header("location:?no=$get->no&uyari=1");
}



if($get->uyari==1)
print "İşlem tamamdır.<br>";

echo "<div class=siparisler-menu>";
echo "<a href=urun.php?no=$get->no>Ürünü Düzenle</a> ";
echo "</div>";

echo "<table><tr><td>";
print "
<form action=?no=$get->no&islem=yukle  method=post enctype=multipart/form-data>
<input type=file name=dosya><br>


<input type=submit value=yükle>
</form><br><br>";

echo "</td><td>";
print "<h3>Ürün kapağı</h3>";
echo "<img width=200 src='../".urun_resim($get->no)."'>";
echo "</td></tr></table>";
print "<h3>Diğer resimler </h3><br>";

$d=opendir($dizin);
if($d)
while($s=readdir($d))
{
if($s!=".." && $s!="." && $s!="kapak")
print "<div style='float:left;padding:2;height:200;border:1px solid #EFEFEF;'><a href=?islem=kapak&ad=$s&no=$get->no><img width=150 src=$dizin/$s></a><br><a href=?islem=sil&ad=$dizin/$s&no=$get->no>Sil</a> </div>";
}
require_once "2.php";
?> 

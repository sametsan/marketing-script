<?
require_once "1.php";

$dizin="../resimler/tema/";

print "<center>";

if($post->islem=="yukle")
{
$tmp_ad=$_FILES["dosya"]["tmp_name"];

$tip2=explode("/",$_FILES["dosya"]["type"]);
$tip=$tip2[1];
$ad="baslik.$tip";

$adres=$dizin.$ad;


if(file_exists($adres))
unlink("$adres");


        if($d=move_uploaded_file($tmp_ad,$adres)){
ayar_ver("site_baslik_resim",$ad);
header("location:?no=$get->no&uyari=1");
}

}

if($get->islem=="sil")
{
$adres=$get->adres;
if(file_exists($adres))
unlink("$adres");
header("location:?uyari=1");

}


if($get->uyari==1)
print "İşlem tamamdır.<br>";


print "
<form action=?  method=post enctype=multipart/form-data>
<table width=100%><tr>
<td><input type=file name=dosya></td>
<td><input type=hidden name=islem value=yukle>
<input type=submit value=Yükle></td>
</form></tr></table>";

print "<h3>Kaldır</h3>";

echo "<br><br>Başlık <br>";

echo "<img src=$dizin".ayar_al("site_baslik_resim")."></a><br> <a href='?islem=sil&adres=$dizin".ayar_al("site_baslik_resim")."'>Sil</a><br>";


require_once "2.php";
?> 

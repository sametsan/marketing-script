<?
require_once "1.php";

if(giris())
{
if($get->islem=="sil"){

mysql_query("DELETE FROM mesajlar WHERE uye_no='$get->uye' AND urun_no='$get->urun'");

header("location:?");
}

if($get->islem=="gonder"){

$l=flood(15);
if($l>0){
header("location:?uyari=3&uye=$post->uye_no");$hata=1;}

if( !$post->mesaj){
header("location:?uyari=2&uye=$post->uye_no");$hata=1;}

$zaman=date("d.m.Y H:i:s");

if(!$hata){
mysql_query("INSERT INTO mesajlar (yazan,uye_no,urun_no,mesaj,zaman) VALUES ('$session->UYE_no','$post->uye_no','$post->urun','$post->mesaj','$zaman')");
header("location:?uyari=1&urun=$post->urun&uye=$post->uye_no");
}

}}



switch($get->uyari)
{
case 1 : echo "<div class=uyari>İşleminiz tamamdır.</div>";break;
case 2 : echo "<div class=uyari>Boşlukları doldurun.</div>";break;
case 3 : echo "<div class=uyari>15 sn sonra deneyin.KORUMA!!!</div>";break;
}


echo "<div class=tablo><input type=button value='Mesajları Sil' onclick=\"location='?islem=sil&uye=$get->uye&urun=$get->urun'\"></div>";


if($get->urun){
$sqlu=mysql_query("SELECT * FROM urunler WHERE no='$get->urun'");
$urun=mysql_fetch_object($sqlu);
print "<div class=tablo>";
$resim=urun_resim($urun->no);
echo "<img align=left width=100 src=../$resim>";
print "<a href=../urun.php?no=$urun->no target=adasdasd>$urun->ad</a><br>";
echo "$urun->tanim<br>";
echo "$urun->fiyat TL<br>";
print "<div class=temizle></div>";
echo "</div><br>";
}


if($get->uye){
$sqlu=mysql_query("SELECT * FROM uyeler WHERE no='$get->uye'");
$uye=mysql_fetch_object($sqlu);
print "<div class=tablo>";
print "<a href=uye.php?no=$uye->no target=adasdasd>$uye->kullanici / $uye->ad $uye->soyad</a><br>";
echo "$uye->adres $uye->ilce-$uye->il // $uye->telefon // $uye->eposta";
print "<div class=temizle></div>";
echo "</div><br>";
}


print "<div class=tablo>";

print "<div class=tablo-orta>";
print "<div class=liste>";

$sql=mysql_query("SELECT * FROM mesajlar WHERE  uye_no='$get->uye' ORDER BY no");
while($s=mysql_fetch_object($sql))
{
mysql_query("UPDATE mesajlar SET yonetim_ziyaret=1 WHERE no='$s->no'");

$sqlu=mysql_query("SELECT * FROM uyeler WHERE no='$s->yazan'");
$uye=mysql_fetch_object($sqlu);
echo "<b>$uye->ad $uye->soyad</b><br>";

if($s->urun_no)
{
$sqlu=mysql_query("SELECT * FROM urunler WHERE no='$s->urun_no'");
$urun=mysql_fetch_object($sqlu);
$resim=urun_resim($urun->no);
echo "<a class=secili href=urun.php?no=$urun->no target=asdasdasd><img src='$resim' width=25 align=center> $urun->ad</a><br>";
}
echo "$s->mesaj<br><br>";
echo $s->zaman;
if($s->uye_ziyaret==1)
echo " - Üye tarafından okundu.";
else
echo " - Üye tarafından okunmadı.";
if($s->yonetim_ziyaret==1)
echo " - Yönetim tarafından okundu.";
else
echo " - Yönetim tarafından okunmadı.";
print "<hr>";
}
print "</div>";
print "<div class=temizle></div>";
print "</div>";
print "<div class=temizle></div>";
print "</div>";

print "<div class=tablo>";

echo "<form action=?islem=gonder method=post>";
echo "<input type=hidden name=uye_no value=$get->uye>";
echo "<table border=0>";
echo "<tr><td><textarea name=mesaj cols=100 rows=3></textarea></td></tr>";
echo "<tr><td><input  type=submit value=Gönder></td></tr>";
echo "</table></form>";

print "<div class=temizle></div>";
print "</div><br>";

require_once "2.php";
?> 

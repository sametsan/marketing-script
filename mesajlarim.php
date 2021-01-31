<?
require_once "1.php";
if(giris())
{
if($get->islem=="temizle"){

mysql_query("DELETE FROM mesajlar WHERE uye_no='$session->UYE_no'");

if($get->urun)
header("location:?urun=$get->urun");
else
header("location:?");


}

if($get->islem=="gonder"){

$l=flood(15);



if($l>0){

if($get->urun)
header("location:?uyari=3&urun=$get->urun");
else
header("location:?uyari=3");

$hata=1;}

if(!$get->mesaj){

if($get->urun)
header("location:?uyari=2&urun=$get->urun");
else
header("location:?uyari=2");


$hata=1;}

$zaman=date("d.m.Y H:i:s");

if(!$hata){
mysql_query("INSERT INTO mesajlar (yazan,uye_no,urun_no,mesaj,zaman) VALUES ('$session->UYE_no','$session->UYE_no','$get->urun','$get->mesaj','$zaman')");
header("location:?uyari=1");
}

}}


switch($get->uyari)
{
case 1 : echo "<div class=uyari>İşleminiz tamamdır.</div>";break;
case 2 : echo "<div class=uyari>Boşlukları doldurun.</div>";break;
case 3 : echo "<div class=uyari>15 sn sonra deneyin.KORUMA!!!</div>";break;
}

tema_tablo_ac("Mesajlarım");

print "<div class=liste>";

$sql=mysql_query("SELECT * FROM mesajlar WHERE uye_no='$session->UYE_no' ORDER BY no");
while($s=mysql_fetch_object($sql))
{
mysql_query("UPDATE mesajlar SET uye_ziyaret=1 WHERE no='$s->no'");

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
tema_tablo_kapat();

echo "<div style=\"text-align:right;padding-right:10;\"><a href=?islem=temizle&urun=$get->urun>Mesajlarımı Sil</a></div>";
if($get->urun)
{
echo "<div class=liste>";
$sqlu=mysql_query("SELECT * FROM urunler WHERE no='$get->urun'");
$urun=mysql_fetch_object($sqlu);
$resim=urun_resim($urun->no);
echo "<a class=secili href=urun.php?no=$urun->no target=asdasdasd><img src='$resim' width=25 align=center> $urun->ad</a>";
echo "</div>";
}

echo "
<script>
function mesaj_gonder()
{
var mesaj=document.getElementById('mesaj').value;
var urun=document.getElementById('urun').value;

location=\"mesajlarim.php?islem=gonder&mesaj=\"+mesaj+\"&urun=\"+urun;

}

</script>

";


echo "<div class=tablo><form action=?islem=gonder method=post>";
echo "<input type=hidden id=urun name=urun value=$get->urun>";
echo "<table border=0>";
echo "<tr><td><textarea name=mesaj id=mesaj cols=60 rows=2></textarea></td></tr>";
echo "<tr><td><a class='dugme' onclick=\"mesaj_gonder()\"><span class=dugme-simge style=\"background:url('tema/mesaj_gonder.png')\"></span>Gönder</a></td></tr>";
echo "</table></form></div>";



require_once "2.php";
?> 

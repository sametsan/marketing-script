<?
require_once "1.php";


echo "<h3>Mesajlar</h3>";




print "<div class=tablo>";
print "<div class=tablo-orta>";

echo "<div class=liste>";
$sql=mysql_query("SELECT Distinct uye_no FROM mesajlar ORDER BY no DESC");
while($s=mysql_fetch_object($sql))
{
$sqlm=mysql_query("SELECT * FROM mesajlar WHERE  yonetim_ziyaret=0 AND uye_no='$s->uye_no'");
$mesaj=mysql_num_rows($sqlm);

$sqlu=mysql_query("SELECT * FROM uyeler WHERE no='$s->uye_no'");
$uye=mysql_fetch_object($sqlu);

if($mesaj>0)
echo "<a class=secili href='mesaj.php?uye=$uye->no'>$uye->kullanici / $uye->ad $uye->soyad <span>[$mesaj]</span></a>";
else
echo "<a href='mesaj.php?&uye=$s->uye_no'>$uye->kullanici / $uye->ad $uye->soyad  <span>[$mesaj]</span></a>";


}
echo "</div>";
print "<div class=temizle></div>";
print "</div>";
print "<div class=temizle></div>";
print "</div>";

require_once "2.php";
?> 

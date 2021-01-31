<?
include "1.php";

$sql=mysql_query("SELECT * FROM online ");

echo "<div class=tablo><div class=tablo-orta>";
while($d=mysql_fetch_object($sql))
{

$sqlu=mysql_query("SELECT * FROM uyeler WHERE no=$d->ad");
$uye=mysql_fetch_object($sqlu);

$giris=date("d.m.y // H:i:s",$d->zaman);
$dk=time()-$d->zaman;
echo "<div class=tablo-liste>";



echo "<h3> $d->ip / $uye->kullanici</h3> 
<b>Sayfa :</b> <a target=_blank href=$d->sayfa>$d->sayfa</a> <br>
<b>Geldiği sayfa :</b> <a target=_blank href=$d->geldigi_sayfa>$d->geldigi_sayfa</a> <br>
<b>Tarayıcı :</b> $d->tarayici <br>
 <b>Giriş :</b> $giris <br>
 <b>$dk</b> saniyedir haraket yok.

</div>";
}
echo "</div></div>";
include "2.php";

?> 

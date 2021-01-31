<?
require_once "1.php";

echo "<table border=0 width=100%>";
echo "<tr>";


echo "<td><div class=tablo>";
echo "<div class=tablo-orta>";
echo "<h3>Stokta bitenler</h3>";
$sql=mysql_query("SELECT * FROM urunler WHERE adet<=0");
while($s=mysql_fetch_object($sql))
echo "<li><a href=urun.php?no=$s->no>$s->ad</a>[$s->adet]</li>";
echo "</div>";
echo "</div></td>";




echo "<td><div class=tablo >";
echo "<div class=tablo-orta>";
echo "<h3>Stokta azalanlar(2'den az)</h3>";
$sql=mysql_query("SELECT * FROM urunler WHERE adet<2 AND adet>0");
while($s=mysql_fetch_object($sql))
echo "<li><a href=urun.php?no=$s->no>$s->ad</a>[$s->adet]</li>";
echo "</div>";
echo "</div></td>";

echo "</tr><tr>";

echo "<td><div class=tablo style=\"width:350;float:left;\">";
echo "<div class=tablo-orta>";
echo "<h3>Beğenilenler</h3>";
$sql=mysql_query("SELECT * FROM urunler ORDER BY begen DESC LIMIT 10");
while($s=mysql_fetch_object($sql))
echo "<li><a href=urun.php?no=$s->no>$s->ad</a>[$s->begen]</li>";

echo "<h3>Aktif Olanlar</h3>";
$sql=mysql_query("SELECT * FROM online");
while($s=mysql_fetch_object($sql)){
$sqlu=mysql_query("SELECT * FROM uyeler WHERE no=$s->ad");
$uye=mysql_fetch_object($sqlu);
echo "<li>$uye->ad $uye->soyad / $s->ip / $d->sayfa </li>";
}
echo "<br><a href=aktif.php>Tümünü gör</a>";
echo "</div>";
echo "</div></td>";


echo "<td><div class=tablo style=\"width:300;float:left;\">";
echo "<div class=tablo-orta>";
echo "<h3>Son Üyeler</h3>";
$sql=mysql_query("SELECT * FROM uyeler ORDER BY no DESC LIMIT 20");
while($s=mysql_fetch_object($sql))
echo "<li><a href=uye.php?no=$s->no>$s->ad $s->soyad</a></li>";

echo "<h3>Veriler</h3>";
$sql=mysql_query("SELECT * FROM urunler");
$s=mysql_num_rows($sql);
print "Ürün Sayısı : <b>$s</b> <br>";

$sql=mysql_query("SELECT * FROM uyeler");
$s=mysql_num_rows($sql);
print "Üye Sayısı : <b>$s</b> <br>";
echo "</div>";
echo "</div>";


echo "</tr>";
echo "</table></td>";




require_once "2.php";
?> 

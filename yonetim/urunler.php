<?
require_once "1.php";


$sqld=mysql_query("SELECT * FROM kategoriler WHERE no='$get->akno' ORDER BY sira");
$d=mysql_fetch_object($sqld);


$sqlf=mysql_query("SELECT * FROM kategoriler WHERE no='$d->kno' ORDER BY sira");
$f=mysql_fetch_object($sqlf);


echo "<hr>";
echo "<a href=kategoriler.php>Kategoriler</a> / ";
echo "<a href=kategoriler.php?no=$f->no>$f->kategori</a> / ";
echo $d->kategori;
echo " - <a href=urun.php?kno=$get->kno&akno=$get->akno>Ürün Ekle</a><hr>";



echo "<div class=siparisler-menu>";
echo "<a  href=urun_yedekle.php?kno=$get->no>Ürün listesini indir</a> - ";
echo "<a  href=urun_yedekle.php>Bütün ürünlerin listesini indir</a> - ";
echo "<a  href=fpdf.php?no=$get->no>PDF İndir</a> - ";
echo "<a  href=fpdf.php>Bütün Ürünler PDF İndir</a>";
echo "</div>";


print "<div class=liste ><table width=100%>";
echo "<tr align=center><td>Ürün adı</td>";
echo "<td width=100>Adet</td>";
echo "<td width=100>Fiyat</td></tr>";


$sql=mysql_query("SELECT * FROM urunler WHERE kno='$get->no' ORDER BY no DESC");
while($s=mysql_fetch_object($sql))
{
print "<tr>";
echo "<td><a href=urun.php?no=$s->no>$s->ad</a></td>";
echo "<td width=100>$s->adet</td>";
echo "<td width=100>$s->fiyat TL</td>";
echo "</tr>";
}




echo "</table></div>";


require_once "2.php";

?> 

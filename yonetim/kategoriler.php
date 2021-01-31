<?
require_once "1.php";

switch($get->islem){
case "duzenle":
foreach($post->sira as $s=>$d)
mysql_query("UPDATE kategoriler SET sira='$d' WHERE no=$s");


 header("location:?kategori_uyari=1");
break;
}



switch($get->kategori_uyari){
case 1 : print "İşlem tamamdır.";break;
case 2 : print "Boşlukları doldurun.";break;
}
echo "<hr>";

$sqld=mysql_query("SELECT * FROM kategoriler WHERE no='$get->kno' ORDER BY sira");
$d=mysql_fetch_object($sqld);

echo "<a href=kategoriler.php>Kategoriler</a> / ".$d->kategori;

if($get->kno)
echo " - <a href=kategori.php?kno=$get->kno>Kategori Ekle</a><hr>";
else
echo " - <a href=kategori.php>Kategori Ekle</a><hr>";


print "<form action=?islem=duzenle method=post>";


print "<div class=liste ><table width=100%>";
// // // // // // // // // // // // // // // // // // // // // // // // // // // 

if($get->kno)
$no=$get->kno;
else
$no=0;

$sql=mysql_query("SELECT * FROM kategoriler WHERE kno=$no ORDER BY sira");
while($s=mysql_fetch_object($sql))
{
print "<tr>";
if(!$get->kno)
echo "<td><a href=kategoriler.php?kno=$s->no>$s->kategori</a></td>";
else
echo "<td><a href=urunler.php?kno=$get->kno&akno=$s->no>$s->kategori</a></td>";

echo "<td width=100><a href=kategori.php?no=$s->no>Düzenle</a></td>";
echo "<td width=50> <input style=\"float:right\" type=text value='$s->sira' name=sira[$s->no] size=3></td>";
echo "</tr>";
}




echo "</table></div>";

print "<input type=submit value=Kaydet>";
print "</form><br>";

require_once "2.php";

?> 

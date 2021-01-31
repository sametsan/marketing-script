<?
include "1.php";


if(!giris())
header("location:giris.php");


print "<title>Ürün Hakkında Soru Sor</title>";
print "<div class=tablo>";
print "<div class=tablo-baslik>
<div class=tablo-baslik-sol></div>
<div class=tablo-baslik-sag></div>
<div class=tablo-baslik-orta>Mesaj gönder</div>
</div>
";
print "<div class=tablo-orta>";
switch($get->uyari)
{
case 1 : echo "<div class=uyari>İşleminiz tamamdır.</div>";break;
case 2 : echo "<div class=uyari>Boşlukları doldurun.</div>";break;
case 3 : echo "<div class=uyari>15 sn sonra deneyin.KORUMA!!!</div>";break;
}

echo "<form action=islem.php?islem=urun_soru method=post>";
echo "<input type=hidden name=urun value=$get->urun>";
echo "<table border=0>";
if($get->urun){
$sql=mysql_query("SELECT * FROM urunler WHERE no=$get->urun");
$urun=mysql_fetch_object($sql);
echo "<tr><td>Ürün : </td><td><a href=urun.php?no=$urun->no>$urun->ad</a></td></tr>";

}
echo "<tr><td>Mesaj : </td><td><textarea name=mesaj cols=50 rows=7></textarea></td></tr>";
echo "<tr><td> </td><td><input  type=submit value=Gönder></td></tr>";
echo "</table></form>";
print "<div class=temizle></div>";
print "</div>";
print "<div class=temizle></div>";
print "</div><br>";



include "2.php";
?> 

<?
require_once  "1.php";


print "<title>".ayar_al("site_baslik")."</title>";
echo "<meta name=description content='".ayar_al("site_tanim")."'>";



$duyuru=ayar_al("duyuru");

if($duyuru!=""){
tema_tablo_ac();
echo $duyuru;
tema_tablo_kapat();
}

echo "<div class=karsilama>";
echo "<div class=karsilama-orta>";
echo "<div class=karsilama-resim>";
include "eklenti/karsilama.php";
echo "</div>";

echo "</div>";
echo "</div>";


tema_tablo_ac();

echo "<div class=vitrin><div class=vitrin-satir>";
$i=0;
$a=0;
$sql=mysql_query("SELECT * FROM urunler WHERE vitrin=1 ORDER BY vitrin_sira");

while($s=mysql_fetch_object($sql))
{


if($i==3){print "<div class=temizle></div></div><div class=vitrin-satir>";$a=$a+1;;$i=0;}
if($a==ayar_al("vitrin_satir")){break;}

tema_urun_kucuk($s);
$i=$i+1;

}

echo "<div class=temizle></div></div></div>";
tema_tablo_kapat();


require_once  "2.php";
?>
<?
require_once "1.php";



if($get->akno)
$sql=mysql_query("SELECT * FROM urunler WHERE kno=$get->akno ORDER BY no DESC ");
elseif($get->ara)
$sql=mysql_query("SELECT * FROM urunler WHERE ad LIKE '%$get->ara%' ORDER BY no DESC ");
else
$sql=mysql_query("SELECT * FROM urunler ORDER BY no DESC ");



$limit=21;
if(empty($get->sayfa)) { $get->sayfa ="1"; } 
$sayi = mysql_num_rows($sql); 
$kac_tane = $sayi / $limit;
if($kac_tane%$limit>"0") { $kac_tane++; } 
$son = ($get->sayfa-1)*$limit; 


if($get->akno)
$sql=mysql_query("SELECT * FROM urunler WHERE kno=$get->akno ORDER BY no DESC limit $son,$limit");
elseif($get->ara)
$sql=mysql_query("SELECT * FROM urunler WHERE ad LIKE '%$get->ara%' ORDER BY no DESC limit $son,$limit");
else
$sql=mysql_query("SELECT * FROM urunler ORDER BY no DESC limit $son,$limit");

if($get->kno && $get->akno){
$ksql=mysql_query("SELECT * FROM kategoriler WHERE no=$get->kno ORDER BY no DESC ");$k=mysql_fetch_object($ksql);
$aksql=mysql_query("SELECT * FROM kategoriler WHERE no=$get->akno ORDER BY no DESC ");$ak=mysql_fetch_object($aksql);
}



if($get->kno)
$baslik= "Ürünler / $k->kategori / $ak->kategori";
elseif($get->ara)
$baslik=  "$get->ara / ürünler";
else
$baslik= "Ürünler";

tema_tablo_ac($baslik);

echo "<table><tr>";

$i=0;
$a=0;

while($s=mysql_fetch_object($sql))
{

if($i==ayar_al("vitrin_sutun")){print "</tr><tr>";$a=$a+1;;$i=0;}
if($a==ayar_al("vitrin_satir")){break;}

echo "<td>";
tema_urun_kucuk($s);

$i=$i+1;
echo "</td>";
}

echo "</tr></table>";

tema_tablo_kapat();

echo "<div class=sayfala>";
for($i=1; $i < $kac_tane; $i++)
 {
if($get->sayfa==$i)
print "<a class='sayfala-secili' >$i </a>";
else
if($get->akno && $get->kno)
print "<a class='sayfala-sec' href=?sayfa=$i&akno=$get->akno&kno=$get->kno>$i </a>";
else
print "<a class='sayfala-sec' href=?sayfa=$i>$i </a>";
 } 
print "<div class=temizle></div>";
echo "</div>";

require_once "2.php";
?> 

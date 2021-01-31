<?
require_once "1.php";

print "<title>Siparişlerim</title>";



$sql=mysql_query("SELECT * FROM siparisler WHERE uye_no='$session->UYE_no' ");





while($s=mysql_fetch_object($sql))
{

$durum=siparis_durum($s->siparis_durum);
$durum=$durum["durum"];

tema_tablo_ac("#$s->no | $s->siparis_odeme | ".fiyat($s->siparis_odeme_fiyat)." TL <span style='float:right;'>$durum</span>");
echo "<div class=siparisler><ul>";


echo "
<li>
Ürün Adı
<span style='float:right;width:50;'>Fiyat</span>
<span style='float:right;width:50;'>Adet</span>
<span style='float:right;width:150;'>Tarih/Saat</span>

</li>
";



$toplam=0;
$genel=0;

$sqlc=mysql_query("SELECT * FROM siparisler_liste WHERE kno='$s->no' ");

while($c=mysql_fetch_object($sqlc)){


$sqlk=mysql_query("SELECT * FROM urunler WHERE no='$c->urun_no'");
$f=@mysql_fetch_object($sqlk);


$urun_resim=urun_resim($f->no);



echo "
<li>
<a target=a href=urun.php?no=$f->no>$f->ad</a>
<span style='float:right;width:50;'>".fiyat($c->urun_fiyat)." TL</span>
<span style='float:right;width:50;'>$c->urun_adet</span>
<span style='float:right;width:150;'>$c->tarih/$c->saat</span>

</li>
";

$toplam=$toplam+($c->urun_adet*$c->urun_fiyat);

}


$genel=$toplam+$s->siparis_odeme_fiyat;

echo "
<li>
Ara Toplam = ".fiyat($toplam)." TL
<span style='float:right;'>Genel Toplam = ".fiyat($genel)." TL</span>
</li>
";


echo "<li>";

if($s->kargo_no || $s->kargo_sirket )
echo "<b>Kargo === </b> <strong>NO</strong>=$s->kargo_no | <strong>TARİH/SAAT</strong>=$s->kargo_tarih/$s->kargo_saat | <strong>ŞİRKET</strong>=$s->kargo_sirket ";
if($s->kargo_site)
echo "<span style='float:right;'><a target=_blank href=$s->kargo_site>Kargom Nerede</a></span>";
echo "</li>";



if($s->siparis_aciklama)
echo "
<li>
$s->siparis_aciklama
</li>
";



echo "</ul></div>";
tema_tablo_kapat();


}



require_once "2.php";
?> 

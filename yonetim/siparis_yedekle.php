<?
require_once "bas.php";


$baslik=ayar_al("site_baslik");
$tarih=date("d.m.y");
$dosya=date("ymd").".txt";
$durum=4;

header('Content-type: application/text');
header("Content-Disposition: attachment; filename=$dosya");

echo "//$baslik \t $tarih \n\n";

$sql=mysql_query("SELECT DISTINCT uye_no FROM siparisler WHERE durum='$durum' ORDER BY no DESC");
while($s=mysql_fetch_object($sql))
{


$sqlu=mysql_query("SELECT * FROM uyeler WHERE no=$s->uye_no");
$uye=mysql_fetch_object($sqlu);
$sqlf=mysql_query("SELECT * FROM siparisler WHERE durum='$durum' AND uye_no='$s->uye_no' ORDER BY no DESC");


echo "| $uye->ad $uye->soyad - $uye->adres - $uye->ilce-$uye->il - $uye->telefon - $uye->eposta \n\n";


while($siparisler=mysql_fetch_object($sqlf)){

$sqls=mysql_query("SELECT * FROM urunler WHERE no=$siparisler->urun");
$urun=mysql_fetch_object($sqls);

echo "#$urun->ad \t $siparisler->tarih / $siparisler->saat \t $urun->fiyat TL X $siparisler->adet \t Kargo [$siparisler->kargo_no \t $siparisler->kargo_sirket \t $siparisler->kargo_tarih $siparisler->kargo_saat \t $siparisler->aciklama]\n";

$odeme=$siparisler->odeme;
$toplam_fiyat_ara=$toplam_fiyat_ara+($urun->fiyat*$siparisler->adet);
$toplam_adet=$toplam_adet+$siparisler->adet;
}



switch($odeme)
{
case "havale" :$kargo_fiyat=4; break;
case "kapida" : 

if($toplam_fiyat_ara<100)
$kargo_fiyat=7;
elseif($toplam_fiyat_ara<200)
$kargo_fiyat=8;
elseif($toplam_fiyat_ara>200)
$kargo_fiyat=10;
break;
default: $kargo_fiyat=0;
}
$toplam_fiyat=$toplam_fiyat_ara+$kargo_fiyat;

echo "\n[=======> $toplam_adet adet ürün - Ara Toplam + Kargo : $toplam_fiyat_ara TL+ $kargo_fiyat - $odeme - TOPLAM = $toplam_fiyat \n";
echo "-----------------------------------------------------------------------------------------\n\n";


$toplam_adet=0;
$toplam_fiyat=0;
$toplam_fiyat_ara=0;
$kargo_fiyat=0;
}

?> 

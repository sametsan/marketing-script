<?
require_once "bas.php";



switch($get->islem)
{

case "sil":

mysql_query("DELETE FROM siparisler_liste WHERE no='$get->no'");

header("location:?uyari=1&kno=$get->kno");
break;

case "paket_sil_sayfa":

echo "<br><br><br><center>Paketi Silmek İstediğinize emin misiniz?<br>
<a href=?islem=paket_sil&kno=$get->kno>Evet </a> - 
<a href=?kno=$get->kno>Hayır</a>
</center>";
break;



case "paket_sil":

mysql_query("DELETE FROM siparisler WHERE no='$get->kno'");

header("location:?uyari=1&kno=$get->kno");
break;


case "duzenle":

$siparis=$get->kno;

mysql_query("UPDATE siparisler SET siparis_durum='$post->durum' WHERE no='$siparis'");

if($post->aciklama)
mysql_query("UPDATE siparisler SET siparis_aciklama='$aciklama' WHERE no='$siparis'")or die(mysql_error());
if($post->kargo_tarih)
mysql_query("UPDATE siparisler SET kargo_tarih='$post->kargo_tarih' WHERE no='$siparis'");
if($post->kargo_saat)
mysql_query("UPDATE siparisler SET kargo_saat='$post->kargo_saat' WHERE no='$siparis'");
if($post->kargo_no)
mysql_query("UPDATE siparisler SET kargo_no='$post->kargo_no' WHERE no='$siparis'");
if($post->kargo_sirket)
mysql_query("UPDATE siparisler SET kargo_sirket='$post->kargo_sirket' WHERE no='$siparis'");
if($post->kargo_site)
mysql_query("UPDATE siparisler SET kargo_site='$post->kargo_site' WHERE no='$siparis'");


header("location:?uyari=1&kno=$get->kno");
break;
}



echo "<div class=siparis_liste><ul>";



$sqls=mysql_query("SELECT * FROM siparisler WHERE no='$get->kno' ");
$siparis=mysql_fetch_object($sqls);

$sqlu=mysql_query("SELECT * FROM uyeler WHERE no='$siparis->uye_no' ");
$uye=mysql_fetch_object($sqlu);

if($get->uyari==1)
echo "<li class=uyari><center>İşlem tamamdır.</center></li>";


echo "<li>
<b><a target=_blank href=uye.php?no=$uye->no>$uye->kullanici</a></b> | <b>$uye->ad $uye->soyad</b> | $uye->eposta | $uye->telefon<br> 
$uye->adres | $uye->il/$uye->ilce 
</li>";


echo "<li>
<span style=\"float:left;width:450;\">
$siparis->siparis_odeme | 
".fiyat($siparis->siparis_odeme_fiyat)." TL
</span>

<span style=\"float:right;width:150;text-align:right;\"><a href=?islem=paket_sil_sayfa&kno=$get->kno>Paketi Sil</a></span> 
</li>";



echo "<li>
<span style=\"float:left;width:440;overflow:hidden;\">Ürün Adı</span>
<span style=\"float:right;width:30;text-align:right;\"> Sil</span> 
<span style=\"float:right;width:50;\"> Fiyat</span> 
<span style=\"float:right;width:50;\">Adet</span> 
<span style=\"float:right;width:150;\">Tarih/Saat</span> 
</li>";


$sql=mysql_query("SELECT * FROM siparisler_liste WHERE kno='$get->kno'");

while($s=mysql_fetch_object($sql)){

$sqls=mysql_query("SELECT * FROM urunler WHERE no='$s->urun_no'");
$urun=mysql_fetch_object($sqls);

echo "<li>
<span style=\"float:left;width:440;overflow:hidden;\"><a target=_blank href=../urun.php?no=$urun->no>$urun->ad </a></span> 
<span style=\"float:right;width:30;text-align:right;\"> <a href=?islem=sil&no=$s->no&kno=$get->kno>Sil</a></span> 
<span style=\"float:right;width:50;\"> ".fiyat($s->urun_fiyat)." TL</span> 
<span style=\"float:right;width:50;\"> $s->urun_adet</span> 
<span style=\"float:right;width:150;\"> $s->tarih/$s->saat</span> 
</li>";

$toplam=$toplam+($s->urun_fiyat*$s->urun_adet);
}


echo "<li>
<span style=\"float:right;width:150;\">Toplam = ".fiyat($toplam)." TL</span> 
</li>";

$toplam=$toplam+$siparis->siparis_odeme_fiyat;
echo "<li>
<span style=\"float:right;width:150;\">Kargo + Toplam = ".fiyat($toplam)." TL</span> 
</li>";




echo "</ul></div>";


echo "<table width=100% border=0 cellpadding=5 cellspacing=0>";
echo "<form action=?islem=duzenle&kno=$get->kno method=post>";
echo "<tr><td>Durum</td>";
echo "<td>Kargo Tarih</td>";
echo "<td>Kargo Saat </td>";
echo "<td>Kargo _irket </td>";
echo "<td >Kargo No </td>";
echo "<td >Kargo Takip  </td></tr>";


echo "<tr><td><select name=durum>";
$i=0;
foreach($siparis_durum as $sip_durum){
if($siparis->siparis_durum!=$i)
echo "<option value='$i'>".$sip_durum[1]."</option>";
else
echo "<option value='$i' selected>".$sip_durum[1]."</option>";
$i=$i+1;
}
echo "</select></td>";
echo "<td><input style=\"width:110;\" type=text name=kargo_tarih  value=\"$siparis->kargo_tarih\" > </td>";
echo "<td><input style=\"width:110;\" type=text name=kargo_saat   value=\"$siparis->kargo_saat\"> </td>";
echo "<td><input style=\"width:110;\" type=text name=kargo_sirket value=\"$siparis->kargo_sirket\" > </td>";
echo "<td ><input style=\"width:110;\" type=text name=kargo_no  value=\"$siparis->kargo_no\"> </td>";
echo "<td ><input style=\"width:110;\" type=text name=kargo_site  value=\"$siparis->kargo_site\" >  </td></tr>";

echo "<tr><td colspan=6 >Açıklama : <br><textarea name=aciklama width=100% cols=65 rows=3>$siparis->kargo_site</textarea></td></tr>";
echo "<tr><td colspan=6 ><input type=submit value=Kaydet></td></tr>";
echo "</form>";
echo "</table>";



?> 

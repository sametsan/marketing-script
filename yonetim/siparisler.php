<?
require_once "1.php";

switch($get->sayfa)
{
case "temizle":
mysql_query("DELETE FROM siparisler WHERE siparis_durum='4'");
header("location:?uyari=1&durum=4");
break;

case "iptal":
mysql_query("UPDATE siparisler SET siparis_durum=5 WHERE no='$get->no'");
header("location:?uyari=1&durum=5");
break;
case "sil":
mysql_query("DELETE FROM siparisler WHERE no='$get->no'");
header("location:?uyari=1&durum=5");
break;
case "duzenle":

foreach($post->siparis as $siparis)
{

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

}

 header("location:?uyari=1&durum=$post->durum");
break;
}


switch($get->uyari){
case 1 : echo "<div class=uyari>øYlem tamamdñr.</div><br>";break;
}

$durum=$get->durum;

if(!$durum)
$durum=0;

echo "<div class=siparisler-menu>";
$i=0;
foreach($siparis_durum as $sip_durum){
if($durum!=$i)
echo "<a href=?durum=$i>".$sip_durum[1]."</a> - ";
else
echo $sip_durum[1]." - ";
$i=$i+1;
}
echo "</div><br>";


if($get->durum==4){
echo "<div class=siparisler-menu>";
echo "<a  href=siparis_yedekle.php>Teslim listesini indir</a> - ";
echo "<a  href=?sayfa=temizle>Temizle</a>";
echo "</div>";}




$sql=mysql_query("SELECT * FROM siparisler WHERE siparis_durum='$durum' ORDER BY no DESC");


while($s=mysql_fetch_object($sql))
{

$sqlc=mysql_query("SELECT * FROM uyeler WHERE no='$s->uye_no'");
$c=mysql_fetch_object($sqlc);

echo "<div class=tablo>";
echo "<div class=tablo-orta>";


echo "<table class=kenarliksiz width=100% border=0 cellpadding=5 cellspacing=0>";

echo "<tr>


<td width=5><a onclick=\"window.open('siparis_goster.php?kno=$s->no','siparis','width=800,height=500')\" href=# >#$s->no</a></td>

<td  width=100> <b>$c->ad $c->soyad</b></td>
<td > $c->adres </td>
<td width=100>$c->ilce-$c->il </td>
<td width=100> $c->telefon </td>
<td  width=200> $c->eposta</td>


</tr></table>";

echo "</div></div>";
}



require_once "2.php";
?> 

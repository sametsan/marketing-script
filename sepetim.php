<?
require_once "1.php";

if(!giris())
header("location:index.php");


echo "
<script>

function hesapla(kargo,toplam)
{
var top=kargo+toplam;
document.getElementById('kargo_ucreti').innerHTML=kargo+' TL';
document.getElementById('genel_toplam').innerHTML=top+' TL';
}

var odeme;
var sozlesme_oku=0;
var sozlesme_odeme=0;

function sec(secili,okl){


document.getElementById('odeme').value=okl;
document.getElementById('cek_'+okl).checked='checked';



if(odeme)
odeme.className='odeme';

secili.className='odeme-secili';
odeme=secili;



sozlesme_odeme=1;
sozlesme_dugme();
}



function sozlesme()
{
  var onay=document.getElementById('sozlesme_onay').value;
 
  if(onay==1){
document.getElementById('sozlesme_onay').value=0;
sozlesme_oku=0;
  }
  else
  {
document.getElementById('sozlesme_onay').value=1;
sozlesme_oku=1;
  }
  
sozlesme_dugme();
}


function sozlesme_dugme()
{
if(sozlesme_odeme==1 && sozlesme_oku==1)
document.getElementById('sozlesme_dugme').disabled=false;
else
 document.getElementById('sozlesme_dugme').disabled = true;
}


</script>


";

$siparis_toplam=0;
$sepet_toplam=0;

$sql=mysql_query("SELECT * FROM sepet WHERE uye='$session->UYE_no'");

$sepet=mysql_fetch_object($sql);

if($sepet->no)
$sepet_dolu=1;
else
{
tema_tablo_ac("Sepetim");
echo "<center>Sepetiniz Boş.</center>";
tema_tablo_kapat();
}




if($sepet_dolu==1){


tema_tablo_ac("Onay bekleyen siparişler");

echo "<div class=sepetim><ul>";




$sql=mysql_query("SELECT * FROM siparisler WHERE uye_no='$session->UYE_no' AND siparis_durum=0 ");

$d=mysql_fetch_object($sql);


if($d->no)
$onay_bekleyen=1;

echo "
<li>
<span style=\"float:left;width:620;\">Sipariş No : #$d->no</span>
</li>
";


echo "
<li>
<span style=\"float:left;width:620;\">Ürün Adı</span>
<span style=\"float:left;width:50;\">Adet</span>
<span style=\"float:left;width:50;\">Fiyat</span>

</li>
";




$sqlc=mysql_query("SELECT * FROM siparisler_liste WHERE kno='$d->no'");

while($c=mysql_fetch_object($sqlc)){

$sqlf=mysql_query("SELECT * FROM urunler WHERE no=$c->urun_no");
$f=mysql_fetch_object($sqlf);

$durum=siparis_durum($d->durum);



echo "
<li>
<span style=\"float:left;width:620;\"><a href=urun.php?no=$f->no>$f->ad</a></span>
<span style=\"float:left;width:50;\">$c->urun_adet</span>
<span style=\"float:left;width:50;\">".fiyat($c->urun_fiyat)." TL</span>

</li>
";


$siparis_toplam=$siparis_toplam+($c->urun_fiyat*$c->urun_adet);
}

$siparis_no=$d->no;

echo "
<li>
<span style=\"float:left;width:220;\">Ödeme : $d->siparis_odeme</span>
<span style=\"float:left;width:150;\">Kargo : ".fiyat($d->siparis_odeme_fiyat)." TL</span>
<span style=\"float:left;width:200;\">Durum : ".$durum["durum"]."</span>
<span style=\"float:right;width:100;\">Toplam : $siparis_toplam TL</span>
</li>
";

echo "</ul></div>";
tema_tablo_kapat();




tema_tablo_ac("Sepetim");

echo "<div class=sepetim><ul>";

echo "
<li>
<span style=\"float:left;width:570;\">Ürün Adı</span>
<span style=\"float:left;width:50;\">Adet</span>
<span style=\"float:left;width:50;\">Fiyat</span>
<span style=\"float:right;width:50;\">Kaldır</span>
</li>
";
$sql=mysql_query("SELECT * FROM sepet WHERE uye='$session->UYE_no'");
while($d=mysql_fetch_object($sql)){


$sqlf=mysql_query("SELECT * FROM urunler WHERE no=$d->urun");
$f=mysql_fetch_object($sqlf);

echo "
<li>
<span style=\"float:left;width:570;\"><a href=urun.php?no=$f->no>$f->ad</a></span>
<span style=\"float:left;width:50;\">$d->adet</span>
<span style=\"float:left;width:50;\">$f->fiyat</span>
<span style=\"float:right;width:50;\"><a href=islem.php?islem=sepet_kaldir&no=$d->no><img border=0 height=15 src=tema/sil.png></a></span>
</li>
";

$sepet_toplam=$sepet_toplam+($f->fiyat*$d->adet);
}


echo "
<li>
<span style=\"float:right;width:100;\">Toplam : $sepet_toplam TL</span>
</li>
";

echo "</ul></div>";
tema_tablo_kapat();

$toplam=$sepet_toplam+$siparis_toplam;


tema_tablo_ac("Hesab");

if(!$kargo)
$kargo=0;

$genel=$toplam+$kargo;

echo "<div class=sepet><table>
<tr><td>Onay Bekleyen Siparişler Toplam : </td><td width=50>$siparis_toplam TL</td></tr>
<tr><td>Sepetim Toplam : </td><td width=50>$sepet_toplam TL</td></tr>
<tr><td>Ödeme Ek Ücreti (Kargo) : </td><td width=50><div id=kargo_ucreti>$kargo TL</div></td></tr>
<tr><td>Genel Toplam : </td><td><div class=genel-toplam id=genel_toplam>$genel TL</div></td></tr>
</table></div>";

tema_tablo_kapat();


if(onay_bekleyen==1)
tema_tablo_ac("Ödeme Şekli Değiştir");
else
tema_tablo_ac("Ödeme Şekli");


$sql=mysql_query("SELECT * FROM odemeler");

echo "<div class=odeme><ul>";


while($s=mysql_fetch_object($sql)){
if($toplam>=$s->asgari && $s->azami>$toplam){

echo "<li class=odeme  onclick=\"sec(this,$s->no);hesapla($s->fiyat,$toplam);\">";
echo " <input type=radio name=cek id=cek_$s->no ><b>$s->ad </b><br>
 $s->aciklama";
echo "</li>";


$kargo=$s->fiyat;}
}

echo "</ul></div>";

tema_tablo_kapat();
tema_tablo_ac("Satın Al");

echo "<form action=islem.php method=post>";

echo "<br><div class=sozlesme>".ayar_al("sozlesme")."</div><br>";
echo "<input type=hidden name=islem value='siparis_et'>";

if($onay_bekleyen==1){
echo "<input type=hidden name=siparis_varmi value=1>";
echo "<input type=hidden name=siparis_no value=$siparis_no>";
}

echo "<input type=hidden name=odeme id=odeme >";
echo "<input type=checkbox   id=sozlesme_onay onclick=\"sozlesme()\" > Sözleşmeyi kabul ediyorum.<br>";
echo "<input type=submit id=sozlesme_dugme class='dugme dugme-left-sifir' value='Satın Al' disabled>";


tema_tablo_kapat();
echo "</form>";
}
require_once "2.php";
?> 

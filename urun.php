<?
include "1.php";

$m="teknomodi_$get->no";
if($cookie->$m!="aza")
{
$cookie->yap("$m","aza");
mysql_query("UPDATE urunler SET sayac=sayac+1 WHERE no=$get->no")or die("Sayaç hata! ".mysql_error());
}



$sql=mysql_query("SELECT * FROM urunler WHERE no=$get->no");
$s=mysql_fetch_object($sql);

$sqlak=mysql_query("SELECT * FROM kategoriler WHERE no='$s->kno'");
$ak=mysql_fetch_object($sqlak);


$sqlk=mysql_query("SELECT * FROM kategoriler WHERE no='$ak->kno'");
$k=mysql_fetch_object($sqlk);



print "<title>$s->ad</title>";

echo "
<script type=text/javascript language=javascript src=ekle/resim/lytebox.js></script>
<link rel=stylesheet href=ekle/resim/lytebox.css type=text/css media=screen />
<script type=text/javascript src=ekle/resim/reflex.js></script>
";


echo "
<div class=tablo>
<div class=tablo-baslik>
<span class=urun-baslik> $s->ad</span> <br>
<span class=urun-adres><a href=liste.php>Ürünler / 
</a><a href=liste.php?akno=$ak->no&kno=$k->no>$k->kategori - $ak->kategori /</a></span>
</div>
";


$resim=urun_resim($s->no);

echo "<div class=urun-cerceve>";
print "<div class='urun-resim '>";
$dizin="resimler/$s->no/";
if(file_exists($dizin)){
$d=opendir($dizin);
$i=0;
while($g=readdir($d))
{
if($g!=".." && $g!="." && $g!="kapak"){
print "<a href='$dizin/$g' rel='lytebox[onder]'  ><img   src=$dizin/$g width=90 height=85 border=0>&nbsp;</a>";
$i=$i+1;
// if($i==3){$i=0;print "<br>";}
}
}}

print "<center>Resmi büyütmek için üzerine tıklayın.</center>
<div class=temizle></div>
</div>";




flush();

print "<div class='urun-ayrinti'>";



if($s->indirim==1)print "<img src=tema/indirim.png><br>";

print "<div class='urun-ayrinti-satir'><span class=urun-fiyat>".fiyat($s->fiyat)." TL </span></div>";

if($s->adet<1){
$stok=0;

if($s->durum==3)
$durum=urun_durum(0);
else
$durum=urun_durum($s->durum);

}
else{
$stok=$s->adet;
$durum=urun_durum(3);
}



print "<div class='urun-ayrinti-satir'><b>Stok durum : </b> <span class=urun-tanim>".$durum."</span></div>";

print "<div class='urun-ayrinti-satir'><b>Stok adet : </b> <span class=urun-tanim>$stok</span></div>";
print "<div class='urun-ayrinti-satir'><b>Satış adet : </b> <span class=urun-tanim>$s->satis_adet</span></div>";

print "<div class='urun-ayrinti-satir'><b>Teslim Süresi : </b> <span class=urun-teslim>$s->teslim_suresi gün </span></div>";
print "<div class='urun-ayrinti-satir'><b>Ürün takip : </b> Bu ürünü $s->sayac kişi takip etmiş</div>";




print "<div class=temizle></div></div>";

echo "</div>";

if(giris()){
print "<div class=urun-cubuk>";
$facebook_url='http://'.$_SERVER['HTTP_HOST']."/urun.php?no=$s->no";
echo "<a class=dugme href=islem.php?no=$get->no&islem=urun_begen><span class=dugme-simge style=\"background:url('tema/begen.png')\"></span>Beğen[$s->begen]</a>";
print "<a class=dugme  href=# onclick=\"window.open('http://www.facebook.com/sharer.php?t=$s->baslik&u=$facebook_url','facebook','width=600,height=500,scrollbars=1')\" ><span class=dugme-simge style=\"background:url('tema/facebook.png')\"></span>Facebook'ta Paylaş</a>";
print "<a class=dugme  href=mesajlarim.php?urun=$s->no><span class=dugme-simge style=\"background:url('tema/urun_soru.png')\"></span>Ürün hakkında soru sor</a>";

print "<div class=urun-sepete-ekle>
<form method=get action='islem.php?islem=sepet_ekle&no=$s->no&islem=ekle'>
 <input class=girdi size=2 value=1 type=text id=adet name=adet>
<input value=$s->no type=hidden name=no id=no>
<a class=dugme  href=# onclick=\"sepete_ekle()\"><span class=dugme-simge style=\"background:url('tema/sepete_ekle.png')\"></span>Sepete Ekle</a>
</form></div>
 ";
print "</div>";
}

if(yonetim())
print "
<div class=urun-cubuk>

<a  class=dugme href=yonetim/urun.php?no=$s->no>Ürünü Düzenle</a>
<a class=dugme  href=yonetim/resim_yukle.php?no=$s->no>Resim Yükle</a>
</div><br>
";


print "<div class=urun-aciklama>";
echo "<span class=urun-aciklama-baslik>İzahat</span><br><br>";
print nl2br($s->aciklama);

print "<div class=temizle></div>";
print "</div>";

echo "</div>";
echo "</div>";

print "<meta name=title content='$s->ad'/>
<link rel=image_src href='$resim'/>
<meta name=description content='$s->aciklama'>";


include "2.php";
?>
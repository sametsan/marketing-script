<?
include "1.php";


echo "
<script>
function kaydet()
{
var ad;
var deger;

var dizi=\"islem.php?islem=profil_duzenle\";

var x=document.getElementById(\"profil_duzenle\");
for (var i=0;i<x.length;i++)
  {
ad=x.elements[i].name;
deger=x.elements[i].value;

dizi+=\"&\"+ad+\"=\"+deger;
  }


location=dizi;

}

</script>

";



if(giris()){
$sql=mysql_query("SELECT * FROM uyeler WHERE no=$session->UYE_no");
$s=mysql_fetch_object($sql);
}

print "<title>$s->ad $s->soyad</title>";

tema_tablo_ac("$s->kullanici");

if(giris()){

switch($get->uyari){
case 1 : print "<div class=uyari>İşlem tamamdır</div>"; break;
case 2 : print "<div class=uyari>Parola eşleşmiyor.Diğer güncellemeler tamamdır.</div>"; break;
}

print "<table border=0 width=100%>";
print "<form id=profil_duzenle action=islem.php?islem=profil_duzenle method=post>";
print "<tr><td>Ad : </td><td><input class=girdi id=ad type=text name=ad value='$s->ad'></td></tr>";
print "<tr><td>Soyad : </td><td><input class=girdi id=soyad type=text name=soyad value='$s->soyad'></td></tr>";
print "<tr><td><br><b>Şifre İşlemleri</b> </td><td></td></tr>";
print "<tr><td>Parola : </td><td><input  class=girdi type=password id=parola name=parola ></td></tr>";
print "<tr><td>Parola Tekrar : </td><td><input class=girdi  id=parola_tekrar type=password name=parola_tekrar ></td></tr>";
print "<tr><td><br><b>İletişim Bilgileri</b> </td><td></td></tr>";
print "<tr><td>Telefon : </td><td><input  class=girdi type=text id=telefon name=telefon value='$s->telefon'></td></tr>";
print "<tr><td>e-posta : </td><td><input  class=girdi type=text id=eposta name=eposta value='$s->eposta' ></td></tr>";
print "<tr><td>İl : </td><td><input  class=girdi type=text id=il name=il value='$s->il' ></td></tr>";
print "<tr><td>İlçe : </td><td><input class=girdi  type=text id=ilce name=ilce value='$s->ilce' ></td></tr>";
print "<tr><td>Adres : </td><td><textarea class=yazialani id=adres name=adres cols=30 rows=5>$s->adres</textarea></td></tr>";
print "<tr><td> </td><td><a class=dugme onclick=\"kaydet()\"><span class=dugme-simge style=\"background:url('tema/kaydet.png')\"></span>Kaydet</a></td></tr>";
print "</form>";
print "</table>";
}
else
header("location:index.php");
tema_tablo_kapat();



include "2.php";
?> 

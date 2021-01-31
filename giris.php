<div class=giris-dis><div class=giris>
<?
if(giris()){


$sqlm=mysql_query("SELECT * FROM mesajlar WHERE uye_no=$session->UYE_no AND uye_ziyaret=0");
$mesaj=mysql_num_rows($sqlm);

$sqls=mysql_query("SELECT * FROM sepet WHERE uye='$session->UYE_no'");
$sepet=mysql_num_rows($sqls);

$sqlk=mysql_query("SELECT * FROM uyeler WHERE no='$session->UYE_no'");
$s=mysql_fetch_object($sqlk);

$sqlq=mysql_query("SELECT * FROM mesajlar WHERE  yonetim_ziyaret=0 ");
$yonetim_mesaj=mysql_num_rows($sqlq);

$sqlb=mysql_query("SELECT * FROM siparisler WHERE  siparis_durum<3 ");
$yonetim_siparisler=mysql_num_rows($sqlb);

$sqlc=mysql_query("SELECT * FROM siparisler WHERE  siparis_durum=0 ");
$yonetim_siparis_yeni=mysql_num_rows($sqlc);


echo "<a class=giris-dugme-sol href=profil.php>$s->ad $s->soyad</a>";
echo "<a class=giris-dugme-sol  href=siparisler.php>Siparişlerim</a>";
echo "<a class=giris-dugme-sol  href=sepetim.php>Sepetim<span class=giris-dugme-kutu>$sepet</span></a>";

echo "<a class=giris-dugme-sol  href=mesajlarim.php>Mesajlar<span class=giris-dugme-kutu>$mesaj</span></a>";

if(yonetim()){

echo "<a class=giris-dugme-sol  href=yonetim/>Yönetim</a>";
 echo "<a class=giris-dugme-sol  href=yonetim/mesajlar.php>Yönetim Mesajlar<span class=giris-dugme-kutu>$yonetim_mesaj</span></a>";

if($yonetim_siparis_yeni>0)
echo "<a class=giris-dugme-sol  href=yonetim/siparisler.php>Yönetim Siparişler<span class=giris-dugme-kutu-yesil>$yonetim_siparisler</span></a>";
else
echo "<a class=giris-dugme-sol  href=yonetim/siparisler.php>Yönetim Siparişler<span class=giris-dugme-kutu>$yonetim_siparisler</span></a>";

}

echo "<a title=Çıkış class='giris-dugme-sag giris-dugme-cikis'  href=islem.php?islem=uye_cikis>Çıkış</a>";
}

else
{

echo "
<script>
function giris()
{
var ad;
var deger;

var dizi=\"islem.php?islem=uye_giris\";

var x=document.getElementById(\"giris\");
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


print "
<div class=giris-giris>
<form id=giris action=islem.php?islem=uye_giris method=post>

<input class='giris-girdi girdi' 

value='Kullanıcı Adı'
onblur=\"if(this.value=='')this.value='Kullanıcı Adı';\" 
onfocus=\"if(this.value=='Kullanıcı Adı')this.value='';\" 
onkeypress=\"if (window.event && window.event.keyCode == 13) {
giris();
} else if (evn && evn.keyCode == 13) {
giris();
}\"

type=text size=13 name=kullanici>
<input class='giris-girdi girdi' 

value='Parola'
onblur=\"if(this.value=='')this.value='Parola';\" 
onfocus=\"if(this.value=='Parola')this.value='';\" 
onkeypress=\"if (window.event && window.event.keyCode == 13) {
giris();
} else if (evn && evn.keyCode == 13) {
giris();
}\"

type=password size=13 name=parola>
<a class=dugme onclick=\"giris()\"><span class=dugme-simge style=\"background:url('tema/giris.png')\"></span>Giriş</a>

</form>

</div>

<a class=giris-dugme-sag href=uyeol.php>Üye Ol</a>
 <a class=giris-dugme-sag href=sifre_yenile.php>Şifremi Unuuttum</a>

";
}

?> </div>
</div>


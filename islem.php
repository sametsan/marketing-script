<?
require_once "1.php";


if($get->islem)
$is = $get->islem;
if($post->islem)
$is= $post->islem;

tema_tablo_ac("??lem sonucu!");
echo "<br><br><center>";
switch($is)
{
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // 
case "sifre_yenile";

if(!$post->kullanici || !$post->eposta){
print "Bo?luklar? doldurun!"; break;}


$sql=mysql_query("SELECT * FROM uyeler WHERE kullanici='$post->kullanici'");

if(!$s=mysql_fetch_object($sql)){
print "Böyle bir kullan?c? yok.";break;}

if($post->eposta!=$s->eposta){
print "e-posta yanl??.";break;}

$sifre=rand(100000,999999); 
$md5=md5($sifre);

mysql_query("UPDATE uyeler SET parola='$md5' WHERE no='$s->no'");

$mesaj="
Teknomodi.CoM ?ifre Yenileme<br><br>

?ifre yenileme talebinde bulundunuz.<br><br>

Yeni ?ifreniz : $sifre <br>

Giri? yapmak için t?klay?n?z : <a href=http://www.teknomodi.com/giris.php>http://www.teknomodi.com/giris.php</a>
";

$baslik= 'MIME-Version: 1.0' . "\r\n";
$baslik.= 'Content-type: text/html; charset=utf-8' . "\r\n";
$baslik.= "From: TeknoModi.CoM <".ayar_al("site_eposta").">\r\n";
$baslik .= "To: $s->kullanici <$s->eposta>\r\n";
$baslik .= 'X-Mailer: PHP/' . phpversion() . "\r\n";


$posta=mail("$s->eposta","Teknomodi.CoM ?ifre Yenileme // $s->eposta","$mesaj",$baslik);

if($posta==TRUE)
print "$s->eposta | ?ifreniz e-posta adresinize gönderildi.";
else
print "Bir hata olu?tu.?ifreniz e-posta adresinize gönderilemedi.<br> Lütfen <a href=iletisim.php>ileti?ime</a> geçiniz.";



break;
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // 
case "uye_giris";

if(!$get->kullanici || !$get->parola){
print "Bo?luklar? doldurun!"; break;}

$sql=mysql_query("SELECT * FROM uyeler WHERE kullanici='$get->kullanici'");
if(!$s=mysql_fetch_object($sql)){
print "Böyle bir kullan?c? yok.";break;}

if(md5($get->parola)!=$s->parola){
print "?ifre yanl??.";break;}

$session->yap("UYE_no",$s->no);
$session->yap("UYE_parola",$s->parola);
print "Üye giri?i ba?ar?l?";
header("location:index.php");
break;
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // 
case "yonetici_giris";

if(!$post->kullanici || !$post->parola){
print "Bo?luklar? doldurun!"; break;}

$sql=mysql_query("SELECT * FROM uyeler WHERE kullanici='$post->kullanici' AND yetki=1");
if(!$s=mysql_fetch_object($sql)){
print "Böyle bir kullan?c? yok.";break;}

if(md5($post->parola)!=$s->parola){
print "?ifre yanl??.";break;}

$session->yap("UYE_no",$s->no);
$session->yap("UYE_parola",$s->parola);
print "Üye giri?i ba?ar?l?";
header("location:yonetim/");
break;

// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // 
case "uye_cikis":
$session->yap("UYE_no","");
$session->yap("UYE_parola","");
header("location:index.php");
break;
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // d
case "sepet_ekle":
if(!giris())
header("location:giris.php");
mysql_query("INSERT INTO sepet (uye,urun,adet) VALUES ('$session->UYE_no','$get->no','$get->adet')");
header("location:$server->HTTP_REFERER");
break;
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // d
case "sepet_bosalt":
if(!giris())
header("location:giris.php");
mysql_query("DELETE FROM sepet WHERE uye='$session->UYE_no'");
header("location:$server->HTTP_REFERER");
break;
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // dd
case "sepet_kaldir":
if(!giris())
header("location:giris.php");
mysql_query("DELETE FROM sepet WHERE no='$get->no'");
header("location:$server->HTTP_REFERER");
break;
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // d
case "siparis_et":
if(!giris())
header("location:giris.php");


$sql=mysql_query("SELECT * FROM sepet WHERE uye='$session->UYE_no'");
if(!$sql){
print "Sepetiniz bo?.";break;}



$kalan=flood(60);
if($kalan>0){
print $kalan ." sn sonra deneyin..";break;}



$sqlf=mysql_query("SELECT * FROM odemeler WHERE no='$post->odeme'");
$f=mysql_fetch_object($sqlf);

if($post->siparis_varmi!=1){

mysql_query("INSERT INTO siparisler 
(uye_no,siparis_odeme,siparis_odeme_fiyat) 
VALUES 
('$session->UYE_no','$f->ad','$f->fiyat')")or die(mysql_error());

$sqlm=mysql_query("SELECT * FROM siparisler WHERE uye_no='$session->UYE_no' ORDER BY no DESC");
$m=mysql_fetch_object($sqlm);
$kno=$m->no;
}
else
{

$kno=$post->siparis_no;

mysql_query("UPDATE siparisler SET siparis_odeme='$f->ad' WHERE no='$post->siparis_no'");
mysql_query("UPDATE siparisler SET siparis_odeme_fiyat='$f->fiyat' WHERE no='$post->siparis_no'");

}


while($d=mysql_fetch_object($sql))
{
$sqlc=mysql_query("SELECT * FROM urunler WHERE no='$d->urun'");
$c=mysql_fetch_object($sqlc);

$tarih=date("d.m.Y");
$saat=date("H:i:s");

mysql_query("INSERT INTO siparisler_liste (kno,urun_no,urun_fiyat,urun_adet,tarih,saat) 
VALUES ('$kno','$d->urun','$c->fiyat','$d->adet','$tarih','$saat')")or die(mysql_error());

$adet=$d->adet;

mysql_query("UPDATE urunler SET adet=adet-$adet WHERE no='$d->urun'");

}

mysql_query("DELETE FROM sepet WHERE uye='$session->UYE_no'")or die(mysql_error());
echo "??leminiz tamamd?r...";


break;
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // 
case "urun_soru":
if(!giris())
header("location:giris.php");
$l=flood(15);
if($l>0){
header("location:urun_soru.php?uyari=3&urun=$post->urun");$hata=1;}

if( !$post->mesaj){
header("location:urun_soru.php?uyari=2&urun=$post->urun");$hata=1;}
$zaman=date("d.m.y H:i:s");
if(!$hata){
mysql_query("INSERT INTO mesajlar (yazan,uye_no,urun_no,mesaj,uye_ziyaret,zaman) VALUES ('$session->UYE_no','$session->UYE_no','$post->urun','$post->mesaj',1,'$zaman')");
header("location:urun_soru.php?uyari=1&urun=$post->urun");
}
break;
// // // // // // // // // // // // // // // // // // // // // // // 
case "urun_begen":
mysql_query("UPDATE urunler SET begen=begen+1 WHERE no='$get->no'");
$cookie->yap($get->no,"begen");
header("location:$server->HTTP_REFERER");
break;
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // d
case "profil_duzenle";
mysql_query("UPDATE uyeler SET ad='$get->ad' WHERE no=$session->UYE_no")or die(mysql_error());
mysql_query("UPDATE uyeler SET soyad='$get->soyad' WHERE no=$session->UYE_no")or die(mysql_error());
mysql_query("UPDATE uyeler SET telefon='$get->telefon' WHERE no=$session->UYE_no")or die(mysql_error());
mysql_query("UPDATE uyeler SET eposta='$get->eposta' WHERE no=$session->UYE_no")or die(mysql_error());
mysql_query("UPDATE uyeler SET adres='$get->adres' WHERE no=$session->UYE_no")or die(mysql_error());
mysql_query("UPDATE uyeler SET il='$get->il' WHERE no=$session->UYE_no")or die(mysql_error());
mysql_query("UPDATE uyeler SET ilce='$get->ilce' WHERE no=$session->UYE_no")or die(mysql_error());
if($get->parola)
if($get->parola==$get->parola_tekrar)
{
mysql_query("UPDATE uyeler SET parola='".md5($get->parola)."' WHERE no=$session->UYE_no")or die(mysql_error());
$session->yap("UYE_parola",md5($get->parola));
}
else
header("location:profil.php?uyari=2");
header("location:profil.php?uyari=1");
break;
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // dd
}

echo "<br><br>";
tema_tablo_kapat();

require_once "2.php";
?> 
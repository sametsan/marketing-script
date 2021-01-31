<?
include "1.php";


if($get->islem=="ekle"){

if($post->parola!=$post->parola_tekrar){$uyari=2;$hata=1;}

if(strstr($post->kullanici," ")){$uyari=5;$hata=1;}

if(strlen($post->kullanici)<5){$uyari=6;$hata=1;}

if(strlen($post->parola)<6){$uyari=7;$hata=1;}



if(!$post->parola || !$post->parola_tekrar || !$post->kullanici || !$post->ad || !$post->soyad || !$post->adres || !$post->telefon || !$post->eposta|| !$post->il|| !$post->ilce){
$uyari=3;$hata=1;}

$sql=mysql_query("SELECT * FROM uyeler WHERE kullanici='$post->kullanici'");
if(mysql_fetch_array($sql))
{
$uyari=4;$hata=1;
}


if($hata!=1){
$parola=md5($post->parola);
mysql_query("INSERT INTO uyeler (kullanici,parola,ad,soyad,adres,telefon,eposta,il,ilce) VALUE ('$post->kullanici','$parola','$post->ad','$post->soyad','$post->adres','$post->telefon','$post->eposta','$post->il','$post->ilce')");
header("location:?uyari=1");
}
}


print "<title>Üye Ol</title>";
tema_tablo_ac("Üye Ol");

if($get->uyari)
$uyari=$get->uyari;

switch($uyari){
case 1 : print "<div class=uyari>Üyelik işleminiz tamamdır.</div>"; break;
case 2 : print "<div class=uyari>Parola eşleşmiyor.</div>"; break;
case 3 : print "<div class=uyari>Boşlukları doldurun</div>"; break;
case 4 : print "<div class=uyari>Böyle bir kullanıcı var.</div>"; break;
case 5 : print "<div class=uyari>Kullanıcı adınızda boşluk kullanmayınız.</div>"; break;
case 6 : print "<div class=uyari>Kullanıcı adınız en az 5 karakter.</div>"; break;
case 7 : print "<div class=uyari>Parola en az 6 karakter.</div>"; break;
}

print "<table border=0 width=100%>";
print "<form action=?islem=ekle method=post>";
print "<tr><td>Ad : </td><td><input class=girdi type=text name=ad value=\"$post->ad\"></td></tr>";
print "<tr><td>Soyad : </td><td><input class=girdi type=text name=soyad value=\"$post->soyad\"></td></tr>";
print "<tr><td>Kullanıcı Adı : </td><td><input class=girdi type=text name=kullanici value=\"$post->kullanici\"></td></tr>";
print "<tr><td>Parola : </td><td><input class=girdi type=password name=parola  value=\"$post->parola\"></td></tr>";
print "<tr><td>Parola Tekrar : </td><td><input class=girdi type=password name=parola_tekrar  value=\"$post->parola_tekrar\"></td></tr>";
print "<tr><td>Telefon : </td><td><input class=girdi type=text name=telefon  value=\"$post->telefon\"></td></tr>";
print "<tr><td>E-posta : </td><td><input class=girdi type=text name=eposta  value=\"$post->eposta\"></td></tr>";
print "<tr><td>İl : </td><td><input class=girdi type=text name=il  value=\"$post->il\"></td></tr>";
print "<tr><td>İlçe : </td><td><input class=girdi type=text name=ilce  value=\"$post->ilce\"></td></tr>";
print "<tr><td>Adres : </td><td><textarea class=yazialani name=adres cols=30 rows=5>$post->adres</textarea></td></tr>";
print "<tr><td> </td><td><input type=submit value='Kaydet' ></td></tr>";
print "</form>";
print "</table>";

tema_tablo_kapat();

include "2.php";
?> 

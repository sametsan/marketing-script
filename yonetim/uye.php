<?
require_once "1.php";

if($get->islem=="duzenle"){
mysql_query("UPDATE uyeler SET kullanici='$post->kullanici' WHERE no=$get->no")or die(mysql_error());
mysql_query("UPDATE uyeler SET yetki='$post->yetki' WHERE no=$get->no")or die(mysql_error());
 mysql_query("UPDATE uyeler SET ad='$post->ad' WHERE no=$get->no")or die(mysql_error());
mysql_query("UPDATE uyeler SET soyad='$post->soyad' WHERE no=$get->no")or die(mysql_error());
 mysql_query("UPDATE uyeler SET telefon='$post->telefon' WHERE no=$get->no")or die(mysql_error());
mysql_query("UPDATE uyeler SET eposta='$post->eposta' WHERE no=$get->no")or die(mysql_error());
mysql_query("UPDATE uyeler SET adres='$post->adres' WHERE no=$get->no")or die(mysql_error());
mysql_query("UPDATE uyeler SET il='$post->il' WHERE no=$get->no")or die(mysql_error());
mysql_query("UPDATE uyeler SET ilce='$post->ilce' WHERE no=$get->no")or die(mysql_error());

if($post->parola)
if($post->parola==$post->parola_tekrar)
{
mysql_query("UPDATE uyeler SET parola='".md5($post->parola)."' WHERE no=$get->no")or die(mysql_error());
$session->yap("UYE_parola",md5($post->parola));
}
else
header("location:?uyari=2&no=$get->no");

 header("location:?uyari=1&no=$get->no");
}


$sql=mysql_query("SELECT * FROM uyeler WHERE no=$get->no");
$s=mysql_fetch_object($sql);


print "<title>$s->ad $s->soyad</title>";
print "<div class=tablo>";
print "<div class=tablo-baslik>
<div class=tablo-baslik-sol></div>
<div class=tablo-baslik-sag></div>
<div class=tablo-baslik-orta>$s->kullanici</div>
</div>
";
print "<div class=tablo-orta>";
if(giris()){

switch($get->uyari){
case 1 : print "<div class=uyari>İşlem tamamdır</div>"; break;
case 2 : print "<div class=uyari>Parola eşleşmiyor.Diğer güncellemeler tamamdır.</div>"; break;
}

print "<table border=0 width=100%>";
print "<form action=?islem=duzenle&no=$get->no method=post>";
print "<tr><td>Kullanıcı Adı : </td><td><input type=text name=kullanici value='$s->kullanici'></td></tr>";
if($s->yetki==1)
print "<tr><td>Yönetici yap : </td><td><input type=checkbox name=yetki value=1 checked></td></tr>";
else
print "<tr><td>Yönetici yap : </td><td><input type=checkbox name=yetki value=1></td></tr>";
print "<tr><td>Ad : </td><td><input type=text name=ad value='$s->ad'></td></tr>";
print "<tr><td>Soyad : </td><td><input type=text name=soyad value='$s->soyad'></td></tr>";
print "<tr><td>Parola : </td><td><input type=password name=parola ></td></tr>";
print "<tr><td>Parola Tekrar : </td><td><input type=password name=parola_tekrar ></td></tr>";
print "<tr><td>Telefon : </td><td><input type=text name=telefon value='$s->telefon'></td></tr>";
print "<tr><td>e-posta : </td><td><input type=text name=eposta value='$s->eposta' ></td></tr>";
print "<tr><td>İl : </td><td><input type=text name=il value='$s->il' ></td></tr>";
print "<tr><td>ilçe : </td><td><input type=text name=ilce value='$s->ilce' ></td></tr>";
print "<tr><td>Adres : </td><td><textarea name=adres cols=30 rows=5>$s->adres</textarea></td></tr>";
print "<tr><td> </td><td><input type=submit value='Kaydet' ></td></tr>";
print "</form>";
print "</table>";
}
else
header("location:giris.php");
print "<div class=temizle></div>";
print "</div>";
print "<div class=temizle></div>";
print "</div><br>";

require_once "2.php";
?> 

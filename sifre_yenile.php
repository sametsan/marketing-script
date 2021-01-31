<?
require_once "1.php";


tema_tablo_ac("Yeni Şifre Ver");


print "<center>
<form action=islem.php?islem=sifre_yenile method=post>
<table>
<tr><td>Kullanıcı Adı : </td><td><input class=girdi type=text size=13 name=kullanici></td></tr>
<tr><td>e-posta : </td><td><input class=girdi type=text size=13 name=eposta></td></tr>
<tr><td></td><td><input type=submit value=Gönder></td></tr>
</form>
</table>
";


tema_tablo_kapat();
require_once "2.php";
?> 

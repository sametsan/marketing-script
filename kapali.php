<?
require_once "bas.php";
if(ayar_al("site_kapali")==1 && $get->k!=1){
header("location:kapali.php?k=1");
}



if($get->k==1){

if(ayar_al("site_kapali")!=1){
header("location:index.php");
}


echo "<center>";
echo "<div class=kapali></div>";
echo "<div class=kapali-aciklama>".ayar_al("site_kapali_aciklama");

print "<center>
<form action=islem.php?islem=yonetici_giris method=post>
<h3>Yönetici Giriş</h3>
<table>
<tr><td>Kullanıcı Adı : </td><td><input type=text size=13 name=kullanici></td>
<td>Şifre : </td><td><input type=password size=13 name=parola></td><td> </td><td><input type=submit value=Giriş></td></tr>
</form>
</table>
";
echo "<div class=temizle></div></div>";
}

?>
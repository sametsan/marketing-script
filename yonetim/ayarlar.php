<?
require_once "1.php";

if($get->islem=="kaydet")
{

ayar_ver("site_baslik",$post->site_baslik);
ayar_ver("site_tanim",$post->site_tanim);
ayar_ver("site_eposta",$post->site_eposta);

ayar_ver("vitrin_satir",$post->vitrin_satir);
ayar_ver("vitrin_sutun",$post->vitrin_sutun);

ayar_ver("ftp_adres",$post->ftp_adres);
ayar_ver("ftp_kullanici",$post->ftp_kullanici);
ayar_ver("ftp_parola",$post->ftp_parola);

ayar_ver("site_kapali",$post->site_kapali);
ayar_ver("site_kapali_aciklama",$post->site_kapali_aciklama);


 header("location:?uyari=1");
}


switch($get->uyari){
case 1 : echo "<div class=uyari>İşlem tamamdır.</div><br>";break;
}


echo "<div class=tablo>";
echo "<div class=tablo-orta>";
echo "<h3>Ayarlar</h3>";

echo "<table width=100%>";
echo "<form action=?islem=kaydet method=post>";
echo "<tr><td>Site Başlık : </td><td><input type=text name=site_baslik value='".ayar_al("site_baslik")."'></td></tr>";
echo "<tr><td>Site Tanım : </td><td><input type=text name=site_tanim value='".ayar_al("site_tanim")."'></td></tr>";

echo "<tr><td>Vitrin Satır Sayısı : </td><td><input type=text name=vitrin_satir value='".ayar_al("vitrin_satir")."'></td></tr>";
echo "<tr><td>Vitrin Sütun Sayısı : </td><td><input type=text name=vitrin_sutun value='".ayar_al("vitrin_sutun")."'></td></tr>";

echo "<tr><td>e-posta : </td><td><input type=text name=site_eposta value='".ayar_al("site_eposta")."'></td></tr>";

echo "<tr><td>FTP Adres : </td><td><input type=text name=ftp_adres value='".ayar_al("ftp_adres")."'></td></tr>";
echo "<tr><td>FTP Kullanıcı Adı : </td><td><input type=text name=ftp_kullanici value='".ayar_al("ftp_kullanici")."'></td></tr>";
echo "<tr><td>FTP Parola : </td><td><input type=password name=ftp_parola value='".ayar_al("ftp_parola")."'></td></tr>";


if(ayar_al("site_kapali")==1)
$check="checked";
echo "<tr><td>Site Kapalı : </td><td><input type=checkbox value=1 name=site_kapali $check></td></tr>";
echo "<tr><td>Site Kapalı Açıklama : </td><td><input type=text name=site_kapali_aciklama value='".ayar_al("site_kapali_aciklama")."'></td></tr>";



echo "<tr><td></td><td><input type=submit  value='Kaydet'></td></tr>";
echo "</form>";
echo "</table>";
echo "</div>";
echo "</div>";

require_once "2.php";
?> 

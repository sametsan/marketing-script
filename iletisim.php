<?
include "1.php";

if($get->islem=="gonder"){

print "<div class=tablo>";
print "<div class=tablo-orta>";
if($post->adsoyad && $post->eposta && $post->mesaj)
{

$posta=mail(ayar_al("site_eposta"),"Teknomodi.CoM İletişim mesajı // $post->eposta","$post->mesaj","From : <$post->eposta>\r\n");
if($posta==TRUE)
echo "Mesajınız iletilmiştir.Teşekkürler !";
else
echo "Mesajınız ulaşamadı !";


}
else
{
echo "Boşlukları doldurun.";
}
tema_tablo_kapat();

}



if(yonetim())
{
if($get->islem=="duzenle"){

ayar_ver("iletisim",$post->iletisim);

header("location:?");
}}


print "<title>İletişim</title>";
tema_tablo_ac("İletişim");


if(yonetim()){
echo "<script type=text/javascript src=../ekle/whizz.js>
</script>
";


print "
<form action=?islem=duzenle method=post>

<textarea id=edited style='width:100%' name=iletisim cols=70 rows=20 >".ayar_al("iletisim")."</textarea>
<input type=submit value=Kaydet>
</form><br>
"; 
echo "<script>
buttonPath=\"textbuttons\";
makeWhizzyWig(\"edited\", \"bold italic color bullet table fontsize\");
</script>";
 }
else
print nl2br(ayar_al("iletisim"));

tema_tablo_kapat();


tema_tablo_ac("Mesaj Gönder");

echo "<form action=?islem=gonder method=post>";
echo "<table border=0 width=100%>";
echo "<tr><td>Ad Soyad*  </td><td><input class=girdi type=text name=adsoyad></td></tr>";
echo "<tr><td>e-posta* </td><td><input class=girdi type=text name=eposta></td></tr>";
echo "<tr><td>Mesaj* </td><td><textarea class=yazialani cols=60 rows=5 name=mesaj></textarea></td></tr>";
echo "<tr><td> </td><td><input type=submit value='Gönder'></td></tr>";
echo "</table>";
echo "</form>";

tema_tablo_kapat();


include "2.php";
?> 

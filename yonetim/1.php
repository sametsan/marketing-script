<?
require_once "bas.php";
?>
<script type="text/javascript" src="../ekle/whizz.js"></script> 


<?

if(!yonetim())
header("location:../giris.php");



echo "<div class=baslik>
<a href=../>".ayar_al("site_baslik")."</a>
</div>";

print "<div class=menu>
<a class=menu-dugme href=index.php>Anasayfa</a>
<a class=menu-dugme  href=siparisler.php>Siparişler</a>
<a class=menu-dugme  href=kategoriler.php>Ürünler</a>
<a class=menu-dugme  href=uyeler.php>Üyeler</a>
<a class=menu-dugme  href=mesajlar.php?sira=yeni>Mesajlar</a>
<a class=menu-dugme  href=karsilama.php>Reklamlar</a>
<a class=menu-dugme  href=alt.php>Alt</a>
<a class=menu-dugme  href=sozlesme.php>Satış Sözleşmesi</a>
<a class=menu-dugme  href=aktif.php>Aktif Olanlar</a>
<a class=menu-dugme  href=duyuru.php>Duyuru</a>
<a class=menu-dugme  href=odemeler.php>Ödemeler</a>
<a class=menu-dugme  href=ayarlar.php>Ayarlar</a>
<a class=menu-dugme  href=baslik.php>Başlık</a>
</div><br>";
echo "<div class=ana>";
echo"<div class=orta>";

?> 

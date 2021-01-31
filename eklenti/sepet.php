<?

if(giris()){
tema_eklenti_ac("Sepetim");

echo "<div class=sepetim-cubuk>";
echo "<a class=dugme href=sepetim.php><span class=dugme-simge style=\"background:url('tema/sepete_ekle.png')\"></span>Sepetim</a> ";
echo "<a  class=dugme  href=islem.php?islem=sepet_bosalt><span class=dugme-simge style=\"background:url('tema/sepet_bosalt.png')\"></span>Boşalt</a>";
echo "</div>";


$sql=mysql_query("SELECT * FROM sepet WHERE uye='$session->UYE_no'");

echo "<ul>";
while($d=mysql_fetch_object($sql)){
$sqlf=mysql_query("SELECT * FROM urunler WHERE no=$d->urun");
$f=mysql_fetch_object($sqlf);


echo "<li>";
echo "<a href=urun.php?no=$f->no>
<img class=resim src=resimler/$f->no/$f->resim>
<span class=baslik>[$d->adet] $f->ad</span>
</a>";

echo "</li>";



//tema_urun_ufak($f,"[$d->adet]");
}

echo "</ul>";






tema_eklenti_kapat();

}

?>

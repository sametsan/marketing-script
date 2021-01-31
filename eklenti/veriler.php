<?

tema_eklenti_ac("Veriler");
echo "<div class=eklenti-orta-bosluk>";
$sql=mysql_query("SELECT * FROM urunler");
$s=mysql_num_rows($sql);
print "Ürün Sayısı : <b>$s</b> <br>";


print "Şu anda aktif misafir : <b> ".online_misafir()."</b> kişi<br>";
print "Şu anda aktif üye : <b> ".online_uye()."</b> kişi";
echo "</div>";
tema_eklenti_kapat();
?>
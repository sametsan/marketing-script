<?;

tema_eklenti_ac("Beğenilenler");

$i=0;
$a=0;
$sql=mysql_query("SELECT * FROM urunler ORDER BY begen DESC");

echo "<ul>";

while($s=mysql_fetch_object($sql))
{
if($i==5)break;
echo "<li onmouseover=\"urun_goster('begen_$s->no',1)\" onmouseout=\"urun_goster('begen_$s->no',0)\">";

echo "<a href=urun.php?no=$s->no>
<img class=resim src=resimler/$s->no/$s->resim>
<span class=baslik>$s->ad</span>
</a>";

echo "<div id=begen_$s->no class=eklenti-liste-urun>";
echo "<div class=eklenti-liste-urun-resim><img src=resimler/$s->no/$s->resim width=140></div>";

if($s->adet>0)
$durum=urun_durum(3);
else
$durum=urun_durum($s->durum);

echo "<div class=eklenti-liste-urun-aciklama><span class=eklenti-liste-urun-baslik>$s->ad</span><br><br>
<span class=urun-fiyat>".fiyat($s->fiyat)." TL</span><br><br>
<span class=urun-durum>$durum</span><br><br>
Bu ürünü $s->begen kişi beğenmiş $s->sayac kişi takip etmiş.
</div>";

echo "</div>";



echo "</li>";

//tema_urun_ufak($s);
$i=$i+1;
}
echo "</ul>";
tema_eklenti_kapat();




?>
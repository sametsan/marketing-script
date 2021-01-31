<?

function tema_tablo_ac($baslik="")
{
print "<div class=tablo>";
if($baslik)
print "<div class=tablo-baslik>$baslik</div>";
print "<div class=tablo-orta>";
}

function tema_tablo_kapat()
{
print "<div class=temizle></div>";
print "</div>";
print "<div class=temizle></div>";
print "</div>";
}

function tema_eklenti_ac($baslik="")
{
print "<div class=eklenti>";
print "<div class=eklenti-baslik>$baslik</div>";
print "<div class=eklenti-orta>";
}

function tema_eklenti_kapat()
{
print "<div class=temizle></div>";
print "</div>";
print "<div class=temizle></div>";
print "</div>";
}

function tema_urun_kucuk($s)
{

if($s->indirim==1)
echo "<div class=urun-kucuk-indirimli>";
else
print "<div class=urun-kucuk>";


$resim=urun_resim($s->no);


if($s->adet>0)
$durum=urun_durum(3);
else
$durum=urun_durum($s->durum);

echo "<div class=urun-kucuk-resim><a href=urun.php?no=$s->no><img alt='Resim Yok' title='$s->ad' src='$resim' border=0></a></div>";

print "<div class=urun-kucuk-ad><a class=urun-ad title=\"$s->ad\" href=urun.php?no=$s->no>$s->ad</a></div>";





if(is_float($s->eski_fiyat))
$eski_fiyat=$s->eski_fiyat;
else
$eski_fiyat=$s->eski_fiyat.".00";

print "<div class=urun-kucuk-eski-fiyat>";
if($s->indirim==1){

echo "$eski_fiyat TL";

}
echo "</div>";

if(is_float($s->fiyat))
$fiyat=$s->fiyat;
else
$fiyat=$s->fiyat.".00";

print "<div class=urun-kucuk-fiyat>".fiyat($s->fiyat)." TL </div>";
print "<div class=urun-kucuk-tanim>$durum</div>";
print "</div>";
}

function tema_urun_ufak($s,$d="")
{
$resim=urun_resim($s->no);

print "<div class=urun-ufak>";
echo "<div class=urun-ufak-resim><img src=$resim width=40 align=left></div>";
print "<div class=urun-ufak-ad><a title=\"$s->ad\" href=urun.php?no=$s->no>".substr($s->ad,0,40)."</a><br>";

if(is_float($s->fiyat))
$fiyat=$s->fiyat;
else
$fiyat=$s->fiyat.".00";
print "<span class=urun-ufak-fiyat>$fiyat TL </span>$d<br></div>";


print "</div>";
}



?> 

<?
require_once "1.php";

switch($get->islem)
{
case "ekle":

if(!$post->ad  || !$post->aciklama || !$post->fiyat)
{
print "Boşlukları doldurun.<br>";
$hata=1;
}

if(!is_numeric($post->adet) || !is_numeric($post->teslim_suresi)){
print "Adet veya teslim suresi sayı olmak zorunda...<br>";
$hata=1;
}

if(!$post->indirim)$post->indirim=0;
if(!$post->vitrin)$post->vitrin=0;

if($hata!=1){
$sql=mysql_query("INSERT INTO urunler (kno,ad,durum,aciklama,adet,satis_adet,fiyat,indirim,teslim_suresi,vitrin,vitrin_sira,eski_fiyat)
VALUES ('$post->kategori','$post->ad','$post->durum','$post->aciklama','$post->adet','$post->satis_adet','$post->fiyat','$post->indirim','$post->teslim_suresi','$post->vitrin','$post->vitrin_sira','$post->eski_fiyat')");

if(!$sql) print mysql_error();

$sql=mysql_query("SELECT * FROM urunler order by no desc");
$f=mysql_fetch_object($sql);
header("location:resim_yukle.php?no=$f->no");
}


break;

case "duzenle":
if($post->indirim==1)
$indirim=1;
else
$indirim=0;

if($post->vitrin==1)
$vitrin=1;
else
$vitrin=0;


mysql_query("update urunler set ad='$post->ad' where no=$get->no");
mysql_query("update urunler set kno=$post->kategori where no=$get->no");
mysql_query("update urunler set durum='$post->durum' where no=$get->no");
mysql_query("UPDATE urunler set aciklama='$post->aciklama' WHERE no=$get->no");
 mysql_query("UPDATE urunler set adet=$post->adet WHERE no=$get->no");
 mysql_query("UPDATE urunler set satis_adet=$post->satis_adet WHERE no=$get->no");
 mysql_query("UPDATE urunler set fiyat=$post->fiyat WHERE no=$get->no");
 mysql_query("UPDATE urunler set eski_fiyat=$post->eski_fiyat WHERE no=$get->no");
mysql_query("UPDATE urunler set indirim=$indirim  WHERE no=$get->no");
mysql_query("UPDATE urunler set vitrin=$vitrin  WHERE no=$get->no");
mysql_query("UPDATE urunler set vitrin_sira=$post->vitrin_sira  WHERE no=$get->no");
mysql_query("UPDATE urunler set teslim_suresi=$post->teslim_suresi  WHERE no=$get->no");
print "İşlem tamamdır...<a href='?sayfa=$get->islem&no=$get->no'>Geri</a>";
break;

case "sil":
mysql_query("DELETE FROM urunler WHERE no=$get->no");
if(file_exists("../resimler/$get->no"))
unlink("../resimler/$get->no");
print "İşlem tamamdır...<a href=urunler.php>Geri</a>";
break;

}


$islem="ekle";
$dugme="Kaydet";

if($get->no){
echo "<div class=siparisler-menu>";
echo "<a href=?islem=sil&no=$get->no>Ürünü Sil</a> - <a href=resim_yukle.php?no=$get->no>Resim Yükle</a>";
echo "</div>";
$sql_urun=mysql_query("SELECT * FROM urunler WHERE no=$get->no");
$urun=mysql_fetch_object($sql_urun);
$islem="duzenle";
$dugme="Düzenle";
}

$sqld=mysql_query("SELECT * FROM kategoriler WHERE no='$get->akno' ORDER BY sira");
$d=mysql_fetch_object($sqld);


$sqlf=mysql_query("SELECT * FROM kategoriler WHERE no='$d->kno' ORDER BY sira");
$f=mysql_fetch_object($sqlf);


echo "<hr>";
echo "<a href=kategoriler.php>Kategoriler</a> / ";
echo "<a href=kategoriler.php?no=$f->no>$f->kategori</a> / ";
echo $d->kategori;
echo "<hr>";

print "<form action=?islem=$islem&no=$urun->no method=post>";


print "<fieldset><legend>Kategori</legend>";
print "<select name=kategori>";
$sql=mysql_query("SELECT * FROM kategoriler WHERE kno=0");
while($f=mysql_fetch_object($sql))
{
$sqlk=mysql_query("SELECT * FROM kategoriler WHERE kno=$f->no");
while($c=mysql_fetch_object($sqlk)){
if($get->akno)
$kno=$get->akno;

if($get->no)
$kno=$urun->kno;

if($kno==$c->no)
print "<option value=$c->no SELECTED>$f->kategori - $c->kategori</option>";
else
print "<option value=$c->no>$f->kategori - $c->kategori</option>";

}}
print "</select>";
echo "</fieldset>";


print "<fieldset><legend>Ürün Adı<i>(Zorunlu)</i></legend><input type=text name=ad value='$urun->ad'></fieldset>";

print "<fieldset><legend>Stok durum</legend>";
echo "<table>";

print "<tr><td>Stok Adet : </td><td><input type=text name=adet value='$urun->adet'></td></tr>";

print "<tr><td>Ürün Stokta Bitmiş ise : </td><td>";

$i=0;
foreach(urun_durum() as $durum)
{

if($urun->durum==$i)
echo "<input type=radio name=durum value='$i' checked>$durum<br>";
else
echo "<input type=radio name=durum value='$i'>$durum<br>";

$i=$i+1;
}


echo "</td></tr>";
echo "</table>";
echo "</fieldset>";




print "<fieldset><legend>Satış Adet</legend><input type=text name=satis_adet value='$urun->satis_adet'></fieldset>";

print "<fieldset><legend>Fiyat<i>(Zorunlu)</i></legend><input type=text name=fiyat value='$urun->fiyat'>TL</fieldset>";
print "<fieldset><legend>Teslim Süresi</legend><input type=text name=teslim_suresi value='$urun->teslim_suresi'></fieldset>";

print "<fieldset><legend>İndirim</legend>";
echo "<table>";
if($urun->indirim==1)
print "<tr><td>İndirim : </td><td><input type=checkbox name=indirim value=1 checked></td></tr>";
else
print "<tr><td>İndirim : </td><td><input type=checkbox name=indirim value=1 ></td></tr>";
print "<tr><td>Eski Fiyat : </td><td><input type=text name=eski_fiyat value='$urun->eski_fiyat'></td></tr>";
echo "</table>";
echo "</fieldset>";


print "<fieldset><legend>Vitrin</legend>";
echo "<table>";
if($urun->vitrin==1)
print "<tr><td>Vitrine Ekle : </td><td><input type=checkbox name=vitrin value=1 checked></td></tr>";
else
print "<tr><td>Vitrine Ekle : </td><td><input type=checkbox name=vitrin value=1></td></tr>";
print "<tr><td>Vitrin Sıra : </td><td><input type=text name=vitrin_sira value='$urun->vitrin_sira'></td></tr>";
echo "</table>";
echo "</fieldset>";


print "<fieldset><legend>Açıklama<i>(Zorunlu)</i></legend><textarea  id=edited name=aciklama  style='width:99%;' cols=60 rows=10>$urun->aciklama</textarea></fieldset>";

echo "<script language=\"JavaScript\" type=\"text/javascript\">
buttonPath=\"textbuttons\";
makeWhizzyWig(\"edited\", \"bold italic color bullet table fontsize\");
</script>
";
print "<fieldset><legend>$dugme</legend><input type=submit value='$dugme'></fieldset>";
print "</form>";


require_once "2.php";
?> 

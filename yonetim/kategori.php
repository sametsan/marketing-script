<?
require_once "1.php";

switch($get->islem){

case "sil":
mysql_query("DELETE FROM kategoriler WHERE no='$get->no'");
 header("location:kategoriler.php");

break;

case "duzenle":

mysql_query("UPDATE kategoriler SET kategori='$post->ad' WHERE no='$post->no'");
mysql_query("UPDATE kategoriler SET kno='$post->kategori' WHERE no='$post->no'");

header("location:?kategori_uyari=1&no=$post->no");
break;

case "ekle":
if(!$post->kategori)header("location:?kategori_uyari=2");

mysql_query("INSERT INTO kategoriler (kategori,kno) VALUES ('$post->ad','$post->kategori')")or die(mysql_error());

header("location:?kategori_uyari=1&no=$post->no");
break;

}



switch($get->kategori_uyari){
case 1 : print "İşlem tamamdır.";break;
case 2: print "Resim yüklenemedi.";break;
case 3: print "Boşlukları doldurun.";break;
}





if($get->no)
{
$islem="duzenle";
$sql=mysql_query("SELECT * FROM kategoriler WHERE no='$get->no'");
$s=mysql_fetch_object($sql);
echo "<a href=?islem=sil&no=$get->no>Kategoriyi Sil</a><hr>";
}
else
$islem="ekle";

echo "<form action=?islem=$islem method=post method=post enctype=multipart/form-data>";

echo "<div class=tablo>";
echo "<table width=100%>";
echo "<input type=hidden name=no value=\"$get->no\">";

echo "<tr><td>Kategori Adı</td><td><input type=text name=ad value=\"$s->kategori\"></td></tr>";

echo "<tr><td>Kategori</td><td>";
if($get->kno)
{
$sqlc=mysql_query("SELECT * FROM kategoriler WHERE no='$get->kno'");
$f=mysql_fetch_object($sqlc);
echo "<input type=hidden name=kategori value='$f->no'>$f->kategori";
}
else
{
echo "<input type=hidden name=kategori value='0' >Kategori";
}

echo "</td></tr>";
echo "<tr><td></td><td><input type=submit  value=\"Kaydet\"></td></tr>";
echo "</table>";
echo "</div>";
echo "</form>";
require_once "2.php";

?> 

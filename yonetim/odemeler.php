<?
require_once "1.php";

if($get->islem=="ekle")
{

mysql_query("INSERT INTO odemeler (ad,aciklama,fiyat,asgari,azami) VALUES ('$post->ad','$post->aciklama','$post->fiyat','$post->asgari','$post->azami')");

header("location:?uyari=1");
}


if($get->islem=="sil")
{

mysql_query("DELETE FROM odemeler WHERE no='$get->no'");

header("location:?uyari=1");
}


if($get->islem=="duzenle")
{

mysql_query("UPDATE odemeler SET ad='$post->ad' WHERE no='$get->no'");
mysql_query("UPDATE odemeler SET aciklama='$post->aciklama' WHERE no='$get->no'");
mysql_query("UPDATE odemeler SET fiyat='$post->fiyat' WHERE no='$get->no'");
mysql_query("UPDATE odemeler SET azami='$post->azami' WHERE no='$get->no'");
mysql_query("UPDATE odemeler SET asgari='$post->asgari' WHERE no='$get->no'");


header("location:?uyari=1");
}


switch($get->uyari){
case 1 : echo "<div class=uyari>İşlem tamamdır.</div><br>";break;
}

echo "<div class=tablo>";
echo "<div class=tablo-orta>";
echo "<h3>Ödemeler</h3>";


echo "<table width=100%>";
echo "<tr>";
echo "<td>Ad</td>";
echo "<td>Açıklama</td>";
echo "<td>Fİyat</td>";
echo "<td>Asgari</td>";
echo "<td>Azami</td>";
echo "<td>Kaydet</td>";
echo "<td>Sil</td>";
echo "</tr>";

$sql=mysql_query("SELECT * FROM odemeler");
while($s=mysql_fetch_object($sql)){
echo "<tr><form action=?islem=duzenle&no=$s->no method=post>";
echo "<td><input type=text name=ad value='$s->ad'></td>";
echo "<td><input type=text name=aciklama value='$s->aciklama'></td>";
echo "<td><input type=text size=3 name=fiyat value='$s->fiyat'></td>";
echo "<td><input type=text size=3 name=asgari value='$s->asgari'></td>";
echo "<td><input type=text size=3 name=azami value='$s->azami'></td>";
echo "<td><input type=submit  value='Kaydet'></td>";
echo "<td><a href=?islem=sil&no=$s->no>Sil</a></td>";
echo "</form></tr>";
}

echo "</table>";
echo "</div>";
echo "</div>";



echo "<div class=tablo>";
echo "<div class=tablo-orta>";
echo "<h3>Ödeme Ekle</h3>";

echo "<table width=100%>";
echo "<form action=?islem=ekle method=post>";

echo "<tr><td>Ad : </td><td><input type=text name=ad ></td></tr>";
echo "<tr><td>Açıklama : </td><td><input type=text name=aciklama ></td></tr>";
echo "<tr><td>Ek fiyat : </td><td><input type=text name=fiyat ></td></tr>";
echo "<tr><td>Asgari : </td><td><input type=text name=asgari ></td></tr>";
echo "<tr><td>Azami : </td><td><input type=text name=azami ></td></tr>";

echo "<tr><td></td><td><input type=submit  value='Kaydet'></td></tr>";
echo "</form>";
echo "</table>";
echo "</div>";
echo "</div>";

require_once "2.php";
?> 

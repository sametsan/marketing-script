<?
require_once "1.php";
print "<center>";

if($post->islem=="yukle")
{
$tmp_ad=$_FILES["dosya"]["tmp_name"];
$ad=$_FILES["dosya"]["name"];
$tip2=explode("/",$_FILES["dosya"]["type"]);
$tip=$tip2[1];

switch($post->dizin){
case "sol_reklam":
$adres="../resimler/reklam/$post->dizin/$ad";
$txt="../resimler/reklam/$post->dizin/$ad.txt";
break;
case "sag_reklam":
$adres="../resimler/reklam/$post->dizin/$ad";
$txt="../resimler/reklam/$post->dizin/$ad.txt";
break;
case "ust_reklam":
$adres="../resimler/reklam/$post->dizin/$post->dizin.$tip";
$txt="../resimler/reklam/$post->dizin/$post->dizin.$tip.txt";
break;
case "karsilama":
$adres="../resimler/reklam/$post->dizin/$post->dizin.$tip";
$txt="../resimler/reklam/$post->dizin/$post->dizin.$tip.txt";
break;
}
if(file_exists($adres))
unlink("$adres");

if($post->adres){
$f=fopen($txt,"w");
fwrite($f,$post->adres,strlen($post->adres));
}
        if($d=move_uploaded_file($tmp_ad,$adres))
header("location:?no=$get->no&uyari=1");

}

if($get->islem=="sil")
{
$adres=$get->adres;
if(file_exists($adres))
unlink("$adres");
header("location:?uyari=1");

}


if($get->uyari==1)
print "İşlem tamamdır.<br>";


print "
<form action=?  method=post enctype=multipart/form-data>
<table width=100%><tr><td>
<select name=dizin>
<option value=0>-----------</option>
<option value=karsilama>Karşılama</option>
<option value=sol_reklam>Sol Reklam</option>
<option value=sag_reklam>Sağ Reklam</option>
<option value=ust_reklam>Üst Reklam</option>
</select></td>

<td><input type=file name=dosya></td>
<td>Adres :</td>
<td> <input type=text name=adres></td>
<td><input type=hidden name=islem value=yukle>
<input type=submit value=Yükle></td>
</form></tr></table>";

print "<h3>Kaldır</h3>";

echo "<br><br>Üst Reklam <br>";
$adres="../resimler/reklam/ust_reklam/";
$j=opendir($adres);
while($s=readdir($j)){
if($s!="." && $s!=".." && substr($s,-3,3)!="txt"){
echo "<a target=asdas href=$adres/$s><img height=100 src=$adres/$s></a><br> <a href='?islem=sil&adres=$adres/$s'>Sil</a><br>";
}
}


echo "<table width=100%><tr>";

echo "<td>Sol Reklam<br>";
$adres="../resimler/reklam/sol_reklam/";
$j=opendir($adres);
while($s=readdir($j)){
if($s!="." && $s!=".." && substr($s,-3,3)!="txt"){
echo "<a target=asdas href=$adres/$s><img width=200 src=$adres/$s></a> <br> <a href='?islem=sil&adres=$adres/$s'>Sil</a><br>";
}
}
echo "</td>";

echo "<td>Karşılama <br>";
$adres="../resimler/reklam/karsilama/";
$j=opendir($adres);
while($s=readdir($j)){
if($s!="." && $s!=".." && substr($s,-3,3)!="txt"){
echo "<a target=asdas href=$adres/$s><img width=450 src=$adres/$s></a> <br> <a href='?islem=sil&adres=$adres/$s'>Sil</a><br>";
}
}
echo "</td>";


echo "<td>Sağ Reklam <br>";
$adres="../resimler/reklam/sag_reklam/";
$j=opendir($adres);
while($s=readdir($j)){
if($s!="." && $s!=".." && substr($s,-3,3)!="txt"){
echo "<a target=asdas href=$adres/$s><img width=200 src=$adres/$s></a> <br> <a href='?islem=sil&adres=$adres/$s'>Sil</a><br>";
}
}
echo "</td>";

echo "</tr></table>";
require_once "2.php";
?> 

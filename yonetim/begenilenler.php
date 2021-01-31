<?;

tema_eklenti_ac("Beğenilenler");

$i=0;
$a=0;
$sql=mysql_query("SELECT * FROM urunler ORDER BY begen DESC");
print "<div class=urun-satir>";
while($s=mysql_fetch_object($sql))
{
if($i==1){print "</div><br><div class=urun-satir>";$a=$a+1;;$i=0;}
if($a==5)break;
urun_ufak($s);
$i=$i+1;
}
print "</div><br>";

tema_eklenti_kapat();


?>
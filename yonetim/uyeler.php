<?
require_once "1.php";

switch($get->sayfa)
{
case "sil":
mysql_query("DELETE FROM uyeler WHERE no=$get->no");
header("location:?uyari=1");
break;
}


switch($get->uyari){
case 1 : echo "<div class=uyari>İşlem tamamdır.</div><br>";break;
}

echo "<div class=liste>";
$sql=mysql_query("SELECT * FROM uyeler ORDER BY no DESC");
print "<table  width=100% border=0>";
while($s=mysql_fetch_object($sql))
{

print"
<tr>
<td><a href=uye.php?no=$s->no>$s->kullanici";
if($s->yetki==1)
print " / Yönetici</a></td>";

echo "<td><a href=mesaj.php?uye=$s->no>Mesaj Gönder</a></td>";
print "<td><a href=?sayfa=sil&no=$s->no>Sil</a></td>
</tr>
";

}

print "</table></div>";
require_once "2.php";
?> 

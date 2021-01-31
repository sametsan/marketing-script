<?
require_once "bas.php";

if($post->islem=="begen")
{
mysql_query("UPDATE urunler SET begen=begen+1 WHERE no=$post->no");
$cookie->yap($post->no,"begen");

}

if($post->no)
$sql=mysql_query("SELECT * FROM urunler WHERE no=$post->no");
else
$sql=mysql_query("SELECT * FROM urunler WHERE no=$get->no");

$kayit=mysql_fetch_object($sql);

$b=$kayit->begen-1;

$no=$kayit->no;
if($cookie->$no=="begen"){
print "<input type=button value=\"Beğen[$kayit->begen]\" disabled>";}
else{
print "<input onclick=\"JXP(0,'begen','begen.php','no=$kayit->no&islem=begen')\"  type=button value=\"Beğen[$kayit->begen]\">";
}

?>
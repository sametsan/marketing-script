<?
include "1.php";




if(yonetim())
{

echo "<script type=text/javascript src=../ekle/whizz.js>
</script>
";

if($get->islem=="duzenle"){

ayar_ver("hakkimizda",$post->hakkimizda);
// header("location:?");
}}


print "<title>Hakkımızda</title>";
tema_tablo_ac("Hakkımızda");


if(yonetim()){
print "
<form action=?islem=duzenle method=post>
<textarea id=edited name=hakkimizda style='width:100%' cols=70 rows=20 >".ayar_al("hakkimizda")."</textarea>
<input type=submit value=Kaydet>
</form><br>
<script>
buttonPath=\"textbuttons\";
makeWhizzyWig(\"edited\", \"bold italic color bullet table fontsize\");
</script>
";
}
else
print nl2br(ayar_al("hakkimizda"));

tema_tablo_kapat();


include "2.php";
?> 

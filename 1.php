<center>
<?
require_once "bas.php";

include "giris.php";
?> 


<div class=baslik style="background:url('resimler/tema/<?=ayar_al("site_baslik_resim")?>') no-repeat;">
<div class=baslik-ust-reklam>
<? reklam("ust_reklam");?>
</div>
</div>


<div class=menu>
<?
$menu=array(
array("Ana Sayfa","/index.php"),
array("Ürün Listesi","/liste.php"),
array("Hakkımızda","/hakkimizda.php"),
array("İletişim","/iletisim.php"),
);

foreach($menu as $m)
{
if($server->SCRIPT_NAME==$m[1])
echo "<a class='menu-dugme menu-dugme-secili' href=".$m[1].">".$m[0]."</a>";
else
echo "<a class=menu-dugme href=".$m[1].">".$m[0]."</a>";
echo "<div class=menu-bosluk></div>";
}



?>

<div class=arama>
<div class=arama-girdi>
<input type=text class='arama-gir' 
value='Aradığınız ürün adı girin'
onblur="if(this.value=='')this.value='Aradığınız ürün adı girin';" 
onfocus="if(this.value=='Aradığınız ürün adı girin')this.value='';" 

onkeypress="javascript:if (event.keyCode == 13) ara()" id=ara name=ara value="<?=$get->ara?>">
</div>
<a class=arama-dugme href=# onclick="ara()">Bul</a>
</div>

</div>


<div class=ana>

<div class=sol>
<div id=kategoriler><? include "eklenti/kategoriler.php";?></div><br>
<? include "eklenti/sepet.php";?>
<? include "eklenti/indirimdekiler.php";?>
<? include "eklenti/begenilenler.php";?>
<? include "eklenti/son_eklenenler.php";?>
<? include "eklenti/veriler.php";?><br>
<? reklam("sol_reklam");?>
<div class=temizle></div>
</div>


<div class=orta>
 


function siparis_iptal(no)
{
var sec=confirm("İptal etmek istediğinize emin misiniz?"); 

if(sec==true)
     location="siparisler.php?no="+no+"&sayfa=iptal";
}


function siparis_sil(no)
{
var sec=confirm("Silmek etmek istediğinize emin misiniz?"); 

if(sec==true)
     location="siparisler.php?no="+no+"&sayfa=sil";
}




function uye_siparis_goster(no)
{
document.getElementById("siparisler_"+no).style.display="block";
document.getElementById("siparis_dugme_"+no).innerHTML="  <a onclick=\"uye_siparis_gizle("+no+")\"><img border=0 src=tema/ok_y.png></a>";
}


function uye_siparis_gizle(no)
{
document.getElementById("siparisler_"+no).style.display="none";
document.getElementById("siparis_dugme_"+no).innerHTML="  <a  onclick=\"uye_siparis_goster("+no+")\"><img border=0 src=tema/ok_a.png></a>";
}

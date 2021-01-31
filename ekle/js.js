
function ara()
{
var ara=document.getElementById("ara").value;
 location="liste.php?ara="+ara; 
}

function sepete_ekle()
{
 var no=document.getElementById("no").value;
 var adet=document.getElementById("adet").value;
 location="islem.php?no="+no+"&islem=sepet_ekle&adet="+adet; 
}

function sozlesme_kabul()
{
  var onay=document.getElementById("sozlesme_onay").value;
 
  if(onay==1){
  document.getElementById("sozlesme_dugme").disabled = true;
document.getElementById("sozlesme_onay").value=0;
  }
  else
  {
      document.getElementById("sozlesme_dugme").disabled = false;
document.getElementById("sozlesme_onay").value=1;
  }
  
  }


function siparis_iptal(no,durum)
{
confirm("İptal etmek istediğinize emin misiniz?"); 
  location="yonetim_siparisler.php?no="+no+"&sayfa=iptal&durum="+durum;
}


function urun_goster(id,durum)
{
if(durum==1)
document.getElementById(id).className = "eklenti-liste-urun eklenti-liste-urun-goster";
else
document.getElementById(id).className = "eklenti-liste-urun";
}

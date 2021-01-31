<?php
require('1.php');

function tr($d)
{
return mb_convert_encoding($d,"iso-8859-9","UTF-8");
}

function ad($ad)
{
// $i=0;
// $ad=explode(" ",$ad);
// foreach($ad as $s)
// {
// if($i==3)
// {$d=$d."<br>";$i=0;}
// 
// $i=$i+1;
// $d=$d." $s";
// 
// }
// 
// $ad=$d;
return $ad;
}



$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);


if($get->no){
$sql=mysql_query("SELECT * FROM kategoriler WHERE no='$get->no'");
$d=mysql_fetch_object($sql);
}


if($get->no)
$pdf->Cell(200,2,tr("$d->kategori ürünler katalogu"));
else
$pdf->Cell(200,2,tr("Ürünler katalogu"));


$pdf->Line(10,20,200,20);


$x=10;
$y=25;
$w=46;
$h=58;
$rh=35;
$i=0;
$a=0;

if($get->no)
$sql=mysql_query("SELECT * FROM urunler WHERE kno='$get->no'");
else
$sql=mysql_query("SELECT * FROM urunler ");


while($s=mysql_fetch_object($sql)){

$pdf->SetDrawColor(150);
$pdf->Rect($x,$y,$w,$h);

$resim="../".urun_resim($s->no);
if(file_exists($resim))
{
$u=dosya_uzanti($resim);
if($u=="png" || $u=="jpg" || $u=="jpeg")
$pdf->Image($resim,$x+2,$y+2,$w-4,$rh);
}

$pdf->SetXY($x+2,($rh+$y+2));
$pdf->SetFontSize(7);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell($w-5,5,tr(ad($s->ad)));


$pdf->SetXY($x+15,($rh+$y+10));
$pdf->SetFontSize(15);
$pdf->SetTextColor(255,0,0);
$pdf->Write(20,tr($s->fiyat." TL"));




$x=$x+($w+2);

$i=$i+1;
$a=$a+1;

if($a==4)
{
$a=0;
$y=$y+($h+2);
$x=10;
}

if($i==16)
{


$x=10;
$y=25;
$w=46;
$h=58;
$rh=35;
$i=0;
$a=0;

$pdf->AddPage();
}
}


$pdf->SetXY(10,265);
$pdf->SetFontSize(8);
$pdf->SetTextColor(0,0,0);

$alt=ayar_al("site_baslik")." - ".ayar_al("site_eposta")." - ".$server->HTTP_HOST;
$pdf->Cell(0,10,tr($alt));


$pdf->Output("../resimler/urunler.pdf");


echo "<a href=../resimler/urunler.pdf>PDF DOSYASI indir</a>";

require('2.php');
?>
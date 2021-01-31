
<style>
.kategoriler
{

z-index:9999;
}
.kategoriler ul {
	margin: 0;
	padding: 0;
	list-style: none;
	width: 230px;

}

.kategoriler ul li {
	position: relative;

}

.kategoriler ul li .ok ,.kategoriler ul li ok:hover{ 
position:absolute;
top:8;
right:10;
width:15;
height:15;
background:url("../tema/ok.png");
}


.kategoriler li ul {
z-index:9999;
	position: absolute;
	left: 229px;
	top: 0;
	display: none;
}

.kategoriler ul li a ,.kategoriler ul li a:hover{ 

	display: block; 
	text-decoration: none; 
font-size:1.1em;
	background:#FFF;
	padding: 8px;
	border:1px solid #ccc;
}




.kategoriler ul li a:hover {
color:#333;
background:#eee;
} 
/* IE. gizle \*/ 
* html ul li { float: left; height: 1%; }
* html ul li a { height: 1%; } 
/* IE den gizleme sonu */

.kategoriler li:hover ul, .kategoriler li.over ul { 
	display: block;

}
	
</style>

<script type="text/javascript">
startList = function() {
if (document.all&&document.getElementById) {
navRoot = document.getElementById("menu");
for (i=0; i<navRoot.childNodes.length; i++) {
node = navRoot.childNodes[i];
if (node.nodeName=="LI") {
node.onmouseover=function() {
this.className+=" over";
  }
  node.onmouseout=function() {
  this.className=this.className.replace(" over", "");
   }
   }
  }
 }
}
window.onload=startList;

</script>



<div class=kategoriler>
<ul id="menu">
<?
$sql=mysql_query("SELECT * FROM kategoriler WHERE kno=0 ORDER BY sira");
while($d=mysql_fetch_object($sql))
{
print "<li><a href=#>$d->kategori</a><i class=ok></i>
<ul>";
$sqls=mysql_query("SELECT * FROM kategoriler WHERE kno=$d->no ORDER BY sira");
while($s=mysql_fetch_object($sqls))
print "<li><a href=liste.php?akno=$s->no&kno=$d->no>$s->kategori</a></li>";

echo "</ul></li>";
}

?>
</ul>
</div>

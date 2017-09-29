<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RCN RADIO</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
//-->
</script>
<script type="text/javascript" src="../js/jquery-1.2.6.min.js"></script>
<script type="text/javascript">
			$(document).ready(function(){
				$("div.redes").hide();
				$("a:first").click(function () {
					if ($("div.redes").is(":hidden")) {
						$("div.redes").slideDown("slow");
					} else {
						$("div.redes").slideUp();
					}
				});
				$(".jq-runCode").click(function(){
					$("div.redes").slideUp();
				});
			});
</script></head>

<body>
<div id="header"><?php //include("/home/www/salvation/rcnmundo/reddeportales/header.php"); ?></div>
<div id="container">
  <div class="formulario">
    <h1>&nbsp;</h1>
    <h1>&nbsp;</h1>
    <h1>Gracias por escribirnos. <br />
    Su inscripci&oacute;n fue recibida exitosamente.</h1>
    <p><b>La Direcci&oacute;n Administrativa le dar&aacute; el tr&aacute;mite correspondiente y se contactar&aacute; con usted cuando se requiera su servicio.</b><b>.</b><br />
    </p>
  </div>
  <div class="gracias"></div>
</div>
<div id="footer"><?php //include("/home/www/salvation/rcnmundo/reddeportales/footer.php"); ?></div>
</body>
</html>

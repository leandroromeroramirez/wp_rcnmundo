<?php include ('m1.php'); ?>
<?php require_once('../bd.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO atencionaloyente (nombre, apellido, ano, mes, dia, genero, telefono, email, ciudad, asunto, sistema, ciudad_emisora, mensaje, fecha, hora) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),				   
                       GetSQLValueString($_POST['ano'], "int"),
                       GetSQLValueString($_POST['mes'], "int"),
                       GetSQLValueString($_POST['dia'], "int"),				   				   					   
                       GetSQLValueString($_POST['genero'], "text"),
					   GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['email'], "text"),					   
                       GetSQLValueString($_POST['ciudad'], "text"),
                       GetSQLValueString($_POST['asunto'], "text"),	
                       GetSQLValueString($_POST['sistema'], "text"),	
                       GetSQLValueString($_POST['ciudad_emisora'], "text"),						   					   				   
                       GetSQLValueString($_POST['mensaje'], "text"),
					   GetSQLValueString($_POST['fecha'], "text"),
					   GetSQLValueString($_POST['hora'], "text"));					   

  mysql_select_db($database_audios, $audios);
  $Result1 = mysql_query($insertSQL, $audios) or die(('<html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta http-equiv="Refresh" content="1;url=error.php"></head><body></body></html>'));
  //$Result1 = mysql_query($insertSQL, $audios) or die(mysql_error());  

  $insertGoTo = "gracias.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RCN RADIO | ATENCION AL OYENTE</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' debe escribir un correo electrónico\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' debe escribir números.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' está vacio.\n'; }
    } if (errors) alert('El formulario no está diligenciado correctamente. Por favor, revíselo para realizar el envio.\n');
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
<script language="JavaScript">
function textCounter(field, countfield, maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else 
countfield.value = maxlimit - field.value.length;
}
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js" type="text/javascript"></script>
</head>

<body>
<div id="header"><?php include("/home/www/salvation/rcnmundo/reddeportales/header.php"); ?></div>
<div id="container">
  <div class="formulario">
<p>Respetado Oyente este es un mecanismo creado por RCN Radio para conocer sus quejas, reclamos, sugerencias y comentarios los cuales nos permitir&aacute;n mejorar nuestros productos y servicios.</p>
   	<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onSubmit="return validar(this)">
   	  <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0"><tr><td colspan="2"><table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td><strong>Nombre:</strong></td>
          <td colspan="2"><input name="nombre" type="text" class="cajadetexto" id="nombre" size="40" /></td>
        </tr>
        <tr>
          <td><strong>Apellidos:</strong></td>
          <td colspan="2"><input name="apellido" type="text" class="cajadetexto" id="apellido" size="40" /></td>
        </tr>
        <tr>
          <td><label for="Genero"><strong>Genero:</strong></label></td>
          <td colspan="2">
          	<select name="genero" id="genero">
                <option value="" selected>------</option>
                <option value="Masculino" <?php if (!(strcmp(Masculino, ""))) {echo "SELECTED";} ?>>Masculino</option>
                <option value="Femenino" <?php if (!(strcmp(Femenino, ""))) {echo "SELECTED";} ?>>Femenino</option>                
          	</select>          </td>
        </tr>
        <tr>
          <td><strong>Fecha de nacimiento:</strong></td>
          <td colspan="2">A&ntilde;o:
            <select name="ano" class="cajatexto3">
                <option value="" selected>------</option>
                <option value="1920" <?php if (!(strcmp(1920, ""))) {echo "SELECTED";} ?>>1920</option>
                <option value="1921" <?php if (!(strcmp(1921, ""))) {echo "SELECTED";} ?>>1921</option>
                <option value="1922" <?php if (!(strcmp(1922, ""))) {echo "SELECTED";} ?>>1922</option>
                <option value="1923" <?php if (!(strcmp(1923, ""))) {echo "SELECTED";} ?>>1923</option>
                <option value="1924" <?php if (!(strcmp(1924, ""))) {echo "SELECTED";} ?>>1924</option>
                <option value="1925" <?php if (!(strcmp(1925, ""))) {echo "SELECTED";} ?>>1925</option>
                <option value="1926" <?php if (!(strcmp(1926, ""))) {echo "SELECTED";} ?>>1926</option>
                <option value="1927" <?php if (!(strcmp(1927, ""))) {echo "SELECTED";} ?>>1927</option>
                <option value="1928" <?php if (!(strcmp(1928, ""))) {echo "SELECTED";} ?>>1928</option>
                <option value="1929" <?php if (!(strcmp(1929, ""))) {echo "SELECTED";} ?>>1929</option>
                <option value="1930" <?php if (!(strcmp(1930, ""))) {echo "SELECTED";} ?>>1930</option>
                <option value="1931" <?php if (!(strcmp(1931, ""))) {echo "SELECTED";} ?>>1931</option>
                <option value="1932" <?php if (!(strcmp(1932, ""))) {echo "SELECTED";} ?>>1932</option>
                <option value="1933" <?php if (!(strcmp(1933, ""))) {echo "SELECTED";} ?>>1933</option>
                <option value="1934" <?php if (!(strcmp(1934, ""))) {echo "SELECTED";} ?>>1934</option>
                <option value="1935" <?php if (!(strcmp(1935, ""))) {echo "SELECTED";} ?>>1935</option>
                <option value="1936" <?php if (!(strcmp(1936, ""))) {echo "SELECTED";} ?>>1936</option>
                <option value="1937" <?php if (!(strcmp(1937, ""))) {echo "SELECTED";} ?>>1937</option>
                <option value="1938" <?php if (!(strcmp(1938, ""))) {echo "SELECTED";} ?>>1938</option>
                <option value="1939" <?php if (!(strcmp(1939, ""))) {echo "SELECTED";} ?>>1939</option>
                <option value="1940" <?php if (!(strcmp(1940, ""))) {echo "SELECTED";} ?>>1940</option>
                <option value="1941" <?php if (!(strcmp(1941, ""))) {echo "SELECTED";} ?>>1941</option>
                <option value="1942" <?php if (!(strcmp(1942, ""))) {echo "SELECTED";} ?>>1942</option>
                <option value="1943" <?php if (!(strcmp(1943, ""))) {echo "SELECTED";} ?>>1943</option>
                <option value="1944" <?php if (!(strcmp(1944, ""))) {echo "SELECTED";} ?>>1944</option>
                <option value="1945" <?php if (!(strcmp(1945, ""))) {echo "SELECTED";} ?>>1945</option>
                <option value="1946" <?php if (!(strcmp(1946, ""))) {echo "SELECTED";} ?>>1946</option>
                <option value="1947" <?php if (!(strcmp(1947, ""))) {echo "SELECTED";} ?>>1947</option>
                <option value="1948" <?php if (!(strcmp(1948, ""))) {echo "SELECTED";} ?>>1948</option>
                <option value="1949" <?php if (!(strcmp(1949, ""))) {echo "SELECTED";} ?>>1949</option>
                <option value="1950" <?php if (!(strcmp(1950, ""))) {echo "SELECTED";} ?>>1950</option>
                <option value="1951" <?php if (!(strcmp(1951, ""))) {echo "SELECTED";} ?>>1951</option>
                <option value="1952" <?php if (!(strcmp(1952, ""))) {echo "SELECTED";} ?>>1952</option>
                <option value="1953" <?php if (!(strcmp(1953, ""))) {echo "SELECTED";} ?>>1953</option>
                <option value="1954" <?php if (!(strcmp(1954, ""))) {echo "SELECTED";} ?>>1954</option>
                <option value="1955" <?php if (!(strcmp(1955, ""))) {echo "SELECTED";} ?>>1955</option>
                <option value="1956" <?php if (!(strcmp(1956, ""))) {echo "SELECTED";} ?>>1956</option>
                <option value="1957" <?php if (!(strcmp(1957, ""))) {echo "SELECTED";} ?>>1957</option>
                <option value="1958" <?php if (!(strcmp(1958, ""))) {echo "SELECTED";} ?>>1958</option>
                <option value="1959" <?php if (!(strcmp(1959, ""))) {echo "SELECTED";} ?>>1959</option>
                <option value="1960" <?php if (!(strcmp(1960, ""))) {echo "SELECTED";} ?>>1960</option>
                <option value="1961" <?php if (!(strcmp(1961, ""))) {echo "SELECTED";} ?>>1961</option>
                <option value="1962" <?php if (!(strcmp(1962, ""))) {echo "SELECTED";} ?>>1962</option>
                <option value="1963" <?php if (!(strcmp(1963, ""))) {echo "SELECTED";} ?>>1963</option>
                <option value="1964" <?php if (!(strcmp(1964, ""))) {echo "SELECTED";} ?>>1964</option>
                <option value="1965" <?php if (!(strcmp(1965, ""))) {echo "SELECTED";} ?>>1965</option>
                <option value="1966" <?php if (!(strcmp(1966, ""))) {echo "SELECTED";} ?>>1966</option>
                <option value="1967" <?php if (!(strcmp(1967, ""))) {echo "SELECTED";} ?>>1967</option>
                <option value="1968" <?php if (!(strcmp(1968, ""))) {echo "SELECTED";} ?>>1968</option>
                <option value="1969" <?php if (!(strcmp(1969, ""))) {echo "SELECTED";} ?>>1969</option>
                <option value="1970" <?php if (!(strcmp(1970, ""))) {echo "SELECTED";} ?>>1970</option>
                <option value="1971" <?php if (!(strcmp(1971, ""))) {echo "SELECTED";} ?>>1971</option>
                <option value="1972" <?php if (!(strcmp(1972, ""))) {echo "SELECTED";} ?>>1972</option>
                <option value="1973" <?php if (!(strcmp(1973, ""))) {echo "SELECTED";} ?>>1973</option>
                <option value="1974" <?php if (!(strcmp(1974, ""))) {echo "SELECTED";} ?>>1974</option>
                <option value="1975" <?php if (!(strcmp(1975, ""))) {echo "SELECTED";} ?>>1975</option>
                <option value="1976" <?php if (!(strcmp(1976, ""))) {echo "SELECTED";} ?>>1976</option>
                <option value="1977" <?php if (!(strcmp(1977, ""))) {echo "SELECTED";} ?>>1977</option>
                <option value="1978" <?php if (!(strcmp(1978, ""))) {echo "SELECTED";} ?>>1978</option>
                <option value="1979" <?php if (!(strcmp(1979, ""))) {echo "SELECTED";} ?>>1979</option>
                <option value="1980" <?php if (!(strcmp(1980, ""))) {echo "SELECTED";} ?>>1980</option>
                <option value="1981" <?php if (!(strcmp(1981, ""))) {echo "SELECTED";} ?>>1981</option>
                <option value="1982" <?php if (!(strcmp(1982, ""))) {echo "SELECTED";} ?>>1982</option>
                <option value="1983" <?php if (!(strcmp(1983, ""))) {echo "SELECTED";} ?>>1983</option>
                <option value="1984" <?php if (!(strcmp(1984, ""))) {echo "SELECTED";} ?>>1984</option>
                <option value="1985" <?php if (!(strcmp(1985, ""))) {echo "SELECTED";} ?>>1985</option>
                <option value="1986" <?php if (!(strcmp(1986, ""))) {echo "SELECTED";} ?>>1986</option>
                <option value="1987" <?php if (!(strcmp(1987, ""))) {echo "SELECTED";} ?>>1987</option>
                <option value="1988" <?php if (!(strcmp(1988, ""))) {echo "SELECTED";} ?>>1988</option>
                <option value="1989" <?php if (!(strcmp(1989, ""))) {echo "SELECTED";} ?>>1989</option>
                <option value="1990" <?php if (!(strcmp(1990, ""))) {echo "SELECTED";} ?>>1990</option>
                <option value="1991" <?php if (!(strcmp(1991, ""))) {echo "SELECTED";} ?>>1991</option>
                <option value="1992" <?php if (!(strcmp(1992, ""))) {echo "SELECTED";} ?>>1992</option>
                <option value="1993" <?php if (!(strcmp(1993, ""))) {echo "SELECTED";} ?>>1993</option>
                <option value="1994" <?php if (!(strcmp(1994, ""))) {echo "SELECTED";} ?>>1994</option>
                <option value="1995" <?php if (!(strcmp(1995, ""))) {echo "SELECTED";} ?>>1995</option>
                <option value="1996" <?php if (!(strcmp(1996, ""))) {echo "SELECTED";} ?>>1996</option>
                <option value="1997" <?php if (!(strcmp(1997, ""))) {echo "SELECTED";} ?>>1997</option>
                <option value="1998" <?php if (!(strcmp(1998, ""))) {echo "SELECTED";} ?>>1998</option>
                <option value="1999" <?php if (!(strcmp(1999, ""))) {echo "SELECTED";} ?>>1999</option>
                <option value="2000" <?php if (!(strcmp(2000, ""))) {echo "SELECTED";} ?>>2000</option>
                <option value="2001" <?php if (!(strcmp(2001, ""))) {echo "SELECTED";} ?>>2001</option>
                <option value="2002" <?php if (!(strcmp(2002, ""))) {echo "SELECTED";} ?>>2002</option>
                <option value="2003" <?php if (!(strcmp(2003, ""))) {echo "SELECTED";} ?>>2003</option>
                <option value="2004" <?php if (!(strcmp(2004, ""))) {echo "SELECTED";} ?>>2004</option>
                <option value="2005" <?php if (!(strcmp(2005, ""))) {echo "SELECTED";} ?>>2005</option>
                <option value="2006" <?php if (!(strcmp(2006, ""))) {echo "SELECTED";} ?>>2006</option>
                <option value="2007" <?php if (!(strcmp(2007, ""))) {echo "SELECTED";} ?>>2007</option>
                <option value="2008" <?php if (!(strcmp(2008, ""))) {echo "SELECTED";} ?>>2008</option>
                <option value="2009" <?php if (!(strcmp(2009, ""))) {echo "SELECTED";} ?>>2009</option>
                <option value="2010" <?php if (!(strcmp(2010, ""))) {echo "SELECTED";} ?>>2010</option>
              </select>
            &nbsp;&nbsp;&nbsp;
            Mes:
            <select name="mes" class="cajatexto3">
              <option value="" selected>------</option>
              <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Enero</option>
              <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>Febrero</option>
              <option value="3" <?php if (!(strcmp(3, ""))) {echo "SELECTED";} ?>>Marzo</option>
              <option value="4" <?php if (!(strcmp(4, ""))) {echo "SELECTED";} ?>>Abril</option>
              <option value="5" <?php if (!(strcmp(5, ""))) {echo "SELECTED";} ?>>Mayo</option>
              <option value="6" <?php if (!(strcmp(6, ""))) {echo "SELECTED";} ?>>Junio</option>
              <option value="7" <?php if (!(strcmp(7, ""))) {echo "SELECTED";} ?>>Julio</option>
              <option value="8" <?php if (!(strcmp(8, ""))) {echo "SELECTED";} ?>>Agosto</option>
              <option value="9" <?php if (!(strcmp(9, ""))) {echo "SELECTED";} ?>>Septiembre</option>
              <option value="10" <?php if (!(strcmp(10, ""))) {echo "SELECTED";} ?>>Octubre</option>
              <option value="11" <?php if (!(strcmp(11, ""))) {echo "SELECTED";} ?>>Noviembre</option>
              <option value="12" <?php if (!(strcmp(12, ""))) {echo "SELECTED";} ?>>Diciembre</option>
            </select>
            &nbsp;&nbsp;&nbsp;
            Dia:
            <select name="dia" class="cajatexto3">
              <option value="" selected>------</option>
              <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>1</option>
              <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>2</option>
              <option value="3" <?php if (!(strcmp(3, ""))) {echo "SELECTED";} ?>>3</option>
              <option value="4" <?php if (!(strcmp(4, ""))) {echo "SELECTED";} ?>>4</option>
              <option value="5" <?php if (!(strcmp(5, ""))) {echo "SELECTED";} ?>>5</option>
              <option value="6" <?php if (!(strcmp(6, ""))) {echo "SELECTED";} ?>>6</option>
              <option value="7" <?php if (!(strcmp(7, ""))) {echo "SELECTED";} ?>>7</option>
              <option value="8" <?php if (!(strcmp(8, ""))) {echo "SELECTED";} ?>>8</option>
              <option value="9" <?php if (!(strcmp(9, ""))) {echo "SELECTED";} ?>>9</option>
              <option value="10" <?php if (!(strcmp(10, ""))) {echo "SELECTED";} ?>>10</option>
              <option value="11" <?php if (!(strcmp(11, ""))) {echo "SELECTED";} ?>>11</option>
              <option value="12" <?php if (!(strcmp(12, ""))) {echo "SELECTED";} ?>>12</option>
              <option value="13" <?php if (!(strcmp(13, ""))) {echo "SELECTED";} ?>>13</option>
              <option value="14" <?php if (!(strcmp(14, ""))) {echo "SELECTED";} ?>>14</option>
              <option value="15" <?php if (!(strcmp(15, ""))) {echo "SELECTED";} ?>>15</option>
              <option value="16" <?php if (!(strcmp(16, ""))) {echo "SELECTED";} ?>>16</option>
              <option value="17" <?php if (!(strcmp(17, ""))) {echo "SELECTED";} ?>>17</option>
              <option value="18" <?php if (!(strcmp(18, ""))) {echo "SELECTED";} ?>>18</option>
              <option value="19" <?php if (!(strcmp(19, ""))) {echo "SELECTED";} ?>>19</option>
              <option value="20" <?php if (!(strcmp(20, ""))) {echo "SELECTED";} ?>>20</option>
              <option value="21" <?php if (!(strcmp(21, ""))) {echo "SELECTED";} ?>>21</option>
              <option value="22" <?php if (!(strcmp(22, ""))) {echo "SELECTED";} ?>>22</option>
              <option value="23" <?php if (!(strcmp(23, ""))) {echo "SELECTED";} ?>>23</option>
              <option value="24" <?php if (!(strcmp(24, ""))) {echo "SELECTED";} ?>>24</option>
              <option value="25" <?php if (!(strcmp(25, ""))) {echo "SELECTED";} ?>>25</option>
              <option value="26" <?php if (!(strcmp(26, ""))) {echo "SELECTED";} ?>>26</option>
              <option value="27" <?php if (!(strcmp(27, ""))) {echo "SELECTED";} ?>>27</option>
              <option value="28" <?php if (!(strcmp(28, ""))) {echo "SELECTED";} ?>>28</option>
              <option value="29" <?php if (!(strcmp(29, ""))) {echo "SELECTED";} ?>>29</option>
              <option value="30" <?php if (!(strcmp(30, ""))) {echo "SELECTED";} ?>>30</option>
              <option value="31" <?php if (!(strcmp(31, ""))) {echo "SELECTED";} ?>>31</option>
            </select></td>
        </tr>
        <?php /*?><tr>
          <td><strong>Direcci&oacute;n:</strong></td>
        <td colspan="2"><input name="direccion" type="text" class="cajadetexto" id="direccion" size="40" /></td>
      </tr><?php */?>
        <tr>
          <td><strong>Tel&eacute;fono:</strong></td>
          <td colspan="2"><input name="telefono" type="text" class="cajadetexto" id="telefono" size="40" /></td>
        </tr>
        <tr>
          <td><strong>Email:</strong></td>
          <td colspan="2"><input name="email" type="text" class="cajadetexto" id="email" size="40" /></td>
        </tr>
        <tr>
          <td><strong>Ciudad:</strong></td>
          <td colspan="2"><input name="ciudad" type="text" class="cajadetexto" id="ciudad" size="40" /></td>
        </tr>
        <?php /*?><tr>
          <td><strong>Barrio:</strong></td>
        <td colspan="2"><input name="barrio" type="text" class="cajadetexto" id="barrio" size="40" /></td>
      </tr><?php */?>
        <tr>
          <td><label for="Asunto"><strong>Asunto:</strong></label></td>
          <td colspan="2"><select name="asunto" id="asunto">
              <option value="" selected>------</option>
              <option value="Opinion" <?php if (!(strcmp(Opinion, ""))) {echo "SELECTED";} ?>>Opinion</option>
              <option value="Solicitud" <?php if (!(strcmp(Solicitud, ""))) {echo "SELECTED";} ?>>Solicitud</option>
              <option value="Queja" <?php if (!(strcmp(Queja, ""))) {echo "SELECTED";} ?>>Queja</option>
              <option value="Reclamo" <?php if (!(strcmp(Reclamo, ""))) {echo "SELECTED";} ?>>Reclamo</option>
              <option value="Sugerencia" <?php if (!(strcmp(Sugerencia, ""))) {echo "SELECTED";} ?>>Sugerencia</option>
              <option value="ComentarioPositivo" <?php if (!(strcmp(ComentarioPositivo, ""))) {echo "SELECTED";} ?>>Comentario Positivo</option>                  
              <!--<option>Publicidad</option>
            <option>Otro Asunto</option>-->
          </select></td>
        </tr>
        <tr>
          <td rowspan="2"><label for="Emisora"><strong>Emisora:</strong></label></td>
          <td width="25%"><b>Emisora:&nbsp;</b></td>
          <td><select style="width:170px" name="sistema" id="sistema">
              <option value="" selected>------</option>
              <option value="RCNLaRadio" <?php if (!(strcmp(RCNLaRadio, ""))) {echo "SELECTED";} ?>>RCN La Radio</option>
              <option value="LaFM" <?php if (!(strcmp(LaFM, ""))) {echo "SELECTED";} ?>>La FM</option>
              <option value="LaMega" <?php if (!(strcmp(LaMega, ""))) {echo "SELECTED";} ?>>La Mega</option>
              <option value="Antena2" <?php if (!(strcmp(Antena2, ""))) {echo "SELECTED";} ?>>Antena 2</option>
              <option value="Amor" <?php if (!(strcmp(Amor, ""))) {echo "SELECTED";} ?>>Amor</option>
              <option value="Rumba" <?php if (!(strcmp(Rumba, ""))) {echo "SELECTED";} ?>>Rumba</option>
              <option value="Radio1" <?php if (!(strcmp(Radio1, ""))) {echo "SELECTED";} ?>>Radio 1</option>
              <option value="Fantastica" <?php if (!(strcmp(Fantastica, ""))) {echo "SELECTED";} ?>>Fant&aacute;stica</option>
              <option value="ElSol" <?php if (!(strcmp(ElSol, ""))) {echo "SELECTED";} ?>>El Sol</option>
              <option value="LaCarinosa" <?php if (!(strcmp(LaCarinosa, ""))) {echo "SELECTED";} ?>>La Cari&ntilde;osa</option>
              <option value="Fiesta" <?php if (!(strcmp(Fiesta, ""))) {echo "SELECTED";} ?>>Fiesta</option>
              <option value="Radio Red" <?php if (!(strcmp(RadioRed, ""))) {echo "SELECTED";} ?>>Radio Red</option>              
              <option value="EmisoraRegionalLocal" <?php if (!(strcmp(EmisoraRegionalLocal, ""))) {echo "SELECTED";} ?>>Emisora Regional Local</option>
              <option value="Bolero" <?php if (!(strcmp(Bolero, ""))) {echo "SELECTED";} ?>>Bolero</option>
              <option value="Colombianisima" <?php if (!(strcmp(Colombianisima, ""))) {echo "SELECTED";} ?>>Colombianisima</option>
              <option value="NuestraTierraRadio" <?php if (!(strcmp(NuestraTierraRadio, ""))) {echo "SELECTED";} ?>>Nuestra Tierra Radio</option>
              <option value="AnosMaravillosos" <?php if (!(strcmp(AnosMaravillosos, ""))) {echo "SELECTED";} ?>>Anos Maravillosos</option>
              <option value="Ochentera" <?php if (!(strcmp(Ochentera, ""))) {echo "SELECTED";} ?>>Ochentera</option>
              <option value="RCNClasica" <?php if (!(strcmp(RCNClasica, ""))) {echo "SELECTED";} ?>>RCN Clasica</option>
              <option value="NTN24" <?php if (!(strcmp(NTN24, ""))) {echo "SELECTED";} ?>>NTN24</option>
              <option value="VenturaRadio" <?php if (!(strcmp(VenturaRadio, ""))) {echo "SELECTED";} ?>>Ventura Radio</option>
              <option value="CaribeySon" <?php if (!(strcmp(CaribeySon, ""))) {echo "SELECTED";} ?>>Caribe y Son</option>
              <option value="Rockeando" <?php if (!(strcmp(Rockeando, ""))) {echo "SELECTED";} ?>>Rockeando</option>
              <option value="RCNKids" <?php if (!(strcmp(RCNKids, ""))) {echo "SELECTED";} ?>>RCN Kids</option>
              <option value="ElectroFiesta" <?php if (!(strcmp(ElectroFiesta, ""))) {echo "SELECTED";} ?>>ElectroFiesta</option>
              <option value="LaInstrumental" <?php if (!(strcmp(LaInstrumental, ""))) {echo "SELECTED";} ?>>La Instrumental</option>              
              <option value="VallenatoVentiao" <?php if (!(strcmp(VallenatoVentiao, ""))) {echo "SELECTED";} ?>>Vallenato Ventiao</option>
              <option value="LaTropiPop" <?php if (!(strcmp(LaTropiPop, ""))) {echo "SELECTED";} ?>>LaTropiPop</option>
          </select></td>
        </tr>
        <tr>
          <td width="25%"><b>Ciudad en que la escucha:&nbsp;</b></td>
          <td><select style="width:170px" name="ciudad_emisora" id="ciudad_emisora">
              <option value="" selected>------</option>
              <option value="Apartado" <?php if (!(strcmp(Apartado, ""))) {echo "SELECTED";} ?>>Apartado</option>
              <option value="Armenia" <?php if (!(strcmp(Armenia, ""))) {echo "SELECTED";} ?>>Armenia</option>
              <option value="Barrancabermeja" <?php if (!(strcmp(Barrancabermeja, ""))) {echo "SELECTED";} ?>>Barrancabermeja</option>
              <option value="Barranquilla" <?php if (!(strcmp(Barranquilla, ""))) {echo "SELECTED";} ?>>Barranquilla</option>
              <option value="Barbosa" <?php if (!(strcmp(Barbosa, ""))) {echo "SELECTED";} ?>>Barbosa</option>
              <option value="Bello" <?php if (!(strcmp(Bello, ""))) {echo "SELECTED";} ?>>Bello</option>
              <option value="Bogota" <?php if (!(strcmp(Bogota, ""))) {echo "SELECTED";} ?>>Bogot&aacute;</option>
              <option value="Bucaramanga" <?php if (!(strcmp(Bucaramanga, ""))) {echo "SELECTED";} ?>>Bucaramanga</option>
              <option value="Buenaventura" <?php if (!(strcmp(Buenaventura, ""))) {echo "SELECTED";} ?>>Buenaventura</option>
              <option value="Buga" <?php if (!(strcmp(Buga, ""))) {echo "SELECTED";} ?>>Buga</option>
              <option value="Cajamarca" <?php if (!(strcmp(Cajamarca, ""))) {echo "SELECTED";} ?>>Cajamarca</option>
              <option value="Calarca" <?php if (!(strcmp(Calarca, ""))) {echo "SELECTED";} ?>>Calarc&aacute;</option>
              <option value="Cali" <?php if (!(strcmp(Cali, ""))) {echo "SELECTED";} ?>>Cali</option>
              <option value="Cartagena" <?php if (!(strcmp(Cartagena, ""))) {echo "SELECTED";} ?>>Cartagena</option>
              <option value="Caucasia" <?php if (!(strcmp(Caucasia, ""))) {echo "SELECTED";} ?>>Caucasia</option>
              <option value="Cucuta" <?php if (!(strcmp(Cucuta, ""))) {echo "SELECTED";} ?>>C&uacute;cuta</option>
              <option value="Dosquebradas" <?php if (!(strcmp(Dosquebradas, ""))) {echo "SELECTED";} ?>>Dosquebradas</option>
              <option value="Duitama" <?php if (!(strcmp(Duitama, ""))) {echo "SELECTED";} ?>>Duitama</option>
              <option value="Espinal" <?php if (!(strcmp(Espinal, ""))) {echo "SELECTED";} ?>>Espinal</option>
              <option value="Flandes" <?php if (!(strcmp(Flandes, ""))) {echo "SELECTED";} ?>>Flandes</option>
              <option value="Florencia" <?php if (!(strcmp(Florencia, ""))) {echo "SELECTED";} ?>>Florencia</option>
              <option value="Fredonia" <?php if (!(strcmp(Fredonia, ""))) {echo "SELECTED";} ?>>Fredonia</option>
              <option value="Fusagasuga" <?php if (!(strcmp(Fusagasuga, ""))) {echo "SELECTED";} ?>>Fusagasuga</option>
              <option value="Girardot" <?php if (!(strcmp(Girardot, ""))) {echo "SELECTED";} ?>>Girardot</option>
              <option value="Girardota" <?php if (!(strcmp(Girardota, ""))) {echo "SELECTED";} ?>>Girardota</option>
              <option value="Giron" <?php if (!(strcmp(Giron, ""))) {echo "SELECTED";} ?>>Gir&oacute;n</option>
              <option value="Guarne" <?php if (!(strcmp(Guarne, ""))) {echo "SELECTED";} ?>>Guarne</option>
              <option value="Ibague" <?php if (!(strcmp(Ibague, ""))) {echo "SELECTED";} ?>>Ibagu&eacute;</option>
              <option value="Itagui" <?php if (!(strcmp(Itagui, ""))) {echo "SELECTED";} ?>>Itagu&iacute;</option>
              <option value="LaCeja" <?php if (!(strcmp(LaCeja, ""))) {echo "SELECTED";} ?>>La Ceja</option>
              <option value="LaDorada" <?php if (!(strcmp(LaDorada, ""))) {echo "SELECTED";} ?>>La Dorada</option>
              <option value="LaPaz" <?php if (!(strcmp(LaPaz, ""))) {echo "SELECTED";} ?>>La Paz</option>
              <option value="Lorica" <?php if (!(strcmp(Lorica, ""))) {echo "SELECTED";} ?>>Lorica</option>
              <option value="LosPatios" <?php if (!(strcmp(LosPatios, ""))) {echo "SELECTED";} ?>>Los Patios</option>
              <option value="Manizales" <?php if (!(strcmp(Manizales, ""))) {echo "SELECTED";} ?>>Manizales</option>
              <option value="Medellin" <?php if (!(strcmp(Medellin, ""))) {echo "SELECTED";} ?>>Medell&iacute;n</option>
              <option value="Monteria" <?php if (!(strcmp(Monteria, ""))) {echo "SELECTED";} ?>>Monteria</option>
              <option value="Neiva" <?php if (!(strcmp(Neiva, ""))) {echo "SELECTED";} ?>>Neiva</option>
              <option value="Ocaña" <?php if (!(strcmp(Ocaña, ""))) {echo "SELECTED";} ?>>Ocaña</option>
              <option value="Pasto" <?php if (!(strcmp(Pasto, ""))) {echo "SELECTED";} ?>>Pasto</option>
              <option value="Pereira" <?php if (!(strcmp(Pereira, ""))) {echo "SELECTED";} ?>>Pereira</option>
              <option value="Piedecuesta" <?php if (!(strcmp(Piedecuesta, ""))) {echo "SELECTED";} ?>>Piedecuesta</option>
              <option value="PlanetaRica" <?php if (!(strcmp(PlanetaRica, ""))) {echo "SELECTED";} ?>>Planeta Rica</option>
              <option value="Popayan" <?php if (!(strcmp(Popayan, ""))) {echo "SELECTED";} ?>>Popay&aacute;n</option>
              <option value="Riohacha" <?php if (!(strcmp(Riohacha, ""))) {echo "SELECTED";} ?>>Riohacha</option>
              <option value="Rionegro" <?php if (!(strcmp(Rionegro, ""))) {echo "SELECTED";} ?>>Rionegro</option>
              <option value="SabanadeTorres" <?php if (!(strcmp(SabanadeTorres, ""))) {echo "SELECTED";} ?>>Sabana de Torres</option>
              <option value="SanAndres" <?php if (!(strcmp(SanAndres, ""))) {echo "SELECTED";} ?>>San Andr&eacute;s</option>
              <option value="SanGil" <?php if (!(strcmp(SanGil, ""))) {echo "SELECTED";} ?>>San Gil</option>
              <option value="SantaMarta" <?php if (!(strcmp(SantaMarta, ""))) {echo "SELECTED";} ?>>Santa Marta</option>
              <option value="SantoTomas" <?php if (!(strcmp(SantoTomas, ""))) {echo "SELECTED";} ?>>Santo Tom&aacute;s</option>
              <option value="Sevilla" <?php if (!(strcmp(Sevilla, ""))) {echo "SELECTED";} ?>>Sevilla</option>
              <option value="Sincelejo" <?php if (!(strcmp(Sincelejo, ""))) {echo "SELECTED";} ?>>Sincelejo</option>
              <option value="Sogamoso" <?php if (!(strcmp(Sogamoso, ""))) {echo "SELECTED";} ?>>Sogamoso</option>
              <option value="Tulua" <?php if (!(strcmp(Tulua, ""))) {echo "SELECTED";} ?>>Tulua</option>
              <option value="Tumaco" <?php if (!(strcmp(Tumaco, ""))) {echo "SELECTED";} ?>>Tumaco</option>
              <option value="Tunja" <?php if (!(strcmp(Tunja, ""))) {echo "SELECTED";} ?>>Tunja</option>
              <option value="Valledupar" <?php if (!(strcmp(Valledupar, ""))) {echo "SELECTED";} ?>>Valledupar</option>
              <option value="VilladeLeyva" <?php if (!(strcmp(VilladeLeyva, ""))) {echo "SELECTED";} ?>>Villa de Leyva</option>
              <option value="VillaMaria" <?php if (!(strcmp(VillaMaria, ""))) {echo "SELECTED";} ?>>Villa Mar&iacute;a</option>
              <option value="Villapinzon" <?php if (!(strcmp(Villapinzon, ""))) {echo "SELECTED";} ?>>Villapinz&oacute;n</option>
              <option value="Villavicencio" <?php if (!(strcmp(Villavicencio, ""))) {echo "SELECTED";} ?>>Villavicencio</option>
              <option value="Zipaquira" <?php if (!(strcmp(Zipaquira, ""))) {echo "SELECTED";} ?>>Zipaquir&aacute;</option>
          </select></td>
        </tr>
        <tr>
          <td valign="top"><strong>Mensaje:</strong></td>
          <td colspan="2"><p>
              <textarea name="mensaje" cols="80" rows="3" class="cajadetexto" id="mensaje" wrap="physical" onkeydown="textCounter(this.form.mensaje,this.form.remLen,140);" onkeyup="textCounter(this.form.mensaje,this.form.remLen,140);"></textarea>
            </p>
              <p>Faltan
                <input readonly type="text" name="remLen" size="2" maxlength="3" value="140" style="border:#FFFFFF; border-width:0px; background-color:#FFFFFF; font-family:'Trebuchet MS'; font-weight:bold; text-align:center; color:#990000;" />
                car&aacute;cteres </p></td>
        </tr>
        <tr>
          <td colspan="3"><span style="float:left; margin-top:3px;"><a href="http://hv.rcnradio.com.co:90/HV.dll/" target="_blank"><img src="images/hojasdevida.png" width="190" height="27" border="0" /></a></span>
            <div style="float:right;">
              <input type="hidden" name="fecha" value="<?= date("d/m/Y"); ?>" />
              <input type="hidden" name="hora" value="<?= date("G:i:s"); ?>" />
              <input type="hidden" name="MM_insert" value="form1" />
              <input type="submit" name="postback" id="postback" value="Enviar" class="boton" onclick="MM_validateForm('nombre','','R','telefono','','R','email','','RisEmail','ciudad','','R','mensaje','','R');return document.MM_returnValue"/>
            </div></td>
          </tr>
      </table></td>
      </tr>
   	</table>
    </form><?php if (isset($msg)) echo $msg;?>
    
<script>
<!-- 
function validar(formulario){
  if(formulario.genero.value == ''){
    alert('Seleccione Genero');
    formulario.genero.focus();
    return false;
  }
  if(formulario.ano.value == ''){
    alert('Seleccione Ano de Nacimiento');
    formulario.ano.focus();
    return false;
  }
  if(formulario.mes.value == ''){
    alert('Seleccione Mes de Nacimiento');
    formulario.mes.focus();
    return false;
  }  
  if(formulario.dia.value == ''){
    alert('Seleccione Dia de Nacimiento');
    formulario.dia.focus();
    return false;
  }
  if(formulario.asunto.value == ''){
    alert('Seleccione Asunto');
    formulario.asunto.focus();
    return false;
  }
  if(formulario.sistema.value == ''){
    alert('Seleccione Emisora');
    formulario.sistema.focus();
    return false;
  }
  if(formulario.ciudad_emisora.value == ''){
    alert('Seleccione la ciudad donde escucha la emisora');
    formulario.ciudad_emisora.focus();
    return false;
  }
  return true;
}
//-->
</script>


<p>&nbsp;</p>
<div>
  <p>Si desea comunicarse con nuestro servicio de Atenci&oacute;n al Oyente puede tambi&eacute;n enviar sus comunicaciones escritas a la <strong>Calle 36 # 13A - 09   Bogot&aacute; D.C.</strong> o por tel&eacute;fono al<strong> PBX 3147070 Ext. 1310</strong>.</p>
</div>
<p>&nbsp;</p>
  </div>
</div>


<div id="footer"><?php include("/home/www/salvation/rcnmundo/reddeportales/footer.php"); ?></div>

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"> 
</script> 
<script type="text/javascript"> 
_uacct = "UA-3017383-1";
urchinTracker('atencionaloyente');
</script>

</body>
</html>

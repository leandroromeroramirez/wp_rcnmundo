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

mysql_select_db($database_audios, $audios);
$query_cambiar = "SELECT id, razonsocial, representantelegal, identificacion, regimen, matriculamercantil, direccion, ubicacion, telefono, email, web, contacto, contacto, contactotelefono, contactoemail, cargo, mensaje, fecha, hora FROM proveedores ORDER BY id ASC";
$cambiar = mysql_query($query_cambiar, $audios) or die(mysql_error());
$row_cambiar = mysql_fetch_assoc($cambiar);
$totalRows_cambiar = mysql_num_rows($cambiar);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>RESULTADOS</title>
<style type="text/css">
<!--
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo7 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo13 {color: #FFFFFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
-->
</style>
</head>

<body>
<p class="Estilo7">ATENCI&Oacute;N AL OYENTE</p>
<p class="Estilo6"><a href="mys.php"><img src="images/icono-excel.gif" width="36" height="36" border="0" align="absmiddle" /> <strong>Descargar archivo</strong></a><strong></strong></p>

<?php //echo $row_cambiar['id']; ?>	

<table width="100%" border="0" cellpadding="3" cellspacing="1">
  <tr bgcolor="#000000">
	<td><span class="Estilo13">ID</span></td>
    <td><span class="Estilo13">RAZ&Oacute;N SOCIAL</span></td>
    <td><span class="Estilo13">REPRESENTANTE LEGAL</span></td>
    <td><span class="Estilo13">IDENTIFICACI&Oacute;N</span></td>
    <td><span class="Estilo13">R&Eacute;GIMEN</span></td>   
    <td><span class="Estilo13">MATRICULA MERCANTIL</span></td>
    <td><span class="Estilo13">DIRECCI&Oacute;N</span></td>
    <td><span class="Estilo13">UBICACI&Oacute;N</span></td>
    <td><span class="Estilo13">TELEFONO</span></td>
    <td><span class="Estilo13">EMAIL</span></td>
    <td><span class="Estilo13">WEB</span></td>
    <td><span class="Estilo13">CONTACTO</span></td>
    <td><span class="Estilo13">TEL CONTACTO</span></td>
    <td><span class="Estilo13">EMAIL CONTACTO</span></td>        
    <td><span class="Estilo13">CARGO</span></td>            
    <td><span class="Estilo13">SERVICIO</span></td>  
    <td><span class="Estilo13">FECHA</span></td>  
    <td><span class="Estilo13">HORA</span></td>    
  </tr>

<?php do { ?>
      <tr align="left" valign="middle" class="Estilo6" style="border-bottom:#000000; border-bottom-width:1px; border-bottom-style:solid;">
        <td height="30" bgcolor="#000000"><div align="justify"><span class="Estilo13"><?php echo $row_cambiar['id']; ?></span></div></td>
        <td height="30"><div align="justify"><?php echo $row_cambiar['razonsocial']; ?></div></td>
		<td height="30"><div align="justify"><?php echo $row_cambiar['representantelegal']; ?></div></td>
        <td height="30"><div align="justify"><?php echo $row_cambiar['identificacion']; ?></div></td>
        <td height="30"><div align="justify"><?php echo $row_cambiar['regimen']; ?></div></td>
        <td height="30"><div align="justify"><?php echo $row_cambiar['matriculamercantil']; ?> </div></td>        
        <td height="30"><div align="justify"><?php echo $row_cambiar['direccion']; ?> </div></td>
        <td height="30"><div align="justify"><?php echo $row_cambiar['ubicacion']; ?> </div></td>
        <td height="30"><div align="justify"><?php echo $row_cambiar['telefono']; ?> </div></td>
        <td height="30"><div align="justify"><?php echo $row_cambiar['email']; ?> </div></td>
        <td height="30"><div align="justify"><?php echo $row_cambiar['web']; ?> </div></td>
        <td height="30"><div align="justify"><?php echo $row_cambiar['contacto']; ?> </div></td>
        <td height="30"><div align="justify"><?php echo $row_cambiar['contactotelefono']; ?> </div></td>
        <td height="30"><div align="justify"><?php echo $row_cambiar['contactoemail']; ?> </div></td>                
        <td height="30"><div align="justify"><?php echo $row_cambiar['cargo']; ?> </div></td>
        <td height="30"><div align="justify"><?php echo $row_cambiar['mensaje']; ?> </div></td>        
        <td height="30"><div align="justify"><?php echo $row_cambiar['fecha']; ?> </div></td>
        <td height="30"><div align="justify"><?php echo $row_cambiar['hora']; ?> </div></td>
      </tr>


      <tr align="left" valign="middle" bgcolor="#CCCCCC" class="Estilo6" style="border-bottom:#000000; border-bottom-width:1px; border-bottom-style:solid;">
        <td height="5"></td>
        <td height="5"></td>
        <td height="5"></td>
        <td height="5"></td>
        <td height="5"></td>
        <td height="5"></td>
        <td height="5"></td>
        <td height="5"></td>
        <td height="5"></td>
        <td height="5"></td>
        <td height="5"></td>
        <td height="5"></td>
        <td height="5"></td>
        <td height="5"></td>
        <td height="5"></td>
        <td height="5"></td>    
        <td height="5"></td>
        <td height="5"></td>                
    </tr>
      <?php } while ($row_cambiar = mysql_fetch_assoc($cambiar)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($cambiar);
?>

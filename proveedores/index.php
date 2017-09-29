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
  $insertSQL = sprintf("INSERT INTO proveedores (razonsocial, representantelegal, identificacion, regimen, matriculamercantil, direccion, ubicacion, telefono, email, web, contacto, contactotelefono, contactoemail, cargo, mensaje, fecha, hora) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['razonsocial'], "text"),
                       GetSQLValueString($_POST['representantelegal'], "text"),				   
                       GetSQLValueString($_POST['identificacion'], "text"),
                       GetSQLValueString($_POST['regimen'], "text"),
                       GetSQLValueString($_POST['matriculamercantil'], "text"),				   				   					   
                       GetSQLValueString($_POST['direccion'], "text"),
					   GetSQLValueString($_POST['ubicacion'], "text"),
					   GetSQLValueString($_POST['telefono'], "text"),					   
                       GetSQLValueString($_POST['email'], "text"),					   
                       GetSQLValueString($_POST['web'], "text"),
                       GetSQLValueString($_POST['contacto'], "text"),	
                       GetSQLValueString($_POST['contactotelefono'], "text"),	
                       GetSQLValueString($_POST['contactoemail'], "text"),						   					   
                       GetSQLValueString($_POST['cargo'], "text"),	
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
<title>RCN RADIO | PROVEEDORES</title>
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
    } if (errors) alert('El formulario no esta diligenciado correctamente. Por favor, reviselo para realizar el envio.\n');
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
<div id="header"><?php //include("/home/www/salvation/rcnmundo/reddeportales/header.php"); ?></div>
<div id="container">
  <div class="formulario">
  	<p>Respetado Proveedor este es un mecanismo creado por RCN Radio para que usted pueda inscribir el bien o servicio que su empresa brinda lo cual nos permitir&aacute; incluirlo dentro de nuestros procesos de compra de bienes o servicios.</p>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onSubmit="return validar(this)">
   	  <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0"><tr><td colspan="2"><table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
        <?php /*?><tr>
          <td><strong>Fecha:</strong></td>
          <td width="25" colspan="2"><label for="select">D&iacute;a: </label>
            <select name="select" id="select">
              <option value="01">01</option>
              <option value="02">02</option>
            </select>
            <label for="select">Mes: </label>
            <select name="select" id="select">
              <option value="01">01</option>
              <option value="02">02</option>
            </select>
            <label for="select">A&ntilde;o: </label>
            <select name="select" id="select">
              <option value="2017">2017</option>
              <option value="2016">2016</option>
              <option value="2015">2015</option>
            </select></td>
        </tr>
        <tr>
          <td><strong>Nuevo:</strong></td>
          <td colspan="2"><input type="radio" name="radio" id="radio" value="radio" /></td>
        </tr>
        <tr>
          <td><strong>Actualizacion:</strong></td>
          <td colspan="2"><input type="radio" name="radio" id="radio2" value="radio" /></td>
        </tr>
        <tr>
          <td colspan="3" >&nbsp;</td>
        </tr><?php */?>
        <tr>
          <td colspan="3" align="center" class="textoblanco">INFORMACI&Oacute;N GENERAL Y LEGAL</td>
          </tr>
        <tr>
          <td height="3" colspan="3"></td>
          </tr>
        <tr>
          <td><strong>Nombre o Raz&oacute;n Social :</strong><br />
(Titular de la cuenta) </td>
          <td colspan="2"><input name="razonsocial" type="text" class="cajadetexto" id="razonsocial" size="40" /></td>
        </tr>
        <tr>
          <td><label for="Asunto"><strong>Nombre del Representante Legal:</strong></label></td>
          <td colspan="2"><input name="representantelegal" type="text" class="cajadetexto" id="representantelegal" size="40" /></td>
        </tr>        
        <tr>
          <td><strong>N&deg; CC o Nit</strong> :<br />
(Titular de la cuenta) </td>
          <td colspan="2"><input name="identificacion" type="text" class="cajadetexto" id="identificacion" size="40" /></td>
        </tr>
        <?php /*?><tr>
          <td><strong>Direcci&oacute;n:</strong></td>
        <td colspan="2"><input name="direccion" type="text" class="cajadetexto" id="direccion" size="40" /></td>
      </tr><?php */?>
        <tr>
          <td><strong>Regimen:</strong></td>
          <td colspan="2"><input type="radio" name="regimen" id="radio3" value="comun" />
            <label for="radio4">Com&uacute;n 
              <input type="radio" name="regimen" id="radio4" value="simplificado" />
              Simplificado</label></td>
        </tr>
        <tr>
          <td><strong>N. matricula mercantil C&aacute;mara de Comercio:</strong></td>
          <td colspan="2"><input name="matriculamercantil" type="text" class="cajadetexto" id="matriculamercantil" size="40" /></td>
        </tr>
        <tr>
          <td><strong>Direcci&oacute;n:</strong></td>
          <td colspan="2"><input name="direccion" type="text" class="cajadetexto" id="direccion" size="40" /></td>
        </tr>
        <tr>
          <td><strong>Ciudad / Depto / Pais:</strong>
          	<p>Inicialmente s&oacute;lo Bogot&aacute;</p></td>
          <td colspan="2"><input name="ubicacion" type="hidden" class="cajadetexto" id="ubicacion" value="BOGOTA" size="40" /> BOGOT&Aacute;</td>
        </tr>
        <tr>
          <td><strong>Tel&eacute;fono:</strong></td>
          <td colspan="2"><input name="telefono" type="text" class="cajadetexto" id="telefono" size="40" /></td>
        </tr>
        <tr>
          <td><strong>Email:</strong></td>
          <td colspan="2"><input name="email" type="text" class="cajadetexto" id="email" size="40" /></td>
        </tr>
        <tr>
          <td><strong>P&aacute;gina de internet:</strong></td>
          <td colspan="2"><input name="web" type="text" class="cajadetexto" id="web" size="40" /></td>
        </tr>
        <tr>
          <td><strong>Persona contacto:</strong></td>
          <td colspan="2"><input name="contacto" type="text" class="cajadetexto" id="contacto" size="40" /></td>
        </tr>
        <tr>
          <td><strong>Tel&eacute;fono contacto:</strong></td>
          <td colspan="2"><input name="contactotelefono" type="text" class="cajadetexto" id="contactotelefono" size="40" /></td>
        </tr>
        <tr>
          <td><strong>Email contacto:</strong></td>
          <td colspan="2"><input name="contactoemail" type="text" class="cajadetexto" id="contactoemail" size="40" /></td>
        </tr>                
        <tr>
          <td><strong>Cargo:</strong></td>
          <td colspan="2"><input name="cargo" type="text" class="cajadetexto" id="cargo" size="40" /></td>
        </tr>
        <tr>
          <td valign="top"><strong>Descripci&oacute;n del Servicio:</strong></td>
          <td colspan="2"><p>
            <textarea name="mensaje" cols="41" rows="3" wrap="physical" class="cajadetexto" id="mensaje" onkeydown="textCounter(this.form.mensaje,this.form.remLen,140);" onkeyup="textCounter(this.form.mensaje,this.form.remLen,140);"></textarea>
            </p>
            <p>Faltan
              <input readonly type="text" name="remLen" size="2" maxlength="3" value="140" style="border:#FFFFFF; border-width:0px; background-color:#FFFFFF; font-family:'Trebuchet MS'; font-weight:bold; text-align:center; color:#990000;" />
              car&aacute;cteres </p></td>
        </tr>        
        <tr>
          <td colspan="3" >&nbsp;</td>
        </tr>
        <?php /*?><tr>
          <td colspan="3" align="center" class="textoblanco">ACCIONISTAS CON M&Aacute;S DEL 5% DE PARTICIPACI&Oacute;N</td>
        </tr>
        <tr>
          <td colspan="3"><table width="100%" border="0" cellspacing="3" cellpadding="0">
            <tbody>
              <tr>
                <td align="center" class="casillaazul">No. de identificaci&oacute;n</td>
                <td align="center" class="casillaazul">Nombre</td>
                <td align="center" class="casillaazul">% Participaci&oacute;n</td>
                </tr>
              <tr>
                <td align="center"><input name="ciudad7" type="text" class="cajadetexto" id="ciudad7" /></td>
                <td align="center"><input name="ciudad14" type="text" class="cajadetexto" id="ciudad14" /></td>
                <td align="center"><input name="ciudad21" type="text" class="cajadetexto" id="ciudad21" /></td>
                </tr>
              <tr>
                <td align="center"><input name="ciudad8" type="text" class="cajadetexto" id="ciudad8" /></td>
                <td align="center"><input name="ciudad15" type="text" class="cajadetexto" id="ciudad15" /></td>
                <td align="center"><input name="ciudad22" type="text" class="cajadetexto" id="ciudad22" /></td>
                </tr>
              <tr>
                <td align="center"><input name="ciudad9" type="text" class="cajadetexto" id="ciudad9" /></td>
                <td align="center"><input name="ciudad16" type="text" class="cajadetexto" id="ciudad16" /></td>
                <td align="center"><input name="ciudad23" type="text" class="cajadetexto" id="ciudad23" /></td>
                </tr>
              <tr>
                <td align="center"><input name="ciudad10" type="text" class="cajadetexto" id="ciudad10" /></td>
                <td align="center"><input name="ciudad17" type="text" class="cajadetexto" id="ciudad17" /></td>
                <td align="center"><input name="ciudad24" type="text" class="cajadetexto" id="ciudad24" /></td>
                </tr>
              <tr>
                <td align="center"><input name="ciudad11" type="text" class="cajadetexto" id="ciudad11" /></td>
                <td align="center"><input name="ciudad18" type="text" class="cajadetexto" id="ciudad18" /></td>
                <td align="center"><input name="ciudad25" type="text" class="cajadetexto" id="ciudad25" /></td>
                </tr>
              <tr>
                <td align="center"><input name="ciudad12" type="text" class="cajadetexto" id="ciudad12" /></td>
                <td align="center"><input name="ciudad19" type="text" class="cajadetexto" id="ciudad19" /></td>
                <td align="center"><input name="ciudad26" type="text" class="cajadetexto" id="ciudad26" /></td>
                </tr>
              <tr>
                <td align="center"><input name="ciudad13" type="text" class="cajadetexto" id="ciudad13" /></td>
                <td align="center"><input name="ciudad20" type="text" class="cajadetexto" id="ciudad20" /></td>
                <td align="center"><input name="ciudad27" type="text" class="cajadetexto" id="ciudad27" /></td>
                </tr>
              </tbody>
            </table></td>
        </tr>
        <tr>
          <td colspan="3" >&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" align="center" class="textoblanco">INFORMACI&Oacute;N BANCARIA<br />
            (Informaci&oacute;n del banco para consignaci&oacute;n de pago facturas) </td>
        </tr>
        <tr>
          <td height="3" colspan="3"></td>
          </tr>
        <tr>
          <td><strong>Nombre Entidad:</strong></td>
          <td colspan="2"><input name="ciudad5" type="text" class="cajadetexto" id="ciudad5" /></td>
        </tr>
        <tr>
          <td><strong>C&oacute;digo de la entidad:</strong></td>
          <td colspan="2"><input name="ciudad6" type="text" class="cajadetexto" id="ciudad6" /></td>
        </tr>
        <tr>
          <td><strong>Tipo de Cuenta:</strong></td>
          <td colspan="2"><input type="radio" name="radio4" id="radio5" value="radio3" />
            <label for="radio5">Corriente
              <input type="radio" name="radio3" id="radio6" value="radio4" />
              Ahorros</label></td>
        </tr>
        <tr>
          <td><strong>Sucursal:</strong></td>
          <td colspan="2"><input name="ciudad28" type="text" class="cajadetexto" id="ciudad28" /></td>
        </tr>
        <tr>
          <td colspan="3" >&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" align="center" class="textoblanco">INFORMACI&Oacute;N COMERCIAL<br />
(Informaci&oacute;n con empresas que ha tenido alg&uacute;n v&iacute;nculo comercial)</td>
          </tr>
        <tr>
          <td colspan="3"><table width="100%" border="0" cellspacing="3" cellpadding="0">
            <tbody>
              <tr>
                <td align="center" class="casillaazul">Empresa</td>
                <td align="center" class="casillaazul">Personda de contacto</td>
                <td align="center" class="casillaazul">Tel&eacute;fono</td>
              </tr>
              <tr>
                <td align="center"><input name="ciudad29" type="text" class="cajadetexto" id="ciudad29" /></td>
                <td align="center"><input name="ciudad29" type="text" class="cajadetexto" id="ciudad30" /></td>
                <td align="center"><input name="ciudad29" type="text" class="cajadetexto" id="ciudad31" /></td>
              </tr>
              <tr>
                <td align="center"><input name="ciudad29" type="text" class="cajadetexto" id="ciudad32" /></td>
                <td align="center"><input name="ciudad29" type="text" class="cajadetexto" id="ciudad33" /></td>
                <td align="center"><input name="ciudad29" type="text" class="cajadetexto" id="ciudad34" /></td>
              </tr>
              <tr>
                <td align="center"><input name="ciudad29" type="text" class="cajadetexto" id="ciudad35" /></td>
                <td align="center"><input name="ciudad29" type="text" class="cajadetexto" id="ciudad36" /></td>
                <td align="center"><input name="ciudad29" type="text" class="cajadetexto" id="ciudad37" /></td>
              </tr>
              </tbody>
          </table></td>
          </tr>
        <tr>
          <td colspan="3" >&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" align="center" class="textoblanco">ASPECTOS DE CALIDAD, SEGURIDAD Y SALUD EN EL TRABAJO Y MEDIO AMBIENTE CON QUE CUENTAN</td>
          </tr>
        <tr>
          <td height="3" colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3"><input type="checkbox" name="checkbox" id="checkbox" />
            Certificaci&oacute;n en Calidad ISO 9001</td>
          </tr>
        <tr>
          <td colspan="3"><input type="checkbox" name="checkbox2" id="checkbox2" />
            Certificaci&oacute;n en Seguridad y Salud en el Trabajo OHSAS 18001</td>
          </tr>
        <tr>
          <td colspan="3"><input type="checkbox" name="checkbox3" id="checkbox3" />
            Certificaci&oacute;n de Medio Ambiente ISO 14001</td>
          </tr>
        <tr>
          <td colspan="3"><input type="checkbox" name="checkbox4" id="checkbox4" />
            Otras certificaciones. Cu&aacute;l? 
              <input name="ciudad30" type="text" class="cajadetexto" id="ciudad38" size="40" /></td>
          </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" align="center" class="textoblanco">REQUISITOS DE VALIDACI&Oacute;N</td>
          </tr>
        <tr>
          <td height="3" colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3" class="requisitos"><p><strong>Para que esta autorizaci&oacute;n tenga validez debe cumplir con los siguientes requisitos.</strong></p>
            <p>1. Esta hoja debe estar firmada por el representante legal o persona natural (autenticada la firma ante el notario).</p>
            <p>2. Anexar copia del registro &uacute;nico tributario (RUT).</p>
            <p>3. Si es persona natural, debe anexar los siguientes documentos:</p>
            <p>3.1 Fotocopia de la c&eacute;dula.</p>
            <p>3.2 Certificaci&oacute;n para clasificar tributariamente a las personas naturales por el a&ntilde;o gravable actual seg&uacute;n el modelo adjunto, el cual debe estar debidamente diligenciado y firmado en original.</p>
            <p>3.3  Si se  trata de la  prestaci&oacute;n de un  servicio a  RCN S.A., debe adjuntar copia de la planilla de pago de la seguridad social  calculado  por lo  menos sobre el  40% del valor del ingreso facturado  por el  servicio que  le est&aacute;  prestando a RCN  &oacute;,  sobre un salario m&iacute;nimo legal mensual vigente cuando el 40%  del valor  facturado a RCN sea inferior a este.</p>
            <p> El  valor maximo del pago a la seguridad social es sobre 25 salarios minimos legales mensuales vigentes.</p>
            <p>4. Anexar copia de certificado de existencia y representaci&oacute;n legal (con vigencia inferior a 90 d&iacute;as).</p>
            <p>5. Referencias bancarias.</p>
            <p>6. Referencias comerciales.</p>
            <p>7. Carta de presentaci&oacute;n, cat&aacute;logos o folletos de servicios.</p>
            <p>8. Certificaciones de Gesti&oacute;n de Calidad, Medio Ambiente y/o HSE (si aplica).<br />
              <br />
            </p>
            <p><strong>PROVEEDORES DE DOTACION DE SEGURIDAD</strong></p>
            <p>1. Certificaciones de cumplimiento de Normas T&eacute;cnicas aplicable para cada producto.<br />
              <br />
            </p>
            <p><strong>PROVEEDORES DE SERVICIOS PRESTADOS FUERA DE LAS INSTALACIONES DE EMPRESA</strong></p>
            <p>1. Certificados de calibraci&oacute;n de los equipos utilizados.</p>
            <p>2. Hojas de vida del personal que realiza los trabajos.</p>
            <p>3. Cumplir con el Manual del Contratista de RCN Radio.<br />
              <br />
            </p>
            <p><strong>PROVEEDORES DE SERVICIOS PRESTADOS DENTRO DE LAS INSTALACIONES DE EMPRESA</strong></p>
            <p>1. Certificados de calibraci&oacute;n de los equipos utilizados (si aplica).</p>
            <p>2. Hojas de vida del personal que realiza los trabajos.</p>
            <p>3. Cumplir con el Manual del Contratista de RCN Radio.</p></td>
        </tr><?php */?>
        <tr>
          <td colspan="3" align="center">
            <input type="hidden" name="fecha" value="<?= date("d/m/Y"); ?>" />
              <input type="hidden" name="hora" value="<?= date("G:i:s"); ?>" />
              <input type="hidden" name="MM_insert" value="form1" />
              <input type="submit" name="postback" id="postback" value="Enviar" class="boton" onclick="MM_validateForm('razonsocial','','R','representantelegal','','R','identificacion','','R','regimen','','R','matriculamercantil','','R','direccion','','R','ubicacion','','R','telefono','','R','email','','R','web','','R','contacto','','R','contactotelefono','','R','contactoemail','','R','cargo','','R','mensaje','','R');return document.MM_returnValue"/></td>
          </tr>
      </table></td>
      </tr>
   	</table>
    </form><?php if (isset($msg)) echo $msg;?>
    
<?php /*?><script>
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
</script><?php */?>


<p>&nbsp;</p>
<div>
  <p>Si desea comunicarse con nosotros puede tambi&eacute;n enviar sus comunicaciones escritas a la <strong>Calle 36 # 13A - 09   Bogot&aacute; D.C.</strong> o por tel&eacute;fono al<strong> PBX 3147070 Exts. 1180 - 1179 - 1146</strong>.</p>
</div>
<p>&nbsp;</p>
<div>
  <p align="center">RADIO CADENA NACIONAL  S.A.S. RCN RADIO </p>
</div>
<p>&nbsp;</p>
  </div>
</div>


<div id="footer"><?php //include("/home/www/salvation/rcnmundo/reddeportales/footer.php"); ?></div>

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"> 
</script> 
<script type="text/javascript"> 
_uacct = "UA-3017383-1";
urchinTracker('proveedores');
</script>

</body>
</html>
<?php

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=proveedores.xls");
header("Pragma: no-cache");
header("Expires: 0");

$conexion = mysql_connect('localhost', 'rcnmnd', 'LDfocFt5bidpRh');
mysql_select_db('rcnmnd_laradiodecolombia', $conexion); 
$tabla = mysql_query("SELECT id, razonsocial, representantelegal, identificacion, regimen, matriculamercantil, direccion, ubicacion, telefono, email, web, contacto, contactotelefono, contactoemail, cargo, mensaje, fecha, hora FROM proveedores ORDER BY id ASC");
while ($registro = mysql_fetch_array($tabla)) { 

echo "<table border=1>
<tr>
<td>".$registro['id']."</td>
<td>".$registro['razonsocial']."</td>
<td>".$registro['representantelegal']."</td>
<td>".$registro['identificacion']."</td>
<td>".$registro['regimen']."</td>
<td>".$registro['matriculamercantil']."</td>
<td>".$registro['direccion']."</td>
<td>".$registro['ubicacion']."</td>
<td>".$registro['telefono']."</td>
<td>".$registro['email']."</td>
<td>".$registro['web']."</td>
<td>".$registro['contacto']."</td>
<td>".$registro['contactotelefono']."</td>
<td>".$registro['contactoemail']."</td>
<td>".$registro['cargo']."</td>
<td>".$registro['mensaje']."</td>
<td>".$registro['fecha']."</td>
<td>".$registro['hora']."</td>
</tr>
</table>\n";
}  
mysql_free_result($tabla);
mysql_close($conexion);

?>

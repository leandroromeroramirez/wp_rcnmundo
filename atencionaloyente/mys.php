<?php

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=atencionaloyente.xls");
header("Pragma: no-cache");
header("Expires: 0");

$conexion = mysql_connect('localhost', 'rcnmnd', 'LDfocFt5bidpRh');
mysql_select_db('rcnmnd_laradiodecolombia', $conexion); 
$tabla = mysql_query("SELECT id, nombre, apellido, ano, mes, dia, genero, direccion, telefono, email, ciudad, barrio, asunto, sistema, ciudad_emisora, mensaje, fecha, hora FROM atencionaloyente ORDER BY id ASC");
while ($registro = mysql_fetch_array($tabla)) { 

echo "<table border=1>
<tr>
<td>".$registro['id']."</td>
<td>".$registro['nombre']." ".$registro['apellido']."</td>
<td>".$registro['genero']."</td>
<td>".$registro['ano']."/".$registro['mes']."/".$registro['dia']."</td>
<td>".$registro['telefono']."</td>
<td>".$registro['email']."</td>
<td>".$registro['ciudad']."</td>
<td>".$registro['asunto']."</td>
<td>".$registro['sistema']."</td>
<td>".$registro['ciudad_emisora']."</td>
<td>".$registro['mensaje']."</td>
<td>".$registro['fecha']."</td>
<td>".$registro['hora']."</td>
</tr>
</table>\n";
}  
mysql_free_result($tabla);
mysql_close($conexion);

?>

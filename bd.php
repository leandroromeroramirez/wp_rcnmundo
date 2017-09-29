<?php
$hostname_audios = "localhost";
$database_audios = "rcnmnd_laradiodecolombia";
$username_audios = "rcnmnd";
$password_audios = "LDfocFt5bidpRh";
$audios = mysql_pconnect($hostname_audios, $username_audios, $password_audios) or trigger_error(mysql_error(),E_USER_ERROR); 

function conectar()
{
	mysql_connect("localhost", "rcnmnd", "LDfocFt5bidpRh");
	mysql_select_db("rcnmnd_laradiodecolombia");
}

function desconectar()
{
	mysql_close();
}

?>

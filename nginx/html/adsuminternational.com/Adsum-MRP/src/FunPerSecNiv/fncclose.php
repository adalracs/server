<?php
/*
Propiedad intelectual de Adsum (c).
Funcion         : fncfecultact
Decripcion      : Cierra la conexion.
Autor           : ariascos
Fecha           : 04-oct-2001
*/
function fncclose($inuconn)
{
	pg_close($inuconn);
}
?>
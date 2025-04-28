<?php
/*
Propiedad intelectual de Adsum (c).
Funcion         : Back-up
Decripcion      : hace back-up de la base de datos
Retorno         : Archivo *.tar.bz2
$onuresult = 1   Migrado exitoso.
$onuresult = 0   Error de transaccion.
Autor           : ariascos
Fecha           : 28-ene-2004
*/

include ('../src/FunPerSecNiv/fncconn.php');

$nuconn = fncconn();
$comando= "pg_dumpall -ad > ../src/FunMig/backup.sql";
if ($nuconn)
{
	exec ($comando);
	{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Back-up exitoso")';
		echo '//-->'."\n";
		echo '</script>';
	}
	
}
else
echo "Error de conexión";
?>

<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : editaitemequipo
Decripcion      :
Autor           : mstroh
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 28122005
Historial de modificaciones
| Fecha  | Motivo					| Autor 	|
*/
function editaitemequipo($iRegitemequipo)
{
	$nuconn = fncconn();

	$result = uprecorditemequipo($iRegitemequipo,$nuconn);

	if($result < 0)
	{
		ob_end_clean();
		$flageditaritemequipo = 1;
	}
	fncclose($nuconn);
}
$iRegitemequipo['iteequcodigo'] = $iteequcodigo;
$iRegitemequipo['equipocodigo'] = $equipocodigo;
$iRegitemequipo['itemcodigo']   = $itemcodigo;

editaitemequipo($iRegitemequipo);
?>
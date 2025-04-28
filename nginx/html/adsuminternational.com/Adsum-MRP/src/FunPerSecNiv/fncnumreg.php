<?php 
/*
Propiedad intelectual de Adsum (c).
Funcion         : fncnumreg
Decripcion      : Determina la cantidad de registros de una transaccion.
Parametros      : Descripicion
$inuidtrans     Id de transaccion.
Retorno         : Descripicion
$onucantrow      Numero de registros.
Autor           : ariascos
Fecha           : 03-dec-2001
*/
function  fncnumreg($inuidtrans)
{
	if($inuidtrans<=0){
		return 0;
	}else{
		$onucantrow = pg_numrows($inuidtrans);

		return $onucantrow;
	}
	/*
	$onucantrow = ora_numrows($inuidtrans);
	return $onucantrow;
	*/
}
?>

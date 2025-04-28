<?php
/*
Propiedad intelectual de Adsum (c).
Funcion         : fncfetchall
Decripcion      : Trae los datos de un registro. 
Parametros      : Descripicion
  $inuidtrans     Id de transaccion.
Retorno         : Descripicion
 $orecarreglo     Arreglo con los datos del registro.
Autor           : ariascos
Fecha           : 03-dec-2001  
*/
function  fncfetchall($inuidtrans)
{
	$orecarreglo = pg_fetch_all($inuidtrans);
	return $orecarreglo;
}
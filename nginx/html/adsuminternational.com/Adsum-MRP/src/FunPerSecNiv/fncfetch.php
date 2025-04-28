<?php
/*
Propiedad intelectual de Adsum (c).
Funcion         : fncfetch
Decripcion      : Trae los datos de un registro. 
Parametros      : Descripicion
  $inuidtrans     Id de transaccion.
  $inureg		  Numero de registro.
Retorno         : Descripicion
 $orecarreglo     Arreglo con los datos del registro.
Autor           : ariascos
Fecha           : 03-dec-2001  
*/
function  fncfetch($inuidtrans, $inureg)
{
	$orecarreglo = pg_fetch_array($inuidtrans, $inureg);
	return $orecarreglo;
/*	
	$idcon = fncconn();
	$orecarreglo = ora_fetch_into($idcon,$inuidtrans);
	return $orecarreglo;
	fncclose($idcon);
*/
}
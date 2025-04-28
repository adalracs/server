<?php
/*
Propiedad intelectual de FullEngine (c).
Funcion         : fncconn
Decripcion      : Abre una coneccion a una base de datos postgres.
Parametros      : Descripicion
  $inuidtrans     Id de transaccion.
  $inupos		  Posicion  del campo
Retorno         : Descripicion
 $osbnombre   	  Nombre del campo.
Autor           : agomez-freina
Fecha           : 03-dec-2001
*/
function fncconn()
{
	$isbuser='postgres';
	$isbpass='produccion';
	$sbDatabase = 'nasadb';
	$nuPuerto = 5432;
	$sbHost = '127.0.0.1';
	$nuConn = pg_connect(' dbname= '.$sbDatabase
						.' port= '.$nuPuerto
						.' host= '.$sbHost
						.' user= '.$isbuser
						.' password= '.$isbpass);
	return $nuConn;
}
/*
Propiedad intelectual de FullEngine (c).
Funcion         : fncfetch
Decripcion      : Trae los datos de un registro.
Parametros      : Descripicion
  $inuidtrans     Id de transaccion.
  $inureg		  Numero de registro.
Retorno         : Descripicion
 $orecarreglo     Arreglo con los datos del registro.
Autor           : agomez-freina
Fecha           : 03-dec-2001
*/
function  fncfetch($inuidtrans,$inureg)
{
	$orecarreglo = pg_fetch_array($inuidtrans,$inureg);
	return $orecarreglo;
}
/*
Propiedad intelectual de FullEngine (c).
Funcion         : fncfieldname
Decripcion      : Presenta el nombre de un  campo.
Parametros      : Descripicion
  $inuidtrans     Id de transaccion.
  $inupos		  Posicion  del campo
Retorno         : Descripicion
 $osbnombre   	  Nombre del campo.
Autor           : agomez-freina
Fecha           : 03-dec-2001
*/
function  fncfieldname($inuidtrans,$inupos)
{
	$osbnombre = pg_fieldname($inuidtrans,$inupos);
	return $osbnombre;
}
/*
Propiedad intelectual de FullEngine (c).
Funcion         : fncclose
Decripcion      : Cierra una coneccion.
Parametros      : Descripicion
  $inuidtrans     Id de transaccion.
  $inupos		  Posicion  del campo
Retorno         : Descripicion
 $osbnombre   	  Nombre del campo.
Autor           : agomez-freina
Fecha           : 03-dec-2001
*/
function fncclose($inuconn)
{
	pg_close($inuconn);
}
/*
Propiedad intelectual de FullEngine (c).
Funcion         : fncnumreg
Decripcion      : Determina la cantidad de registros de una transaccion.
Parametros      : Descripicion
  $inuidtrans     Id de transaccion.
Retorno         : Descripicion
 $onucantrow      Numero de registros.
Autor           : agomez-freina
Fecha           : 03-dec-2001
*/
function  fncnumreg($inuidtrans)
{
	$onucantrow = pg_numrows($inuidtrans);
	return $onucantrow;
}
?>
